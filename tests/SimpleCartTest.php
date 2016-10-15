<?php

namespace Mateusjatenee\SimpleCart\Tests;

use Mateusjatenee\SimpleCart\Cart;
use Mateusjatenee\SimpleCart\Item;
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

        $item = $cart->add(123, 'Regular T-Shirt', 1, 20);

        $this->assertInstanceOf(Item::class, $cart->content()->first());
        $this->assertEquals($item, $cart->content()->first());
    }

    private function getCart()
    {
        $session_manager = $this->app->make('session');
        $dispatcher = $this->app->make('events');

        return new Cart($session_manager, $dispatcher);
    }
}
