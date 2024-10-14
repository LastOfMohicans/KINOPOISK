<?php

namespace App\Kernel\Interfaces;

interface ViewInterface
{
    public function page(
        string $name, array $data = [], string $title = ''): void;

    public function components(string $name): void;

    public function title(): string;
}
