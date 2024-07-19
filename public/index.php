<?php

use HugoAndrade\ContainerDI\Container\DI;
use HugoAndrade\ContainerDI\Interfaces\TesteInterface;
use HugoAndrade\ContainerDI\Service\TesteService;
use HugoAndrade\ContainerDI\Teste;

require_once "../vendor/autoload.php";

$container = new DI;

$container->set(TesteInterface::class, Teste::class);

dd($container->get(TesteService::class));