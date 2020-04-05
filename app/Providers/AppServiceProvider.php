<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Section;
use App\Models\Course;
use App\Models\Module;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Section::deleted(function ($section) {
            foreach ($section->modules as $module) {
                $module->sections()->detach($section->id);
                // if($module->steps->count()==0){
                //     $module->delete();
                // }
              
            }
        });

        Course::deleted(function ($course) {
            foreach ($course->sections as $section) {
                foreach ($section->modules as $module) {
                    $module->sections()->detach($section->id);
                    // if($module->steps->count()==0){
                    //     $module->delete();
                    // }
                }
            }
            $course->sections()->delete();
        });
    }
}
