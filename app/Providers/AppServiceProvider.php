<?php

namespace App\Providers;

use App\Services\Book\Repositories\BookRepository;
use App\Services\Book\Repositories\BookUsesJenssegersMongodbEloquentRepository;
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
        $this->bookBind();
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

    private function bookBind()
    {
        $this->app->bind(
            BookRepository::class,
            BookUsesJenssegersMongodbEloquentRepository::class
        );
    }
}
