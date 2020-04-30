<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Gate;
class AjaxCourseController extends Controller
{
    public function getSections(Request $request)
    {
        $course = Course::findOrFail($request["course_id"]);
        if (Gate::denies('edit-course', $course)) {
            return response()->json(["msg" => trans('messages.not_enough_rights')], 400);
        }
        $sections = [];
        foreach ($course->sections as $section) {
            $modules = [];
            foreach ($section->modules as $module) {
                $modules[] = [
                    "title"=>$module->title,
                    "id"=>$module->id,
                    "competencesIn" =>$module->competences_in,
                    "competencesOut" =>$module->competences_out,
                    "competencesInIds" =>$module->competences_in_ids(),
                    "competencesOutIds" =>$module->competences_out_ids()
                ];
            }
            $sections[] = [
                "title"=>$section->title,
                "id"=>$section->id,
                "modules"=>$modules,
            ];
        }
        return response()->json(["sections" => $sections], 200);
    }

    

}
