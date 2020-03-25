<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Section;
use App\Http\Requests\EditorSectionRequest;


class EditorSectionController extends BaseController
{
    public function edit(Course $course)
    {
        return view("profile.edit-sections.edit", compact("course"));
    }
    public function save($id, EditorSectionRequest $request)
    {
        $data = $request->validated();

        foreach ($data["title"] as $key => $value) {
            $section = Section::find($key);
            $section->title = $value;
            $section->save();
        }
        foreach ($data["description"] as $key => $value) {
            $section = Section::find($key);
            $section->description = $value;
            $section->save();
        }
        foreach ($data["module-title"] as $key => $value) {
            $module = Module::find($key);
            $module->title = $value;
            $module->save();
        }

         return redirect()->route("profile.course.sections.edit", Course::find($id))->with(["success"=>"Успешно сохранено"]);
    }
}
