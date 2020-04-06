<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\AnswerTestSection;
use App\Models\Test;
use App\Models\TestSection;
use Illuminate\Http\Request;
use DB;
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
                "test_section_id"=>$testSection->id,
                "value" => $answer["value"],
                "correct" => $answer["correct"]=="true" ? 1 : 0,
            ];
        }
        DB::table("answer_test_sections")->insert($answerTestSections);

        return response()->json(["msg"=>"Успешно сохранено"], 200);
    }

    public function deleteTestSection(Request $request)
    {
        $data = $request->all();
        
        $testSection = TestSection::find($data["test_section_id"]);
       
        $testSection->answers()->delete();
        $testSection->delete();
        
        return response()->json(["msg"=>"Успешно удалено"], 200);
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
            "test_section_id"=>$testSection->id,
            "value" => "Первый ответ",
            "correct" => 1,
        ];
        $answerTestSections[] = [
            "test_section_id"=>$testSection->id,
            "value" => "Второй ответ",
            "correct" => 0,
        ];

        DB::table("answer_test_sections")->insert($answerTestSections);
        
        return response()->json(["msg"=>"", "testSection"=>$testSection, "answerTestSections"=>$answerTestSections], 200);
    }

    public function getTestSection(Request $request)
    {
        $data = $request->all();
        $testSection = TestSection::find($data["test_section_id"]);
        $answers = $testSection->answers;
        return response()->json(["msg"=>"", "testSection"=>$testSection, "answers"=>$answers], 200);
    }
}
