<?php

namespace App\Kernel\Interfaces;

interface RouterInterface
{
    public function dispatch(string $uri, string $method): void;
}
