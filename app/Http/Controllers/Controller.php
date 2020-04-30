<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth, DB, Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getRecommendedCourses($limit = null)
    {
        //Пользователи, которые
        // просматривали такие же курсы, что и данный пользователь 
        $similar_users = DB::table('visits')->select("user_id")
            ->whereIn('user_id', function ($query) {
                $user = Auth::user();
                $query->select('courses.id as course_id')
                    ->from("courses")
                    ->join("visits", "visits.course_id", "=", "courses.id")
                    ->where("visits.user_id", $user->id); //Курсы, которые просматривал данный пользователь
            });
        $todayDay = (new Carbon)->startOfDay()->toDateTimeString(); //Сегодняшняя дата
        //Курсы просмотренные сегодня
        $courses_today = DB::table('visits')->select("course_id")
            ->where("created_at", ">=", $todayDay)->groupBy("course_id");

        return Course::select("courses.*")
            ->join("visits", "visits.course_id", "=", "courses.id")
            ->whereNotIn("courses.id", $courses_today)
            ->where("courses.status_id", 3)
            ->whereIn("visits.user_id", $similar_users)
            ->groupBy("courses.id")
            ->limit($limit)
            ->get();
    }
    
    protected function getPopularCourses($limit = null)//Популярные курсы
    {
        return Course::select("courses.*") 
        ->where("courses.status_id", 3)
        ->withCount("visits")->orderBy("visits_count", "DESC")
        ->limit($limit)->get();
    }

    protected function getNewCourses($limit = null)//Новые курсы
    {
        return Course::select("courses.*") 
        ->where("courses.status_id", 3)
        ->orderBy("created_at", "DESC")
        ->limit($limit)->get();
    }
}
