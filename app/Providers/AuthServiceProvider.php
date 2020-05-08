<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-course', function ($user, $course) {
            $admin = $user->roles()->where("role_id", 2)->first() != null;
            
            return $user->id == $course->author_id || $admin;
        });
        Gate::define('edit-module', function ($user, $module) {
            $admin = $user->roles()->where("role_id", 2)->first() != null;
            return $user->id ==$module->author_id || $admin;
        });
        Gate::define('edit-section', function ($user, $section) {
            $admin = $user->roles()->where("role_id", 2)->first() != null;
            return $user->id == $section->course->author_id || $admin;
        });
        Gate::define('edit-test', function ($user, $test) {
            $admin = $user->roles()->where("role_id", 2)->first() != null;
            return $user->id == $test->author_id || $admin;
        });

        Gate::define('show-course', function($user, $course){
            return $user->progress_courses()->where("course_id", $course->id)->first() != null;
        });
        Gate::define('show-section', function($user, $course, $section){
            return $section->course_id == $course->id;
        });
        Gate::define('show-module', function($user, $course, $section, $module){
            return $user->progress_modules()->where("module_id", $module->id)->where("section_id", $section->id)->first() != null;
        });
    }
}
