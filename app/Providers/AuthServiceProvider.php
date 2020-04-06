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
            return $user->id == $course->author_id;
        });
        Gate::define('edit-module', function ($user, $module) {
            return $user->id ==$module->author_id;
        });
        Gate::define('edit-section', function ($user, $section) {
            return $user->id == $section->course->author_id;
        });
        Gate::define('edit-test', function ($user, $test) {
            return $user->id == $test->author_id;
        });
    }
}
