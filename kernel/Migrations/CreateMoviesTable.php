<?php

namespace App\Kernel\Migrations;

use App\Kernel\Interfaces\MigrationInterface;

class CreateMoviesTable extends Migration implements MigrationInterface
{
    private const TABLE = 'movies';
    
    public static function up(): void
    {
        $db = static::getDb();
        $sql = 'CREATE TABLE IF NOT EXISTS ' . static::TABLE . '(
            id SERIAL,
            category_id INT(11),
            name VARCHAR(255),
            description MEDIUMTEXT,
            preview VARCHAR(255),
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )';

        $db->run($sql, []);
        echo 'Create Table ' . static::TABLE . ' successfully!!!';
    }

    public static function down(): void
    {
        $db = static::getDb();
        $sql = 'DROP TABLE IF EXISTS '  . static::TABLE;
        $db->run($sql, []);
        echo 'Drop Table ' . static::TABLE . ' successfully!!!';
    }
}
