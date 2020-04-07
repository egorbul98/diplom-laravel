<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\AnswerTestSection;
use App\Models\Test;
use App\Models\Module;
use App\Models\TestSection;
use Illuminate\Http\Request;
use DB, Storage, Auth;

class AjaxTestController extends Controller
{
    public function saveTestSection(Request $request)
    {
        $data = $request->all();
        $testSection = TestSection::find($data["test_section_id"]);
        $testSection->title = $data["title"];
        $testSection->update();

        $testSection->answers()->delete();
        $answerTestSections = [];
        // dd($data["answers"]);
        foreach ($data["answers"] as $answer) {
            $answerTestSections[] = [
                "test_section_id" => $testSection->id,
                "value" => $answer["value"],
                "correct" => $answer["correct"] == "true" ? 1 : 0,
            ];
        }
        DB::table("answer_test_sections")->insert($answerTestSections);

        return response()->json(["msg" => "Успешно сохранено"], 200);
    }

    public function deleteTestSection(Request $request)
    {
        $data = $request->all();

        $testSection = TestSection::find($data["test_section_id"]);

        $testSection->answers()->delete();
        if ($testSection->image) {
            Storage::disk('public')->deleteDirectory("test-sections/{$testSection->id}");
        }
        $testSection->delete();

        return response()->json(["msg" => "Успешно удалено"], 200);
    }

    public function addTestSection(Request $request)
    {
        $data = $request->all();
        $testSection = new TestSection();
        $testSection->test_id = $data["test_id"];
        $testSection->title = "Новый вопрос?";
        $testSection->save();

        $answerTestSections = [];
        $answerTestSections[] = [
            "test_section_id" => $testSection->id,
            "value" => "Первый ответ",
            "correct" => 1,
        ];
        $answerTestSections[] = [
            "test_section_id" => $testSection->id,
            "value" => "Второй ответ",
            "correct" => 0,
        ];

        DB::table("answer_test_sections")->insert($answerTestSections);

        return response()->json(["msg" => "", "testSection" => $testSection, "answerTestSections" => $answerTestSections], 200);
    }

    public function getTestSection(Request $request)
    {
        $data = $request->all();
        $testSection = TestSection::find($data["test_section_id"]);
        $answers = $testSection->answers;
        if($testSection->image){
            $testSection->image = asset("Storage/".$testSection->image);
        }
        
        return response()->json(["msg" => "", "testSection" => $testSection, "answers" => $answers], 200);
    }

    public function uploadImage(Request $request)
    {

        if (isset($request->all()["image"])) {
            $data = $request->except("image");
            $testSection = TestSection::findOrFail($data["test_section_id"]);
            Storage::disk('public')->deleteDirectory("test-sections/{$testSection->id}");
            $pathImage = $request->file("image")->store("test-sections/{$testSection->id}", "public");
            $testSection->image = $pathImage;
            $testSection->update();
        }



        return response()->json(["image" => asset("Storage/".$pathImage)], 200);
    }

    public function getModules(Request $request)
    {
        $test = Test::findOrFail($request->all()["test_id"]);
        $modules_test_ids = $test->getModulesId();
        
        $user_id = Auth::user()->id;
        $modules = Module::select(["id", "title"])->where("author_id", $user_id)->whereNotIn("id",$modules_test_ids)->get(); //Получаем модули не входящие в данный тест 
       
        return response()->json(["modules"=>$modules], 200);
    }
    public function getTests(Request $request)
    {
        $tests = Auth::user()->tests;
        return response()->json(["tests"=>$tests], 200);
    }

   

    public function attachModule(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $module = Module::find($data["module_id"]);
        $module->tests()->attach($data["test_id"]);
        // dd($module->tests);
        return response()->json(["msg"=>"Модуль успешно добавлен", "module"=>$module], 200);
    }
    public function detachModule(Request $request)
    {
        $data = $request->all();
        $module = Module::find($data["module_id"]);
        $module->tests()->detach($data["test_id"]);
        return response()->json([], 200);
    }

    public function attachTest(Request $request)
    {
        $data = $request->all();
        $test = Test::findOrFail($data["test_id"]);
        $module = Module::findOrFail($data["module_id"]);
        $module->tests()->detach();
        $test->modules()->attach($data["module_id"]);

        return response()->json(["msg"=>"Тест успешно добавлен", "test"=>$test], 200);
    }

    public function searchModule(Request $request)
    {
        $data = $request->all();
        $test = Test::findOrFail($data["test_id"]);
        $modules_test_ids = $test->getModulesId();
        $user_id = Auth::user()->id;

        $modules = Module::select(["id", "title"])->where("title", "like", "%".$data["text"]."%")->where("author_id", $user_id)->whereNotIn("id",$modules_test_ids)->get(); //Получаем модули


        return response()->json(["modules"=>$modules], 200);
    }
    public function searchTest(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $tests = Test::select(["id", "title"])->where("title", "like", "%".$data["text"]."%")->where("author_id", $user_id)->get(); //Получаем тесты

        return response()->json(["tests"=>$tests], 200);
    }


}
