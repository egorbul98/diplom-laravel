<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Section;
use App\Models\Step;
use Illuminate\Http\Request;
use Auth;

class TrainingController extends Controller
{
   public function course($course_id)
   {
      $course = Course::findOrFail($course_id);
      if ($course->progress_users->where("id", Auth::user()->id)->first() == null) {
         $course->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id]);
      };
      return view("training.course", compact("course"));
   }

   public function section($course_id, $section_id)
   {
      $section = Section::findOrFail($section_id);
      $course = Course::findOrFail($course_id);
      $module = $section->modules[0];

      $modules_completed = Auth::user()->modules_completed_for_course($course->id)->get();
      return view("training.section", compact("section", "course", "module", "modules_completed"));
   }
   public function module($course_id, $section_id, $module_id, $step_num = 0)
   {
      $course = Course::findOrFail($course_id);
      $module = Module::findOrFail($module_id);
      $section = Section::findOrFail($section_id);
      $modules_completed = Auth::user()->modules_completed_for_course($course->id)->where("section_id", $section->id)->get();
      // dd($modules_completed);
      if ($module->progress_users->where("id", Auth::user()->id)->first() == null) {
         $module->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "section_id" => $section->id]);
      };
      if($section->modules->count() == $modules_completed->count() && $section->progress_users->where("id", Auth::user()->id)->first() == null){//Если все модули раздела пройдены
         $section->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "complete" => 1]);
      }
      if (isset($module->steps[$step_num])) {
         $step = $module->steps[$step_num];
      } else {
         $step = end($module->steps);
      }

      if ($step->type->id == 1 && $step->progress_users->where("id", Auth::user()->id)->first() == null) {
         $step->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "module_id" => $module->id, "section_id" => $section->id, "complete" => 1]);
      }
      return view("training.module", compact("module", "course", "step", "step_num", "section"));
   }

   public function checkAnswer(Request $request, $course_id, $section_id, $module_id, $step_id)
   {
      $course = Course::findOrFail($course_id);
      $module = Module::findOrFail($module_id);
      $section = Section::findOrFail($section_id);
      $step = Step::findOrFail($step_id);
      $check = false; //Проверяет нашелся ли правильный ответ или нет
      if (isset($request->all()["answerString"])) {
         $value = $request->all()["answerString"];
         foreach ($step->answersString as $answer) {
            if ($answer->value == $value) {
               if ($step->progress_users->where("id", Auth::user()->id)->first() == null) {
                  $step->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "module_id" => $module->id, "section_id" => $section->id, "complete" => 1]);
               }
               $check = true;
               break;
            }
         }
      } else if (isset($request->all()["answerNum"])) {
         $value = (int)$request->all()["answerNum"];
         foreach ($step->answersNum as $answer) {
            $correctVal = (int)$answer->value;
            $error = (int)$answer->error;
            if (($correctVal - $error) <= $value && $value <= ($correctVal + $error)) {
              
               if ($step->progress_users->where("id", Auth::user()->id)->first() == null) {
                  $step->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "module_id" => $module->id, "section_id" => $section->id, "complete" => 1]);
               }
               $check = true;
               break;
            }
         }
      }

      if ($check) {
         return back()->with(["success" => "Введен верный ответ!"]);
      } else {
         return back()->withErrors("Введен неверный ответ");
      }
   }

   public function moduleCompleted(Request $request)
   {
      $course = Course::findOrFail($request->all()["course_id"]);
      $module = Module::findOrFail($request->all()["module_id"]);
      $section = Section::findOrFail($request->all()["section_id"]);
      $steps_ids = $module->steps_ids();
      $user_id = Auth::user()->id;
      $steps_progress = $module->progress_steps_for_user($user_id)->get(); //шаги, пройденные пользователем

      foreach ($steps_progress as $step) {
         if (!in_array($step->id, $steps_ids)) {
            return back()->withErrors("Вы прошли не все модули!");
         }
      }

      
      $module->progress_users()->detach($user_id);
      $module->progress_users()->attach($user_id, ["course_id" => $course->id, "section_id" => $section->id, "complete"=>1]);

      $modules_completed = Auth::user()->modules_completed_for_course($course->id)->where("section_id", $section->id)->get();
      if($section->modules->count() == $modules_completed->count() && $section->progress_users->where("id", Auth::user()->id)->first() == null){//Если все модули раздела пройдены
         $section->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "complete" => 1]);
      }
      return redirect()->route("training.course", $course->id)->with(["success"=>"Вы успешно прошли модуль"]);
   }
}
