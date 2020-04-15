<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Course::query();
        if ($request->all()) {
            if (isset($request->all()["category"])) {
                $query->whereIn("category_id", array_keys($request->all()["category"]));
            }
        }

        $courses = $query->paginate(6)->withPath("?" . $request->getQueryString());
        return view("courses", compact("courses"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $steps = collect();
        foreach ($course->sections as $section) {
            foreach ($section->modules as $module) {
                foreach ($module->steps as $step) {
                    $steps->push($step);
                }
            }
        }
            //    return Module::all();
        return view("course", compact("course", "steps"));
    }


    public function search(Request $request)
    {   
        $text = $request->all()["text"];
        $courses = Course::where("title", "like", "%".$text."%")->paginate(6);
        return view("courses", compact("courses"));
    }
}
