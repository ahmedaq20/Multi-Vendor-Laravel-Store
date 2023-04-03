<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Reposiotories\Cart\CartRepository;
use App\Reposiotories\Cart\CartModelRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return voidt
     */
    public function register()
    {
        // $this->app->bind(CartRepository::class, CartModelRepository::class);

         $this->app->bind(CartRepository::class, function() {
         return new CartModelRepository();
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $model = \App\Carts::class; //belongs to User module

        // $this->app->bind('\App\Repositories\Cart\CartRepository', function () use ($model) {
        //     return new CartModelRepository(new $model);
        // });
    }
}
