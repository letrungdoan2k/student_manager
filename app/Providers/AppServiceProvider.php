<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
            \App\Repositories\Faculties\FacultyRepositoryInterface::class,
            \App\Repositories\Faculties\FacultyRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Students\StudentRepositoryInterface::class,
            \App\Repositories\Students\StudentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Subjects\SubjectRepositoryInterface::class,
            \App\Repositories\Subjects\SubjectRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
