<?php

namespace App\Http\Controllers\Profile;

use App\Models\Course;
use App\Models\Category;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $categories = Category::all();
        $course = new Course();
        return view("profile.edit-course.create", compact("course", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $data = $request->all();
        $data["author_id"] = Auth::user()->id;
        $data["slug"] = Str::slug($data["title"]);
      
        $course = new Course($data);
        $course->save();
        if($course){
            return redirect()->route("profile.course.index")->with(['success'=>"Курс успешно добавлен"]);
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
        $categories = Category::all();

        return view("profile.edit-course.create", compact("course", "categories"));
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
      
       if(empty($course)){
           return back()->withErrors(["error"=>"Запись id='{$id}' не найдена"]);
       }
      
       $data = $request->all();
       
       $result = $course->update($data);
      
       if($result){
            return back()->with(["success"=>"Успешно сохранено"]);
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
        return redirect()->route("profile.course.index")->with(["success"=>"Курс успешно удален"]);
    }
}
