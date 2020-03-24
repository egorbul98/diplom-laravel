<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/home', function () {
//     return view('home');
// });

Route::get("home", 'HomeController@index')->name("home");
Route::get("/", 'HomeController@index');


Route::resource('course', 'CourseController')->only(["index", "show"])->names("course");

Route::group(['prefix' => 'profile', "namespace"=>"Profile"], function () {
    Route::get('', "ProfileController@index")->name("profile");
    Route::resource('course', 'CourseController')->names("profile.course");

    Route::get('course/{course}/sections', "EditorSectionController@edit")->name("profile.course.sections.edit");
});

Auth::routes();
