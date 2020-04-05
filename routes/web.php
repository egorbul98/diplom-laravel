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

Route::get("category/{category_slug}", 'HomeController@category')->name("category");
Route::resource('course', 'CourseController')->only(["index", "show"])->names("course");


Route::group(['prefix' => 'profile', "namespace"=>"Profile", "middleware"=>"auth"], function () {
    Route::get('', "ProfileController@index")->name("profile");
    Route::resource('course', 'CourseController')->names("profile.course");

    Route::get('course/{course}/sections', "EditorSectionController@edit")->name("profile.course.sections.edit");
    Route::post('course/{course}/sections', "EditorSectionController@save")->name("profile.course.sections.save");
    
    Route::post('/ajax-add-section', "AjaxSectionController@add");
    Route::post('/ajax-del-section', "AjaxSectionController@delete");
    Route::get('/ajax-list-modules-section', "AjaxSectionController@listModules");
    Route::get('/ajax-search-modules-section', "AjaxSectionController@searchModules");
    Route::post('/ajax-add-module-in-section', "AjaxSectionController@addModule");

    Route::post('/ajax-add-module', "AjaxModuleController@add");
    Route::post('/ajax-del-module', "AjaxModuleController@delete");

    Route::post('/ajax-add-competence', "AjaxCompetenceController@add");
    Route::post('/ajax-del-competence', "AjaxCompetenceController@delete");

    Route::post('/ajax-add-answer-num', "AjaxAnswersController@addAnswerNum");
    Route::post('/ajax-add-answer-string', "AjaxAnswersController@addAnswerString");
    Route::post('/ajax-del-answer-num', "AjaxAnswersController@deleteAnswerNum");
    Route::post('/ajax-del-answer-string', "AjaxAnswersController@deleteAnswerString");

    Route::post('/ajax-update-module-data', "AjaxModuleDataController@update");
    

    Route::group(['prefix' => 'course/module'], function () {
        Route::get('{module}/section/{section}/{step_id?}', "EditorModuleController@edit")->name("profile.course.module.edit");
        Route::post('{module}', "EditorModuleController@save")->name("profile.course.module.save");

        Route::post('{module_id}/section/{section}/step_type/{step_type_id}', 'StepController@store')->name("profile.module.step.store");;
        Route::post('{module_id}/step/{step_id}', 'StepController@update')->name("profile.module.step.update");;
        Route::get('{module_id}/section/{section}/destroy-step/{step_id}', 'StepController@destroy')->name("profile.module.step.destroy");;
    });
   
});


view()->composer(['*'], function ($view) {
    $categories = \App\Models\Category::all();
    $user = Auth::user();
    $view->with(["categories"=>$categories, "user"=>$user]);
});


Auth::routes();
