<?php

namespace Mateusjatenee\SimpleCart\Providers;

use Illuminate\Support\ServiceProvider;

class SimpleCartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('cart', Cart::class);
    }
}
