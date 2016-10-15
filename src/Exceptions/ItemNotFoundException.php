<?php

namespace Mateusjatenee\SimpleCart\Exceptions;

class ItemNotFoundException extends \Exception
{
    private $itemId;

    public function setItemId($id)
    {
        $this->itemId = $id;

        $this->message = "Item of id {$id} was not found.";

        return $this;
    }

}
