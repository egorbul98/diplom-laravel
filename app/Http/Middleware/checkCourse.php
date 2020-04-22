<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Module;
use Closure;
use Auth, DB, Carbon\Carbon, Gate;
use Illuminate\Support\Facades\Redirect;

class checkCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $course = Course::findOrFail($request->route('course_id'));
        $user = Auth::user();

        if (Gate::denies('show-course', [$course])) {
            return back();
        }

        $modules_for_repeat = $user->modules_forget_for_course($course->id)->get(); //Получаем модули, для которых уже подошел срок повторения

        //Забытые модули добавляем в таблицу с забытыми модулями (modules_repetition_user)
        if (count($modules_for_repeat) > 0) {

            /*// foreach ($modules_for_repeat as $module) {
                 if ($user->forget_modules()->where("module_id", $module->id)->first() == null) {
                    $user->forget_modules()->attach($module->id, ["course_id" => $course->id]);
                }
            }*/

            if ($request->route('module_id') != null) { //Если запрашиваемая страница с модулем, то проверяем, этот модуль для повторения или чё. Если для повторения, то открываем страницу собсна
                $module = Module::findOrFail($request->route('module_id'));

                if ($modules_for_repeat->where("id", $module->id)->first() != null) { //Если запрашиваемый модуль есть в списке забытых модулей
                    // $user->progress_steps()->wherePivot("module_id", $module->id)->detach();
                    return $next($request);
                }
            }

            return redirect()->route("training.course", [$course->id])->with(["info" => "У вас есть забытые модули или обязательные тесты. Для продолжения обучения, необходимо их пройти"]);
        }

        return $next($request);
    }
}
