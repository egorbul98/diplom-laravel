<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB, Auth, Carbon\Carbon;

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
                $query
                    ->whereIn("category_id", array_keys($request->all()["category"]));
                // ->where("category_id", array_keys($request->all()["category"]));
            }
            if (isset($request->all()["rating"]) && $request->all()["rating"] != "all") {
                $query
                    ->select("courses.*", "stars")
                    ->join("reviews", "reviews.course_id", "=", "courses.id")
                    ->whereRaw("(select avg(`reviews`.`stars`) from `reviews` where `reviews`.`course_id` = `courses`.`id`) > {$request->all()["rating"]}")
                    ->select("courses.*")
                    ->groupBy("courses.title");
            }
            if (isset($request->all()["sort"])) {
                if ($request->all()["sort"] == "new") {
                    $query->orderBy("id");
                } else {
                    $query->orderBy("id", "DESC");
                }
            }
        }

        $courses = $query->paginate(6)->withPath("?" . $request->getQueryString());


        // dd($courses[0]->reviews);
        // dd($courses);
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

        $user = Auth::user();
        
        if ($user!=null && DB::table('visits')//Если пользователь сегодня не посещал данный курс, то записываем в таблицу VISITS
            ->where("course_id", $course->id)
            ->where("user_id", $user->id)
            ->where("created_at", ">=", (new Carbon)->startOfDay()->toDateTimeString())->first() == null) {
            DB::table('visits')->insert(["course_id" => $course->id, "user_id" => $user->id, "created_at"=>(new Carbon)]);
        };

        return view("course", compact("course", "steps"));
    }


    public function search(Request $request)
    {
        $text = $request->all()["text"];
        $courses = Course::where("title", "like", "%" . $text . "%")->paginate(6);
        return view("courses", compact("courses"));
    }
}
