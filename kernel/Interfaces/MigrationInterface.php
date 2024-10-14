<?php

namespace App\Kernel\Interfaces;

interface MigrationInterface
{
    public static function up(): void;

    public static function down(): void;
}
