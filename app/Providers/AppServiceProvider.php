<?php

namespace App\Providers;


use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\EloquentBookRepository;
use App\Repositories\EloquentAuthorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, EloquentBookRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class, EloquentAuthorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
