<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App, Auth;
class AdminController extends Controller
{
    public function listUsers(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $query = User::query()->where("users.id", "!=", $user->id);
        if($data){
            if(isset($data["text"])){
                $query->where(function($query) use ($data)
                {
                    $query->where("name", "like", "%".$data["text"]."%")
                    ->orWhere("lastname", "like", "%".$data["text"]."%");
                });
            }
            if(isset($data["roles"])){
                $query->select("users.*")
                ->join("role_user", "role_user.user_id", "=", "users.id")
                ->whereIn("role_user.role_id", $data["roles"]);
            }
        }

        $users = $query->paginate(12)->withPath("?" . $request->getQueryString());
        $roles = Role::all();
        return view("admin.list-users", compact("users", "roles"));
    }
    public function listWaitingCourses()
    {
        $courses = Course::where("status_id", 2)->paginate(12);
        return view("admin.list-waiting-courses", compact("courses"));
    }

    public function publishedCourse($course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->update(["status_id"=>3]);
        return back()->with(["success"=>trans("main.course_published")]);
    }

//ajax
    public function getRolesUser(Request $request)
    {
        $data = $request->all();
        if($data){
            $user = User::findOrFail($data["user_id"]);
            return response()->json(["roles"=>$user->roles, "username"=>$user->fullname(), "user_id"=>$user->id], 200);
        }else{
            return response()->json(["msg"=>trans('messages.error_receiving_data')], 400);
        }
    }
//ajax
    public function saveRolesUser(Request $request)
    {
        $data = $request->all();
        $data["roles"][] = 1;
        
        if($data){
            $user = User::findOrFail($data["user_id"]);
            $user->roles()->detach();
            $user->roles()->attach($data["roles"]);
            return response()->json(["msg"=>trans('messages.saved_successfully')], 200);
        }else{
            return response()->json(["msg"=>trans('messages.error_receiving_data')], 400);
        }
    }


}
