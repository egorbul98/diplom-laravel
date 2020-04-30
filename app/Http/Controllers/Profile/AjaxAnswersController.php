<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AnswerNumRequest;
use App\Http\Requests\AnswerStringRequest;
use App\Models\AnswerNum;
use App\Models\AnswerString;

class AjaxAnswersController extends Controller
{
    public function addAnswerNum(AnswerNumRequest $request)
    {
        $data = $request->validated();
        $answer = new AnswerNum($data);
        $answer->save();

        return response()->json(["id" => $answer->id], 200);
    }

    public function deleteAnswerNum(Request $request)
    {
        $id = $request->all()["id"];

        $answer = AnswerNum::find($id);
        $answer->delete();

        return response()->json(trans('messages.successfully_deleted'), 200);
    }

    public function addAnswerString(AnswerStringRequest $request)
    {
       
        $data = $request->validated();
        $answer = new AnswerString($data);
        $answer->save();

        return response()->json(["id" => $answer->id], 200);
    }

    public function deleteAnswerString(Request $request)
    {
        $id = $request->all()["id"];

        $answer = AnswerString::find($id);
        $answer->delete();

        return response()->json(trans('messages.successfully_deleted'), 200);
    }
    

}
