<?php

namespace App\Kernel\Migrations;

use App\Kernel\Interfaces\MigrationInterface;

class CreateUsersTable extends Migration implements MigrationInterface
{
    private const TABLE = 'users';

    public static function up(): void
    {
        $db = static::getDb();
        $sql = 'CREATE TABLE IF NOT EXISTS ' . static::TABLE . '(
            id SERIAL,
            name VARCHAR(255),
            email VARCHAR(255) UNIQUE,
            password VARCHAR(255),
            is_admin BOOLEAN NOT NULL DEFAULT FALSE,
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
