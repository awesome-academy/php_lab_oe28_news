<?php

namespace App\Providers;

use App\Http\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

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
            \App\Repositories\News\NewsRepositoryInterface::class,
            \App\Repositories\News\NewsRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Comment\CommentRepositoryInterface::class,
            \App\Repositories\Comment\CommentRepository::class
        );

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::with(['parent', 'children'])->get();
        View::share('categories', $categories);
    }
}
