<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Auth, DB;

class AjaxTrainingController extends Controller
{
    public function getLearningPath(Request $request)
    {
        $data = $request->all();
        $course = Course::findOrFail($data["course_id"]);
        $user = Auth::user();

        $modules = DB::table('learning_path')
        ->select("modules.title as title", "modules.id as id")
        ->join("modules", "modules.id", "=", "learning_path.module_id")
        ->where("learning_path.course_id", $course->id)
        ->where("learning_path.user_id", $user->id)->get();
        return response()->json(["modules"=>$modules], 200);
    }
}
