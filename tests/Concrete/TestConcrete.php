<?php

namespace Testes\Concrete;

use Testes\Abstract\TestInterface;

class TestConcrete implements TestInterface
{
    private string $message = '';

    public function setAwesomeMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getAwesomeMessage(): string
    {
        return $this->message;
    }
}
