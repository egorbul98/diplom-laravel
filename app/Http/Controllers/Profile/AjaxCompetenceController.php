<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompetenceRequest;
use App\Models\Competence;

class AjaxCompetenceController extends Controller
{
    public function add(CompetenceRequest $request)
    {
       
        $data = $request->validated();
        $competence = new Competence($data);
        $competence->save();

        return response()->json(["id" => $competence->id], 200);
    }

    public function delete(Request $request)
    {
        $id = $request->all()["id"];

        $competence = Competence::find($id);
        $competence->delete();

        return response()->json("Компетенция успешно удалена", 200);
    }
  

}
