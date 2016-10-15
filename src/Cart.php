<?php

namespace Mateusjatenee\SimpleCart;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Session\SessionManager;

class Cart
{
    private $sessionManager;
    private $dispatcher;

    public function __construct(SessionManager $sessionManager, Dispatcher $dispatcher)
    {
        $this->sessionManager = $sessionManager;
        $this->dispatcher = $dispatcher;
    }

}
