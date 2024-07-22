<?php

namespace Testes\Abstract;

interface TestInterface
{
    public function setAwesomeMessage(string $message):void;
    public function getAwesomeMessage():string;
}
