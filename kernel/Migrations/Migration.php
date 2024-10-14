<?php

declare(strict_types=1);

namespace App\Kernel\Migrations;

use App\Kernel\Database\Database;
use App\Kernel\Interfaces\DatabaseInterface;

abstract class Migration
{
    protected static function getDb(): DatabaseInterface
    {
        return new Database();
    }
}
