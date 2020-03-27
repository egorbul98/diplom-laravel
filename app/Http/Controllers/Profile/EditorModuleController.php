<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Step;
use App\Models\StepType;
// use App\Http\Requests\EditorSectionRequest;


class EditorModuleController extends BaseController
{
    public function edit(Module $module, $id_step = 1)
    {
        $step_types = StepType::all();
        $step = Step::find($id_step);
        
        return view("profile.edit-module.module", compact("module", "step_types", "step"));
    }
    public function save($id, Request $request)
    {
        // $data = $request->validated();

        // foreach ($data["title"] as $key => $value) {
        //     $section = Section::find($key);
        //     $section->title = $value;
        //     $section->save();
        // }
        // foreach ($data["description"] as $key => $value) {
        //     $section = Section::find($key);
        //     $section->description = $value;
        //     $section->save();
        // }
        // foreach ($data["module-title"] as $key => $value) {
        //     $module = Module::find($key);
        //     $module->title = $value;
        //     $module->save();
        // }

        //  return redirect()->route("profile.course.sections.edit", Course::find($id))->with(["success"=>"Успешно сохранено"]);
    }
}
