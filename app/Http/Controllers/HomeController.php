<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy("id")->limit(6)->get();
        return view("home", compact("courses"));
    }
    public function category($slug)
    {
        $category = Category::where("slug", $slug)->first();
        $courses = Course::where("category_id", $category->id)->paginate(6);
        return view("category", compact("courses", "category"));
    }

}
