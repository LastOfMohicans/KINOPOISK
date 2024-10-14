<?php

namespace App\Kernel\Interfaces;

interface DatabaseInterface
{
    //public function insert(string $table, array $data): int|false;
    public function run(string $sql, array $data): mixed;
    public function getAll(string $sql, array $conditions = []): ?array;
}
