<?php

namespace App\Kernel\Migrations;


use App\Kernel\Interfaces\MigrationInterface;

class CreateTestTable extends Migration implements MigrationInterface
{
    private const TABLE = 'test';
    
    public static function up(): void
    {
        $db = static::getDb();
        $sql = 'CREATE TABLE IF NOT EXISTS ' . static::TABLE .'(
            id SERIAL,
            name VARCHAR(255)
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
