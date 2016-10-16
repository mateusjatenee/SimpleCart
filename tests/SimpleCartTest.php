<?php

namespace Mateusjatenee\SimpleCart\Tests;

use Mateusjatenee\SimpleCart\Cart;
use Mateusjatenee\SimpleCart\Exceptions\ItemNotFoundException;
use Mateusjatenee\SimpleCart\Item;
use Mateusjatenee\SimpleCart\Providers\SimpleCartServiceProvider;
use Mateusjatenee\SimpleCart\SimpleCart;

class SimpleCartTest extends \Orchestra\Testbench\TestCase
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

    /** @test */
    public function it_finds_items_in_the_cart()
    {
        $cart = $this->getCart();

        $created_item = $cart->add(123, 'Regular T-Shirt', 1, 20);

        $item = $cart->find(123);

        $this->assertEquals($created_item, $item);
    }

    /** @test */
    public function it_throws_exception_if_item_is_not_found()
    {
        $this->setExpectedException(ItemNotFoundException::class, 'Item of id 123 was not found.');

        $cart = $this->getCart();

        $cart->find(123);
    }

    private function getCart()
    {
        $session_manager = $this->app->make('session');
        $dispatcher = $this->app->make('events');

        return new Cart($session_manager, $dispatcher);
    }
}
