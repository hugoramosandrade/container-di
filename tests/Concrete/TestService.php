<?php

namespace Testes\Concrete;

use Testes\Abstract\TestInterface;

class TestService
{
    public function __construct(
        private TestInterface $concrete,
        private int $numberParam = 10
    )
    {
        //
    }

    public function returnMessage(string $message): string
    {
        $this->concrete->setAwesomeMessage($message);
        return $this->concrete->getAwesomeMessage();
    }

    public function getNumberDefaultValue(): int
    {
        return $this->numberParam;
    }
}
