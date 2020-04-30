<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB, Auth, Carbon\Carbon;
use App;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Course::query()->where("courses.status_id", 3);
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
                } elseif ($request->all()["sort"] == "old") {
                    $query->orderBy("id", "DESC");
                } elseif ($request->all()["sort"] == "popular") {
                    $query->withCount("visits")->orderBy("visits_count", "DESC");
                }
            }
        }

        $courses = $query->paginate(6)->withPath("?" . $request->getQueryString());

        if (Auth::check()) {
            $recommended_courses = $this::getRecommendedCourses(6);
        }
        if (!isset($recommended_courses[0])) {
            $recommended_courses = $this::getPopularCourses(6);
        }

        return view("courses", compact("courses", "recommended_courses"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if($course->status_id!=3){//Если курс не опубликован
            return back()->withErrors(["errors"=>trans("messages.not_enough_rights")]);
        }
        $steps = collect();
        foreach ($course->sections as $section) {
            foreach ($section->modules as $module) {
                foreach ($module->steps as $step) {
                    $steps->push($step);
                }
            }
        }

        $user = Auth::user();

        if ($user != null && DB::table('visits') //Если пользователь сегодня не посещал данный курс, то записываем в таблицу VISITS
            ->where("course_id", $course->id)
            ->where("user_id", $user->id)
            ->where("created_at", ">=", (new Carbon)->startOfDay()->toDateTimeString())->first() == null
        ) {
            DB::table('visits')->insert(["course_id" => $course->id, "user_id" => $user->id, "created_at" => (new Carbon)]);
        };

        return view("course", compact("course", "steps"));
    }


    public function search(Request $request)
    {
        $text = $request->all()["text"];
        $locale = App::getLocale();
        if ($locale == "ru" || $locale == null) {
            $courses = Course::where("title", "like", "%" . $text . "%")->where("courses.status_id", 3)->paginate(6);
        } else {
            $courses = Course::where("title_en", "like", "%" . $text . "%")->where("courses.status_id", 3)->paginate(6);
        }

        if (Auth::check()) {
            $recommended_courses = $this::getRecommendedCourses(6);
        }
        if (!isset($recommended_courses[0])) {
            $recommended_courses = $this::getPopularCourses(6);
        }

        return view("courses", compact("courses", "recommended_courses"));
    }
}
