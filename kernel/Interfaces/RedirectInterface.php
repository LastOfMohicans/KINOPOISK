<?php

namespace App\Kernel\Interfaces;

interface RedirectInterface
{
    public function to(string $url): void;
}
