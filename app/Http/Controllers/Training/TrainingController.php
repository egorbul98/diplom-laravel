<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Section;
use App\Models\Step;
use App\Models\Test;
use App\Models\TestSection;
use Illuminate\Http\Request;
use Auth, DB;
use Illuminate\Support\Collection;

class TrainingController extends Controller
{
   private function getModules($section, $user) //Получить модули, которые еще не были изучены, и которые доступны пользователю на основе полученных им компетенций. 
   {
      $competences_user = $user->competences->where("section_id", $section->id)->map(function ($competence) { //Компетенции раздела, которые уже изучены 
         return $competence->only(['id']);
      });
      $modules = $section->modules;
      $id_modules_completed = $user->id_modules_completed_for_section($section->id);//id пройденных модулей
      $resultModules = collect();
      foreach ($modules as $module) {
         if(isset($module->steps[0]) && !in_array($module->id, $id_modules_completed) && $this::accessModule($competences_user, $module)){//Если модуль обладает шагами и еще не пройден ,а также юзер обладает всеми нужными сбукомпетенциями для входных субкомпетенций данного модуля
            $resultModules->push($module);
         }
      }
      return $resultModules;
   }

   private function accessModule($competences_user, $module)
   {
      $competences_in_ids = $module->competences_in_ids(); //id входных компетенций
      if(count($competences_in_ids)==0){//Если входных еомпетенций нет
         return true;
      }
      $count = 0; //Количество выходных компетенций, которые являются входными для другого модуля
      for ($i = 0; $i < count($competences_user); $i++) {
         if (in_array($competences_user[$i]["id"], $competences_in_ids)) {
            $count++;
         }
      }
      // dump($competences_in_ids, $competences_user);
      if ($count == count($competences_in_ids) && $count != 0) {
         return true;
      } else {
         return false;
      }
   }
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

      $user = Auth::user();

      $modules = $this::getModules($section, $user);
      if(count($modules) ==0 && $section->progress_users->where("id", $user->id)->where("complete", 1)->first() == null){
         $section->progress_users()->detach($user->id);
         $section->progress_users()->attach($user->id, ["course_id" => $course->id, "complete" => 1]);
      }
      $competences_user = DB::table('competence_user')
      ->join("competences","competences.id","=","competence_user.competence_id")
      ->where("competences.section_id", $section->id)->get();
      $modules_completed = Auth::user()->modules_completed_for_section($section->id)->get();
      return view("training.section", compact("section", "course", "modules", "modules_completed", "competences_user"));
   }
   public function module($course_id, $section_id, $module_id, $step_num = 0)
   {
      $course = Course::findOrFail($course_id);
      $module = Module::findOrFail($module_id);
      $section = Section::findOrFail($section_id);
      $modules_completed = Auth::user()->modules_completed_for_course($course->id)->where("section_id", $section->id)->get();
      
      if ($module->progress_users->where("id", Auth::user()->id)->first() == null) {
         $module->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "section_id" => $section->id]);
      };
      // if ($section->modules->count() == $modules_completed->count() && $section->progress_users->where("id", Auth::user()->id)->where("complete", 1)->first() == null) { //Если все модули раздела пройдены
      //    $section->progress_users()->detach(Auth::user()->id);
      //    $section->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "complete" => 1]);
      // }
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
         $value = (int) $request->all()["answerNum"];
         foreach ($step->answersNum as $answer) {
            $correctVal = (int) $answer->value;
            $error = (int) $answer->error;
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
   public function test($course_id, $section_id, $module_id)
   {
      $course = Course::findOrFail($course_id);
      $module = Module::findOrFail($module_id);
      $section = Section::findOrFail($section_id);
      $test = Test::findOrFail($module->test->id);
      return view("training.test", compact("test", "module", "section", "course"));
   }
   public function testCompleted(Request $request)
   {
      $data = $request->all();
      $arr_corrent_sections_ids = [];
      $test = Test::findOrFail($data["test_id"]);
      $module = Module::findOrFail($data["module_id"]);
      $course = Course::findOrFail($data["course_id"]);
      $section = Section::findOrFail($data["section_id"]);
      if(!isset($data["answer"])){
         return back()->withErrors(["error"=>"Необходимо ответить на вопросы"]);
      }
      foreach ($data["answer"] as $test_section_id => $answer_id) {
         $test_section = TestSection::findOrFail($test_section_id);
         $correct_answers = $test_section->answers->where("correct", 1);
         $count = 0;//Количество правильных ответов
         foreach ($correct_answers as $correct) {
            if($correct->id == $answer_id){
               $count++;
            }
            if($count==count($correct_answers)){
               $arr_corrent_sections_ids[] = $test_section->id;
            }
         }
      }
      $procentCorrent = count($arr_corrent_sections_ids)/$test->count_questions*100;
      if($procentCorrent>75){
         $module->test_completed()->attach($test->id, ["user_id"=>Auth::user()->id]);
         return redirect()->route("training.module", [$course->id, $section->id, $module->id])->with(["success"=>"Тест успешно пройден"]);
      }else{
         return redirect()->route("training.module", [$course->id, $section->id, $module->id])->withErrors(["error"=>"Тест не пройден. Вы ответили правильно на {$procentCorrent}% вопросов, а необходимо 75%"]);
      }
   }
   public function moduleCompleted(Request $request)//Завершение модуля
   {
      $course = Course::findOrFail($request->all()["course_id"]);
      $module = Module::findOrFail($request->all()["module_id"]);
      $section = Section::findOrFail($request->all()["section_id"]);
      $steps_ids = $module->steps_ids();
      $user = Auth::user();
      //Если имеется тест, то редирект на тест собсна
      if(isset($module->test) && $module->test_completed->where("id", $module->test_id)->first()==null){
         return redirect()->route("training.test", [$course->id, $section->id, $module->id])->with(["info"=>"Для прохождения модуля, необходимо пройти тест"]);
      }
      $steps_progress = $module->progress_steps_for_user($user->id)->get(); //шаги, пройденные пользователем

      foreach ($steps_progress as $step) {
         if (!in_array($step->id, $steps_ids)) {
            return back()->withErrors("Вы прошли не все модули!");
         }
      }

      $module->progress_users()->detach($user->id);
      $module->progress_users()->attach($user->id, ["course_id" => $course->id, "section_id" => $section->id, "complete" => 1]);

      //user освоил компетенции:
      foreach ($module->competences_out as $competence) {
         if ($user->competences()->where("competence_id", $competence->id)->first() == null) {
            $user->competences()->attach($competence->id);
         }
      }

      $modules_completed = $user->modules_completed_for_course($course->id)->where("section_id", $section->id)->get();
      // if ($section->modules->count() == $modules_completed->count() && $section->progress_users->where("id", $user->id)->first() == null) { //Если все модули раздела пройдены
      //    $section->progress_users()->attach($user->id, ["course_id" => $course->id, "complete" => 1]);
      // }
      if ($section->modules->count() == $modules_completed->count() && $section->progress_users->where("id", $user->id)->where("complete", 1)->first() == null) { //Если все модули раздела пройдены
         $section->progress_users()->detach($user->id);
         $section->progress_users()->attach($user->id, ["course_id" => $course->id, "complete" => 1]);
      }
      return redirect()->route("training.section", [$course->id, $section->id])->with(["success" => "Вы успешно прошли модуль"]);
   }
}
