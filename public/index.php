<?php

use HugoAndrade\ContainerDI\Container\DI;
use HugoAndrade\ContainerDI\Interfaces\TesteInterface;
use HugoAndrade\ContainerDI\Service\TesteService;
use HugoAndrade\ContainerDI\Teste;

require_once "../vendor/autoload.php";

$container1 = DI::getInstance();

$container1->set(TesteInterface::class, Teste::class);

$instance = $container1->get(TesteService::class);

dd($instance);