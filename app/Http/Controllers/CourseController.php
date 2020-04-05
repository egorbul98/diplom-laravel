<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

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
        return view("course", compact("course"));
    }
}
