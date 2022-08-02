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
        'App\Deadline' => 'App\Policies\DeadlinePolicy',
        'App\Education' => 'App\Policies\EducationPolicy',
        'App\General_info' => 'App\Policies\GeneralInfoPolicy',
        'App\Industry_experience' => 'App\Policies\IndustryExperiencePolicy',
        'App\Most_project' => 'App\Policies\MostProjectPolicy',
        'App\Other' => 'App\Policies\OtherPolicy',
        'App\Tcase' => 'App\Policies\TcasePolicy',
        'App\Thesis_conf' => 'App\Policies\ThesisConfPolicy',
        'App\Thesis' => 'App\Policies\ThesisPolicy',
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('check', 'App\Policies\AdminPolicy@check');
        Gate::define('export', 'App\Policies\AdminPolicy@export');
        Gate::define('profile', 'App\Policies\AdminPolicy@profile');
        Gate::define('register', 'App\Policies\AdminPolicy@register');
        Gate::define('removeUsers', 'App\Policies\AdminPolicy@removeUsers');
    }
}
