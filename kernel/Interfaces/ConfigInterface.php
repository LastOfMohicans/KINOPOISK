<?php

namespace App\Kernel\Interfaces;

interface ConfigInterface
{
    public function get(): void;

    public function getAuth(string $key, $default = null): mixed;
}
