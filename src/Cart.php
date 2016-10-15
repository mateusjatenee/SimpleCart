<?php

namespace Mateusjatenee\SimpleCart;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use Mateusjatenee\SimpleCart\Item;

class Cart
{
    private $sessionManager;

    private $dispatcher;

    private $cartName = 'default';

    public function __construct(SessionManager $session, Dispatcher $dispatcher)
    {
        $this->session = $session;
        $this->dispatcher = $dispatcher;
    }

    public function add($id, $name, $quantity = 1, $price)
    {
        $item = $this->createItem($id, $name, $quantity, $price);

        return $item;
    }

    public function content()
    {
        if (!$this->hasItems()) {
            return new Collection([]);
        }

        return $this->session->get($this->cartName);
    }

    private function hasItems()
    {
        return $this->getContent();
    }

    private function getContent()
    {
        return $this->session->get($this->cartName) ?? new Collection();
    }

    private function createItem($id, $name, $quantity, $price)
    {
        $item = new Item($id, $name, $quantity, $price);

        $content = $this->getContent();

        $content->put($item->id, $item);

        $this->session->put($this->cartName, $content);

        return $item;
    }

}
