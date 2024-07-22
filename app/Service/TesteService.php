<?php

namespace HugoAndrade\ContainerDI\Service;

use HugoAndrade\ContainerDI\Interfaces\TesteInterface;

class TesteService
{
    public function __construct(
        private TesteInterface $repository,
        private int $number = 0,
    )
    {
        //
    }
}
