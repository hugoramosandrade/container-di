<?php

namespace Testes\Concrete;

use Testes\Abstract\TestInterface;

class TestErrorClass
{
    public function __construct(
        private TestInterface $concrete,
        private int $number
    )
    {
        //
    }
}
