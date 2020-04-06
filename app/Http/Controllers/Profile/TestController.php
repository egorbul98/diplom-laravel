<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use DB;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Auth::user()->tests()->paginate(10);
        return view("profile.test.index", compact("tests"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $test = new Test();
        return view("profile.test.create", compact("test"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        $data = $request->validated();
        $data["author_id"] = Auth::user()->id;
        
        $test = new Test($data);
        $test->save();
        
        //Создаем первый вопрос
        $testSection = new TestSection();
        $testSection->test_id = $test->id;
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

        return redirect()->route("profile.test.edit", $test)->with(['success' => "Тест успешно добавлен"]);
        // return redirect()->route("profile.test.edit", $test);
        // return view("profile.test.create", compact("test"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        if (Gate::denies('edit-test', $test)) {
            return redirect()->back()->withErrors(["error" => "Недостаточно прав"]);
        }
        
        return view("profile.test.create", compact("test"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, Test $test)
    {
        $data = $request->validated();

        $result = $test->update($data);

        if ($result) {
            return back()->with(["success" => "Успешно сохранено"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
