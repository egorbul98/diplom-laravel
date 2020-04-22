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

// Route::get("search", 'HomeController@search');

Route::get("category/{category_slug}", 'HomeController@category')->name("category");
Route::get('course/search', 'CourseController@search')->name("course.search");
Route::resource('course', 'CourseController')->only(["index", "show"])->names("course");


Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'training', "namespace" => "training"], function () {
        
        Route::post('course/{course_id}', "TrainingController@startCourse")->name("training.startCourse");
        Route::get('course/{course_id}', "TrainingController@course")->name("training.course");
        
        Route::group(['middleware' => ['checkCourse']], function () {
            Route::get('course/{course_id}/section/{section_id}', "TrainingController@section")->name("training.section");
            Route::get('course/{course_id}/section/{section_id}/module/{module_id}/step/{step_num?}/test', "TrainingController@test")->name("training.test");
            Route::get('course/{course_id}/section/{section_id}/module/{module_id}/step/{step_num?}', "TrainingController@module")->name("training.module");
            Route::post('course/{course_id}/section/{section_id}/module/{module_id}', "TrainingController@startModule")->name("training.startModule");
        });
        Route::post('course/{course_id}/section/{section_id}/module/{module_id}/step/{step_id}', "TrainingController@checkAnswer")->name("training.step-check-answer");
        Route::post('module/completed', "TrainingController@moduleCompleted")->name("training.module-completed");
        Route::post('test/completed', "TrainingController@testCompleted")->name("training.test-completed");

        //Тесты забывших модулей
        Route::get('course/{course_id}/forgot-test', "TrainingController@forgotTest")->name("training.forgotTest");
        Route::post('forgot-test/completed', "TrainingController@testForgotCompleted")->name("training.forgot-test-completed");
    });

    Route::group(['prefix' => 'profile', "namespace" => "Profile"], function () {
        Route::get('', "ProfileController@index")->name("profile");
        Route::get('course/{course_id}/graph', "CourseController@graphShow")->name("profile.course.graph");
        Route::resource('course', 'CourseController')->names("profile.course");

        Route::get('/ajax-get-course-sections', 'AjaxCourseController@getSections');

        Route::get('/module', "ModuleController@index")->name("profile.module.index");
        Route::get('/module/{module_id}/step/{step_id?}', "ModuleController@edit")->name("profile.module.edit");

        Route::get('/test/{test_id}/delete', "TestController@delete")->name("profile.test.delete");
        Route::resource('test', 'TestController')->only(["update", "edit", "store", "create", "index"])->names("profile.test");

        Route::get('/ajax-get-tests-for-module', "AjaxTestController@getTests");
        Route::post('/ajax-attach-test-for-module', "AjaxTestController@attachTest");
        Route::post('/ajax-detach-module-from-test', "AjaxTestController@detachModule");
        Route::get('/ajax-search-modules-for-test', "AjaxTestController@searchModule");
        Route::get('/ajax-search-tests-for-module', "AjaxTestController@searchTest");
        Route::get('/ajax-get-modules-for-test', "AjaxTestController@getModules");
        Route::post('/ajax-add-modules-for-test', "AjaxTestController@attachModule");

        Route::post('/ajax-save-test-section', "AjaxTestController@saveTestSection");
        Route::post('/ajax-add-test-section', "AjaxTestController@addTestSection");
        Route::post('/ajax-delete-test-section', "AjaxTestController@deleteTestSection");
        Route::get('/ajax-get-test-section', "AjaxTestController@getTestSection");
        Route::post('/ajax-upload-image', "AjaxTestController@uploadImage");

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
            Route::get('{module}/section/{section?}/{step_id?}', "EditorModuleController@edit")->name("profile.course.module.edit");

            Route::post('{module}', "EditorModuleController@save")->name("profile.course.module.save");

            Route::post('{module_id}/{step_type_id}/{section?}', 'StepController@store')->name("profile.module.step.store");
            Route::post('{module_id}/step/{step_id}/store', 'StepController@update')->name("profile.module.step.update");
            Route::get('{module_id}/destroy-step/{step_id}/section/{section?}', 'StepController@destroy')->name("profile.module.step.destroy");
        });
    });
});



view()->composer(['*'], function ($view) {
    $categories = \App\Models\Category::all();
    $user = Auth::user();
    $view->with(["categories" => $categories, "user" => $user]);
});



Auth::routes();
