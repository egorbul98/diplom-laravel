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
    Route::post('course/{course}/sections', "EditorSectionController@save")->name("profile.course.sections.save");
    

    Route::post('/ajax-add-section', "AjaxSectionController@add");
    Route::post('/ajax-del-section', "AjaxSectionController@delete");

    Route::post('/ajax-add-module', "AjaxModuleController@add");
    Route::post('/ajax-del-module', "AjaxModuleController@delete");

    Route::post('/ajax-add-competence', "AjaxCompetenceController@add");
    Route::post('/ajax-del-competence', "AjaxCompetenceController@delete");

    Route::get('course/module/{module}/{step_id?}', "EditorModuleController@edit")->name("profile.course.module.edit");
    Route::post('course/module/{module}', "EditorModuleController@save")->name("profile.course.module.save");

    // Route::resource('course/module/{module}/step/', 'StepController')->only("store", "destroy")->names("profile.module.step");;
    Route::resource('course/module/{id_module}/step_type/{id_step_type}', 'StepController')->only("store", "destroy")->names("profile.module.step");;
});


Auth::routes();
