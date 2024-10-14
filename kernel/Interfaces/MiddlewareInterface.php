<?php

namespace App\Kernel\Interfaces;

interface MiddlewareInterface
{
    public function check(array $middlewares = []): void;
}
