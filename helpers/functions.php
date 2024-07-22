<?php

use HugoAndrade\ContainerDI\Container\DI;

if (!function_exists('container')) {
    function container(?string $abstract = null): mixed {
        $container = DI::getInstance();
        if (is_null($abstract))
            return $container;

        return $container->get($abstract);
    }
}