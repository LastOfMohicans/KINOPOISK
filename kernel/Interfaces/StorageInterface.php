<?php

namespace App\Kernel\Interfaces;

interface StorageInterface
{
    public function url(string $path): string;

    public function get(string $path): string;
}
