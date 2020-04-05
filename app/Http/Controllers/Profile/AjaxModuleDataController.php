<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Models\Module;
use App\Models\Competence;

class AjaxModuleDataController extends Controller
{
    public function update(ModuleRequest $request)
    {
        $data = $request->all();

        $module = Module::find($data["id"]);
        $module->title = $data["title"];
        $module->update();
        
        $module->competences()->detach();
        if(isset($data["competences_out"])){
            foreach ($data["competences_out"] as $competence_id) {
                $module->competences()->attach($competence_id, ['type' => "out"]);
            }
        }
        if(isset($data["competences_in"])){
            foreach ($data["competences_in"] as $competence_id) {
                $module->competences()->attach($competence_id, ['type' => "in"]);
            }
        }
        
        // $section = new Section($data);
        // $section->save();

        return response()->json(["msg"=>"Успешно сохранено"], 200);
    }
 
}
