<?php

namespace App\Http\Controllers\Profile;

use App\Models\Course;
use App\Models\Category;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Lang;
class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("profile.edit-course.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        return view("profile.edit-course.create", compact("course"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
       
        $data = $request->except("image");
        
        $data["author_id"] = Auth::user()->id;
        $data["slug"] = Str::slug($data["title"]);

        $course = new Course($data);
        $course->save();

        if (isset($request->all()["image"])) {
            Storage::disk('public')->deleteDirectory("courses/{$course->id}");
            $pathImage = $request->file("image")->store("courses/{$course->id}", 'public');
            $course->image = $pathImage;
        }

        $course->save();

        if ($course) {
            return redirect()->route("profile.course.edit", compact("course"))->with(['success' => "Курс успешно добавлен"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if (Gate::denies('edit-course', $course)) {
            return redirect()->back()->withErrors(["error" => trans('messages.not_enough_rights')]);
        }
        return view("profile.edit-course.show", compact("course"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        if (Gate::denies('edit-course', $course)) {
            return redirect()->back()->withErrors(["error" => trans('messages.not_enough_rights')]);
        }
        return view("profile.edit-course.create", compact("course"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $course = Course::find($id);

        if (empty($course)) {
            return back()->withErrors(["error" => "Запись id='{$id}' не найдена"]);
        }

        $data = $request->except("image");
      
        if (isset($request->all()["image"])) {
            Storage::disk('public')->deleteDirectory("courses/{$id}");
            $data["image"] = $request->file("image")->store("courses/{$id}", "public");
        }

        $result = $course->update($data);

        if ($result) {
            return back()->with(["success" => trans('messages.saved_successfully')]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route("profile.course.index")->with(["success" => trans('messages.successfully_deleted')]);
    }

    public function graphShow($id)
    {
        $course = Course::findOrFail($id);
        return view("profile.edit-course.graph-modules", compact("course"));
    }
    public function published($id)
    {
        $course = Course::findOrFail($id);

        if (Gate::denies('edit-course', $course)) {
            return redirect()->back()->withErrors(["error" => trans('messages.not_enough_rights')]);
        }
        
        $course->update(["status_id" => 2]);
        return redirect()->back()->with(["info" => trans('messages.course_submitted')]);
    }
    public function unpublished($id)
    {
        $course = Course::findOrFail($id);

        if (Gate::denies('edit-course', $course)) {
            return redirect()->back()->withErrors(["error" => trans('messages.not_enough_rights')]);
        }

        $course->update(["status_id" => 1]);
        return redirect()->back()->with(["info" => trans('messages.course_discontinued')]);
    }

    // public function uploadImage(Request $request)
    // {
    //     $data = $request->all();
    //     dd($data);
    //     // $user = Auth::user();
    //     if (isset($request->all()["image"])) {
    //         $data = $request->except("image");
    //         Storage::disk('public')->deleteDirectory("users-images/{$user->id}");
    //         $pathImage = $request->file("image")->store("users-images/{$user->id}", "public");
    //         $user->image = $pathImage;
    //         $user->update();
    //     }

    //     return response()->json(["image" => asset("Storage/".$pathImage), "msg"=>trans('messages.saved_successfully')], 200);
    // }
}
