<?php

namespace Mateusjatenee\SimpleCart;

class Item
{
    public $id;
    private $name;
    private $quantity;
    private $price;

    public function __construct($id, $name, $quantity, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

}
