<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        when there is a n+1 problem it will display an error page
        Model::preventLazyLoading(true);

//        it ll be replaced by the policy (jobpolicy)
//        Gate::define('edit-job', function (User $user, Job $job) {
//            return $job->employer->user->is($user);
//        });
    }
}
