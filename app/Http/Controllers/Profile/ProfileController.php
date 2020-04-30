<?php

namespace App\Http\Controllers\Profile;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Gate, Auth, Storage;
class ProfileController extends BaseController
{
    public function index()
    {
        return view("profile.index");
    }
    
    // public function tests()
    // {
    //     return view("profile.test.index");
    // }
    
    public function settings()
    {
        return view("profile.user-settings");
    }

    public function saveSettings(UserRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $user->update($data);
        return back()->with(["success"=>trans('messages.saved_successfully')]);
    }
    public function uploadAvatar(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        if (isset($request->all()["image"])) {
            $data = $request->except("image");
            Storage::disk('public')->deleteDirectory("users-images/{$user->id}");
            $pathImage = $request->file("image")->store("users-images/{$user->id}", "public");
            $user->image = $pathImage;
            $user->update();
        }

        return response()->json(["image" => asset("Storage/".$pathImage), "msg"=>trans('messages.saved_successfully')], 200);
    }
}
