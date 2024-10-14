<?php

declare(strict_types=1);

namespace App\Kernel\Migrations;

class CreateCategoriesTable extends Migration
{
    private const TABLE = 'categories';

    public static function up(): void
    {
        $db = static::getDb();
        $sql = 'CREATE TABLE IF NOT EXISTS ' . static::TABLE . '(
            id SERIAL,
            name VARCHAR(255),            
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )';

        $db->run($sql, []);
        echo 'Create Table ' . static::TABLE . ' successfully!!!';
    }

    public static function down(): void
    {
        $db = static::getDb();
        $sql = 'DROP TABLE IF EXISTS ' . static::TABLE;
        $db->run($sql, []);
        echo 'Drop Table ' . static::TABLE . ' successfully!!!';
    }
}
