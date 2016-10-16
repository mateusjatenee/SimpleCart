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

        $item = $this->addItem($cart);

        $this->assertInstanceOf(Item::class, $cart->content()->first());
        $this->assertEquals($item, $cart->content()->first());
    }

    /** @test */
    public function it_finds_items_in_the_cart()
    {
        $cart = $this->getCart();

        $created_item = $this->addItem($cart);

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

    /** @test */
    public function it_edits_an_item()
    {
        $cart = $this->getCart();

        $item = $this->addItem($cart);

        $new_attributes = [
            'id' => 41,
            'name' => 'Nice T-Shirt',
            'quantity' => 5,
            'price' => 30,
        ];

        $item->update($new_attributes);

        $this->assertEquals($new_attributes, $item->toArray());
    }

    private function addItem($cart, $id = 123, $name = 'Regular T-Shirt', $quantity = 1, $price = 20)
    {
        return $cart->add($id, $name, $quantity, $price);
    }

    private function getCart()
    {
        $session_manager = $this->app->make('session');
        $dispatcher = $this->app->make('events');

        return new Cart($session_manager, $dispatcher);
    }
}
