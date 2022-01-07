<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Faculties\FacultyReponsitoryInterface::class,
            \App\Repositories\Faculties\FacultyReponsitory::class
        );
        $this->app->singleton(
            \App\Repositories\Students\StudentReponsitoryInterface::class,
            \App\Repositories\Students\StudentReponsitory::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
