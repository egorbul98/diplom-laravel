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

        return response()->json(trans('messages.successfully_deleted'), 200);
    }

    public function saveCompetences(Request $request)
    {
        
        $data = $request->all();
        $languages = array_keys($data);
       
        for ($i=0; $i < count($data[$languages[0]]); $i++) { 
            $competenceForUpdate = Competence::findOrFail($data[$languages[0]][$i]["id"]);
            
            $dataForUpdate = [];
            foreach ($languages as $lang) {
                $postfix = ($lang=="ru") ? '' : "_$lang";
                $competence = $data[$lang][$i];
                $dataForUpdate["title$postfix"] = $competence["title"];
            }
            
            $competenceForUpdate->update($dataForUpdate);
            
        }
        // foreach ($data as $lang => $competences) {
            
        // }
        // $competence = Competence::find($id);
        // $competence->delete();

        // return response()->json(trans('messages.successfully_deleted'), 200);
    }
  

}
