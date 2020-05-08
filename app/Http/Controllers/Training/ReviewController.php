<?php

namespace App\Http\Controllers\Training;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use DB, Auth;

class ReviewController extends Controller
{
  public function createReview(Request $request)
  {
    $data = $request->all();
    $course = Course::findOrFail($data["course_id"]);
    $review = new Review();
    $review->user_id = Auth::user()->id;
    $review->course_id = $course->id;
    $review->text = $data["text"];
    if($data["stars"] == "" || $data["stars"]<1){
      $data["stars"] = null;
    }
    if($data["stars"]>5){
      $data["stars"] = 5;
    }
    $review->stars = $data["stars"];  
    $review->save();
    return back()->with(["success"=>"Отзыв успешно сохранен"]);
  }
  public function updateReview(Request $request, $id)
  {
    $data = $request->except("course_id");
    $review = Review::findOrFail($id);
    if($data["stars"] == "" || $data["stars"]<1){
      $data["stars"] = null;
    }
    if($data["stars"]>5){
      $data["stars"] = 5;
    }
    
    $review->update($data);
 
    return back()->with(["success"=>"Отзыв успешно сохранен"]);
  }

}