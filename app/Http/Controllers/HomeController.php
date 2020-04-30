<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use DB, Auth, Carbon\Carbon;

class HomeController extends Controller
{
    
    public function index()
    {
        $new_courses = $this::getNewCourses(6);
        $popular_courses = $this::getPopularCourses(6);

        if(Auth::check()){
            $recommended_courses = $this::getRecommendedCourses(6);
        }
        if(!isset($recommended_courses[0])){
            $recommended_courses = $popular_courses;
        }
        return view("home", compact("popular_courses", "recommended_courses", "new_courses"));
    }
    public function category($slug)
    {
        $category = Category::where("slug", $slug)->first();
        $courses = Course::where("category_id", $category->id)->paginate(6);

        if(Auth::check()){
            $recommended_courses = $this::getRecommendedCourses(6);
        }
        if(!isset($recommended_courses[0])){
            $recommended_courses = $this::getPopularCourses(6);
        }
        
        return view("category", compact("courses", "category", "recommended_courses"));
    }

    function setLocale($locale)
    {
        $languages = ["ru", "en"];
        if (in_array($locale, $languages)) {
            session(["locale" => $locale]);
        }

        return back();
    }
}
