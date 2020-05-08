<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\Course;
use App\Models\Module;
use App\Models\Section;
use App\Models\Step;
use App\Models\Test;
use App\Models\TestSection;
use Illuminate\Http\Request;
use Auth, DB, Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class TrainingController extends Controller
{

   protected static $factor = -0.135;

   private function getModules($section, $user) //Получить модули, которые еще не были изучены, и которые доступны пользователю на основе полученных им компетенций. 
   {
      $competences_user = $user->competences->where("section_id", $section->id)->map(function ($competence) { //Компетенции раздела, которые уже изучены 
         return $competence->only(['id']);
      });
      $modules = $section->modules;
      $id_modules_completed = $user->id_modules_completed_for_section($section->id); //id пройденных модулей
      $resultModules = collect();
      
      foreach ($modules as $module) {
         if (isset($module->steps[0]) && !in_array($module->id, $id_modules_completed) && $this::accessModule($competences_user, $module)) { //Если модуль обладает шагами и еще не пройден ,а также юзер обладает всеми нужными сбукомпетенциями для входных субкомпетенций данного модуля
            
            $resultModules->push($module);
         }
      }
      return $resultModules;
   }

   private function accessModule($competences_user, $module)
   {
      
      $competences_in_ids = $module->competences_in_ids(); //id входных компетенций
      if (count($competences_in_ids) == 0) { //Если входных еомпетенций нет
         return true;
      }
      
      $count = 0; //Количество выходных компетенций, которые являются входными для другого модуля
      foreach ($competences_user as $key => $competence) {
         if (in_array($competence["id"], $competences_in_ids)) {
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
   public function startCourse($course_id)
   {
      $course = Course::findOrFail($course_id);

      if ($course->progress_users->where("id", Auth::user()->id)->first() == null) {
         $course->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id]);
      };
      return redirect()->route("training.course", $course->id);
   }

   public function learningPath($course_id)
   {
      $course = Course::findOrFail($course_id);
      if (Gate::denies('show-course', [$course])) {
         return back();
      }
      return view("training.learning-path", compact("course"));
   }

   public function course($course_id)
   {
      $course = Course::findOrFail($course_id);
      $user = Auth::user();

      if (Gate::denies('show-course', [$course])) {
         return back();
      }
      $module_for_repeat = $user->modules_forget_for_course($course->id)->get(); //Получаем модули, для которых уже подошел срок повторения
      if ($course->progress_users->where("id", Auth::user()->id)->first() == null) {
         $course->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id]);
      };


      return view("training.course", compact("course", "module_for_repeat"));
   }

   public function section($course_id, $section_id)
   {
      
      $section = Section::findOrFail($section_id);
      $course = Course::findOrFail($course_id);
      $user = Auth::user();

      if (Gate::denies('show-section', [$course, $section])) {
         return back()->withErrors(["error" => trans('messages.there_is_no_such_section')]);
      }
      
      $course_sections = $course->sections;
      for ($i=0; $i < $course_sections->count(); $i++) { 
         if($i!=0 && $course_sections[$i]->id == $section_id){
            $last_section = $course_sections[$i-1]; //Предыдущий курс
            if($last_section->progress_users()->where("user_id", $user->id)->first() == null){//Если предыдущий раздел не пройден то ошибка
               return back()->with(["info" => trans('messages.first_go_through_the_previous_section')]);
            }
         }
      }
     
      $modules = $this::getModules($section, $user);
      
      if (count($modules) == 0 && $section->progress_users->where("id", $user->id)->where("complete", 1)->first() == null) {
         $section->progress_users()->detach($user->id);
         $section->progress_users()->attach($user->id, ["course_id" => $course->id, "complete" => 1]);
      }
      
      $competences_user = Competence::select("competences.*")
         ->join("competence_user", "competences.id", "=", "competence_user.competence_id")
         ->where("competences.section_id", $section->id)->get();

      //Проверяем, может курс полностью пройден
      $sections_completed = $course->progress_sections_completed;
      $procent = round(count($sections_completed)/count($course->sections)*100);
      if($procent==100){//Курс полностьб пройден
         $course->progress_users()->updateExistingPivot($user->id, ["complete" => 1]);
      }
      
      $modules_completed = Auth::user()->modules_completed_for_section($section->id)->get();
      return view("training.section", compact("section", "course", "modules", "modules_completed", "competences_user"));
   }
   public function startModule($course_id, $section_id, $module_id)
   {
      $course = Course::findOrFail($course_id);
      $module = Module::findOrFail($module_id);
      $section = Section::findOrFail($section_id);

      if ($module->progress_users->where("id", Auth::user()->id)->first() == null) {
         $module->progress_users()->attach(Auth::user()->id, ["course_id" => $course->id, "section_id" => $section->id]);
      };

      return redirect()->route("training.module", [$course->id, $section->id, $module->id]);
   }

   public function module($course_id, $section_id, $module_id, $step_num = 0)
   {
      $course = Course::findOrFail($course_id);
      $module = Module::findOrFail($module_id);
      $section = Section::findOrFail($section_id);



      if (Gate::denies('show-module', [$course, $section, $module])) {
         return back()->withErrors(["error" => "Нет доступа"]);
      }

      $modules_completed = Auth::user()->modules_completed_for_course($course->id)->where("section_id", $section->id)->get();


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
         return back()->with(["success" => trans('messages.the_correct_answer_is_entered')]);
      } else {
         return back()->withErrors(trans('messages.the_incorrect_answer_is_entered'));
      }
   }
   public function test($course_id, $section_id, $module_id, $step_num = 0)
   {
      $course = Course::findOrFail($course_id);
      $module = Module::findOrFail($module_id);
      $section = Section::findOrFail($section_id);
      $test = Test::findOrFail($module->test->id);
      return view("training.test", compact("test", "module", "section", "course", "step_num"));
   }
   public function testCompleted(Request $request) //Завершение теста (кнопка "Завершить")
   {
      $data = $request->all();
      if (!isset($data["answer"])) {
         return back()->withErrors(["error" => trans('messages.need_to_answer_questions')]);
      }

      $test = Test::findOrFail($data["test_id"]);
      $module = Module::findOrFail($data["module_id"]);
      $course = Course::findOrFail($data["course_id"]);
      $section = Section::findOrFail($data["section_id"]);
      $user = Auth::user();

      $arr_correct_answers = [];
      $count = 0; //Количество правильно отвеченных вопросов (всего за весь тест)
      foreach ($data["answer"] as $test_section_id => $answers) {
         $test_section = TestSection::findOrFail($test_section_id);

         $correct_answers = $test_section->answers->where("correct", 1)->map(function ($answer) {
            return $answer->id;
         })->toArray();

         $temp_count = 0; //Подсчет кол-ва правильных ответов в вопросе

         foreach ($answers as $answer) {
            if (in_array($answer, $correct_answers)) {
               $temp_count++;
            } else {
               $temp_count--;
            }
         }

         if ($temp_count == count($correct_answers)) {
            $count += 1; //полностью Правильно отвеченный вопрос
            $arr_correct_answers[$test_section->test_id][] = $test_section->id;
         } else {
            if ($temp_count > 0) {
               $avg = $temp_count / count($correct_answers);
               $count += $avg;
            }
         }
      }
      ///////**************** Возможная проблема ниже */
      $procentCorrent = $count / (int) $data["test_questions_count"][$test->id][0] * 100;
      // dd($module->test_completed()->wherePivot('user_id', $user->id)->wherePivot("test_id", $test->id)->first() != null);
      if ($procentCorrent > $test->percent_correct_answers) {
         if($module->test_completed()->wherePivot('user_id', $user->id)->wherePivot("test_id", $test->id)->first() == null){//Если тест впервые проходится, то атачим
            $module->test_completed()->attach($test->id, ["user_id" => $user->id]);
         }
         // $module->test_completed()->wherePivot('user_id', $user->id)->detach($test->id);
        
         session(["test_id{$test->id}" => '1']); //Записываем в сессию то, что данный тест пройден
         return redirect()->route("training.module", [$course->id, $section->id, $module->id, $data["step_num"]])->with(["success" => trans('messages.test_passed_successfully')]);
      } 
      else {
         
         return redirect()->route("training.module", [$course->id, $section->id, $module->id, $data["step_num"]])->withErrors(["error" => trans('messages.the_test_failed', ["num"=>$procentCorrent, "total_num"=>$test->percent_correct_answers])]);
      }
   }
   public function moduleCompleted(Request $request) //Завершение модуля
   {
      $course = Course::findOrFail($request->all()["course_id"]);
      $module = Module::findOrFail($request->all()["module_id"]);
      $section = Section::findOrFail($request->all()["section_id"]);
      $steps_ids = $module->steps_ids();
      $user = Auth::user();
      
      //Если имеется тест, то редирект на тест собсна
      if (isset($module->test) && $module->test_completed->where("id", $module->test_id)->first() == null) {
         return redirect()->route("training.test", [$course->id, $section->id, $module->id])->with(["info" => trans('messages.to_pass_the_module_you_must_pass_the_test')]);
      }
      
      $steps_progress = $module->progress_steps_for_user($user->id)->get(); //шаги, пройденные пользователем

      foreach ($steps_progress as $step) {
         if (!in_array($step->id, $steps_ids)) {
            return back()->withErrors(trans('messages.you_didn’t_go_all_the_steps'));
         }
      }

      $dataUpdate = ["course_id" => $course->id, "section_id" => $section->id, "complete" => 1]; //Инфо для записи в бд

      if ($module->repeat == 1) {
         //Определяем дату повторения модуля
         // $forget_factor = $course->progress_users()->where("user_id", $user->id)->first();
         $forget_factor = $course->progress_users()->where("user_id", $user->id)->first()->pivot->forget;
         $knowleadge = $course->knowledge_to_repeat / 100; //Примерно 3 дня (74 часа)
         $timeForget = $this::getTimeForget($knowleadge, $forget_factor) * 24; //Через сколько часов студент забудет материал до $knowledge %
         $dateRepetition = (new Carbon())->addHours($timeForget)->format("Y-m-d H:i:s");
         // $dateRepetition = (new Carbon())->addMinutes(1)->format("Y-m-d H:i:s");
         $dataUpdate["repetition"] = $dateRepetition;
         $dataUpdate["completed_at"] = new Carbon();
      }
     
      if($module->test_id != null){//обнуляем последнее прохождение теста. Чтобы при следующем предъявлении модуля, тест не счиатлся как "пройденный"
         $module->test_completed()->wherePivot("user_id", $user->id)->updateExistingPivot($module->test_id, ["repeated" => 0]);
      }
      
      $module->progress_users()->detach($user->id);
      $module->progress_users()->attach($user->id, $dataUpdate);
      //Добавляем модуль в историю прохождения модулей
      DB::table('learning_path')
         ->insert(["module_id" => $module->id,  "course_id" => $course->id, "section_id" => $section->id, "user_id" => $user->id]);
         session()->forget("test_id{$module->test_id}");//Забываем тест, который связан с модулем
      //user освоил компетенции:
      foreach ($module->competences_out as $competence) {
         if ($user->competences()->where("competence_id", $competence->id)->first() == null) {
            $user->competences()->attach($competence->id);
         }
      }
     
      $modules_completed = $user->modules_completed_for_course($course->id)->where("section_id", $section->id)->get();

      if ($section->modules->count() == $modules_completed->count() && $section->progress_users->where("id", $user->id)->where("complete", 1)->first() == null) { //Если все модули раздела пройдены
         $section->progress_users()->detach($user->id);
         $section->progress_users()->attach($user->id, ["course_id" => $course->id, "complete" => 1]);
         $module->test_completed()->wherePivot("user_id", $user->id)->updateExistingPivot($module->test_id, ["repeated" => 0]);

         //Проверяем, может курс полностью пройден
         $sections_completed = $course->progress_sections_completed;
         $procent = round(count($sections_completed)/count($course->sections)*100);
         if($procent==100){//Курс полностьб пройден
            $course->progress_users()->updateExistingPivot($user->id, ["complete" => 1]);
         }
         
      }

      

      return redirect()->route("training.section", [$course->id, $section->id])->with(["success" => trans('messages.you_have_successfully_completed_the_module')]);
   }

   public function forgotTest($course_id) //фОРМИРОВАНИЕ ТЕСТА
   {
      $course = Course::findOrFail($course_id);
      $user = Auth::user();
      $module_for_repeat = $user->modules_forget_for_course($course->id)->where("test_id", "!=", null)->get(); //Получаем модули с тестами, для которых уже подошел срок повторения 
      $max_count_test_sections = 10; //Количество вопросов, от каждого теста
      $test = collect();
      $many_test_sections = collect(); //Формируем множество вопросов
      foreach ($module_for_repeat as $module) {
         $test_sections = $module->test->test_sections;
         $count = count($test_sections);
         if ($count > $max_count_test_sections) { //Если количество вопросов в тесте больше максимального количества вопросов от каждого теста ($count_test_sections)
            $count = $max_count_test_sections;
         }
         $many_test_sections->push($test_sections->random($count));
      }
      $test->put("test_sections", $many_test_sections);
      $test_sections = $test->flatten()->shuffle();
      return view("training.test-forgot", compact("test_sections", "course"));
   }

   public function testForgotCompleted(Request $request) //Завершение теста (кнопка "Завершить")
   {
      $data = $request->all();
      $test_sections = $request->except("course_id", "_token", "test_questions_count");
      $user = Auth::user();
      
      if (count($test_sections) == 0) {
         return back()->withErrors(trans('messages.need_to_answer_questions'));
      }

      $arr_correct_answers = [];
      $course = Course::findOrFail($data["course_id"]);
      $testResult = [];
      foreach ($test_sections as $test_section_id => $answers) {
         $test_section = TestSection::findOrFail($test_section_id);
         $testResult[] = [
            "id" => $test_section->id,
            "test_id" => $test_section->test_id,
            "answers" => $answers,
         ];
      }
      $testResult = $this::groupByKey($testResult, "test_id"); //Группируем массив по test_id. testResult - общий массив, со всемми ответами соответсвующих тестов

      $totalQuestions = 0; //Общее число вопросов
      foreach ($data["test_questions_count"] as $test_id => $value) {
         DB::table('module_test_user')
            ->where('test_id', $test_id)
            ->where('user_id', $user->id)
            ->update(['repeated' => 1]); //Помечаем все тесты, учасвствующие в данном общем тесте, как повторяющиеся (для того, чтобы в случае, если один из тестов не пройден, то он не выводился опять для прохождения. только уже при прохождении модуля буде выводиться)
         $totalQuestions += (int) $value[0];
      }
      
      $count = 0; //Количество правильно отвеченных вопросов (всего за весь тест)
      foreach ($test_sections as $test_section_id => $answers) {
         $test_section = TestSection::findOrFail($test_section_id);
         $correct_answers = $test_section->answers->where("correct", 1)->map(function ($answer) {
            return $answer->id;
         })->toArray();

         $temp_count = 0; //Подсчет кол-ва правильных ответов в вопросе

         foreach ($answers as $answer) {
            if (in_array($answer, $correct_answers)) {
               $temp_count++;
            } else {
               $temp_count--;
            }
         }

         if ($temp_count == count($correct_answers)) {
            $count += 1; //полностью Правильно отвеченный вопрос
            $arr_correct_answers[$test_section->test_id][] = $test_section->id;
         } else {
            if ($temp_count > 0) {
               $avg = $temp_count / count($correct_answers);
               $count += $avg;
            }
         }
      }
      $totalResult = ($count / $totalQuestions * 100); //Общий % правильно отвеченных вопросов
      
      $updated_forget_factors_values = []; //значения всех коэффициентов забывания, полученные на основе тестирования модулей. Затем будет считаться среднее арифметическое для обновления КЗ данного пользователя
     
     if( empty($arr_correct_answers)){//Если тест пройден на 0%
        foreach ($data["test_questions_count"] as $test_id => $value) {
            DB::table('module_test_user')
            ->where('test_id', $test_id)
            ->where('user_id', $user->id)
            ->update(['repeated' => 1]);
            $modules = $course->tests()->where("test_id", $test_id); //Модули, у которых есть данный тест
            foreach ($modules as $module) { //Коэфициенты надо обновить
               $completed_at =  Carbon::parse(DB::table('progress_module')
                  ->where('module_id', $module->module_id)
                  ->where('user_id', $user->id)
                  ->first()->completed_at);
               $timePassed = $completed_at->diffInHours(new Carbon); //Прошло времени (часы) после прохождения модуля в последний раз
               //************
               $timePassed = 240;
               $updated_forget_factor = $this::getUpdatedForgetFactor($course->knowledge_to_repeat / 100, 0 / 100, $timePassed / 24); //обновленный Коэффициент забывания на основе прохождения теста
               $updated_forget_factors_values[] = $updated_forget_factor;
            }
        }
     }

      foreach ($arr_correct_answers as $test_id => $answers) {
         $test = Test::find($test_id);
         $result = count($answers) / (int) $data["test_questions_count"][$test_id][0] * 100; //Процент правильно отвеченных вопросов для конкретного теста (test_id) модуля \
         
         $modules = $course->tests()->where("test_id", $test_id); //Модули, у которых есть данный тест
         foreach ($modules as $module) { //Обновляем дату следующего повтоения
            $completed_at =  Carbon::parse(DB::table('progress_module')
               ->where('module_id', $module->module_id)
               ->where('user_id', $user->id)
               ->first()->completed_at);
            $timePassed = $completed_at->diffInHours(new Carbon); //Прошло времени (часы) после прохождения модуля в последний раз
            //************
            $timePassed = 240;
            $updated_forget_factor = $this::getUpdatedForgetFactor($course->knowledge_to_repeat / 100, $result / 100, $timePassed / 24); //обновленный Коэффициент забывания на основе прохождения теста
            $updated_forget_factors_values[] = $updated_forget_factor;
         }
         if ($result >= $test->percent_correct_answers) { //Если тест норм отвечен, то модуль считается не забытым
            //Обозначаем repeated = 0, чтобы данный тест не повторялся 
            DB::table('module_test_user')
               ->where('test_id', $test_id)
               ->where('user_id', $user->id)
               ->update(['repeated' => 0]);
         } else { //Обозначаем repeated = 1, чтобы данный тест повторялся (необязательно, чтобы он был пройден)
            DB::table('module_test_user')
               ->where('test_id', $test_id)
               ->where('user_id', $user->id)
               ->update(['repeated' => 1]);
         }
      }
      
      if (count($updated_forget_factors_values) != 0) {
         $forget_factor = $course->progress_users()->where("user_id", $user->id)->first()->pivot->forget; //Коэф. забывания
         $updated_forget_factors_values[] = $forget_factor;
         $avg = array_sum($updated_forget_factors_values) / count($updated_forget_factors_values);
         $course->progress_users()->updateExistingPivot($user->id, ["forget" => $avg]);
      }
      
      //************ */
      $forget_factor = $course->progress_users()->where("user_id", $user->id)->first()->pivot->forget; //Коэф. забывания пользователя
      foreach ($arr_correct_answers as $test_id => $answers) {
         $test = Test::find($test_id);
         $result = count($answers) / (int) $data["test_questions_count"][$test_id][0] * 100; //Процент правильно отвеченных вопросов для конкретного теста (test_id) модуля 
         if ($result >= $test->percent_correct_answers) { //Если тест норм отвечен, то модуль считается не забытым
            $modules = $course->tests()->where("test_id", $test_id); //Модули, у которых есть данный тест
            foreach ($modules as $module) { //Обновляем дату следующего повтоения
               $timeForget = $this::getTimeForget($course->knowledge_to_repeat, $forget_factor) * 24; //Через сколько часов студент забудет материал до $knowledge_to_repeat 
               $dateRepetition = (new Carbon())->addHours($timeForget)->format("Y-m-d H:i:s");
               // $dateRepetition = (new Carbon())->addMinutes(1)->format("Y-m-d H:i:s");
               $dateCompleted = new Carbon();
               DB::table('progress_module')
                  ->where('module_id', $module->module_id)
                  ->where('user_id', $user->id)
                  ->update(['repetition' => $dateRepetition, "completed_at" => $dateCompleted]);
            }
         }
      }
      return redirect()->route("training.course", [$course->id])->with(["info" => trans('messages.you_answered_correctly_to', ["num"=>$totalResult])]);
   }

   private function getKnowledge($time, $forget_factor)
   {
      $first = 1 + ($time / $forget_factor);
      $sec = $this::$factor;
      return pow($first, $sec);
   }
   private function getForgetFactor($knowledge, $time)
   {
      if ($knowledge == 1) {
         $knowledge -= 0.09;
      }
      return $time / (pow($knowledge, 1 / ($this::$factor)) - 1);
   }
   private function getTimeForget($knowledge, $forget_factor)
   { //knowledge- знание (в какой день студент достигнет такого знания) return - возвращает дни
      return $forget_factor * (pow($knowledge, 1 / ($this::$factor)) - 1);
   }

   private function groupByKey($array, $key)
   {
      $resultArr = [];
      foreach ($array as $val) {
         $resultArr[$val[$key]][] = $val;
      }
      return $resultArr;
   }

   private function getUpdatedForgetFactor($knowledgeToRepeat, $knowledge, $timePassed) //knowledgeToRepeat - процент знаний, при котором требуется повторение; knowledge -На сколько процентов человек помнит повторенный материал.timePassed - Спустя сколько времени человек решил повторить модуль (с момента последнего прохождения) (в днях)
   { //все knowledge не в процентах, а в долях
      $k = 0; //доля знаний на момент прохождения модуля
      if ($knowledge >= $knowledgeToRepeat) {
         $k = $knowledgeToRepeat;
      } else {
         $k = $knowledge;
      }

      $newKoef = $this::getForgetFactor($k, $timePassed);
      return $newKoef; //Новый коэффициент
   }
}
