<?php

namespace Mateusjatenee\SimpleCart\Tests;

use Mateusjatenee\SimpleCart\Cart;
use Mateusjatenee\SimpleCart\Providers\SimpleCartServiceProvider;
use Mateusjatenee\SimpleCart\SimpleCart;
use Orchestra\Testbench\TestCase;

class SimpleCartTest extends TestCase
{

    /**
     * Set the package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [SimpleCartServiceProvider::class];
    }

    /** @test */
    public function it_adds_items_to_a_cart()
    {
        $cart = $this->getCart();

        $cart->add(123, 'Regular T-Shirt', 1, 20);

        $this->assertEquals([
            [
                'id' => 123,
                'name' => 'Regular T-Shirt',
                'quantity' => 1,
                'price' => 20,
            ],
        ], $cart->content()->all());
    }

    private function getCart()
    {
        $session_manager = $this->app->make('session');
        $dispatcher = $this->app->make('events');

        return new Cart($session_manager, $dispatcher);
    }
}
