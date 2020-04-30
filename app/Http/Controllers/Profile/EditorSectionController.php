<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Section;
use App\Http\Requests\EditorSectionRequest;
use Illuminate\Support\Facades\Gate;

class EditorSectionController extends BaseController
{
    public function edit(Course $course)
    {
        if(Gate::denies('edit-course', $course)){
            return redirect()->back()->withErrors(["error"=>trans('messages.not_enough_rights')]);
        }
        return view("profile.edit-sections.edit", compact("course"));
    }
    public function save($id, EditorSectionRequest $request)
    {
        $data = $request->all();
        foreach ($data["title"] as $key => $value) {
            $section = Section::find($key);
            $section->title = $value;
            $section->title_en = $data["title_en"][$key];
            $section->description = $data["description"][$key];
            $section->description_en = $data["description_en"][$key];
            $section->update();
        }
        // foreach ($data["title_en"] as $key => $value) {
        //     $section = Section::find($key);
        //     $section->title = $value;
        //     $section->update();
        // }
        // foreach ($data["description"] as $key => $value) {
        //     $section = Section::find($key);
        //     $section->description = $value;
        //     $section->update();
        // }
        foreach ($data["module-title"] as $key => $value) {
            $module = Module::find($key);
            $module->title = $value;
            $module->title_en = $data["module-title_en"][$key];
            $module->update();
        }
        $course = Course::find($id);
         return redirect()->route("profile.course.sections.edit", compact("course"))->with(["success"=>trans('messages.saved_successfully')]);
    }
}
