<?php

namespace App\Models;

use App\Kernel\Database\Database;
use App\Kernel\Interfaces\ModelInterface;

abstract class Model implements ModelInterface
{
    private function getDb(): Database
    {
        $db = new Database();
        return $db;
    }
    public function insert(string $table, array $data): int|false
    {
        $db = $this->getDb();
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";
        $db->run($sql, $data);

        return (int) $db->getLastId() ?? false;
    }

    public function first(string $table, array $conditions = []): ?array
    {
        $db = $this->getDb();
        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE ' . implode(
                ' AND ',
                array_map(
                    fn ($field) => "$field = :$field",
                    array_keys($conditions)
                )
            );
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $result = $db->getAll($sql, $conditions);

        return $result ?: null;
    }

    public function get(
        string $table,
        array $conditions = [],
        array $order = [],
        int $limit = -1
    ): ?array {
        $db = $this->getDb();
        $where = '';
        if (count($conditions) > 0) {
            $where = 'WHERE ' . implode(
                ' AND ',
                array_map(
                    fn ($field) => "$field = :$field",
                    array_keys($conditions)
                )
            );
        }

        $sql = "SELECT * FROM $table $where";

        if (count($order) > 0) {
            $sql .= ' ORDER BY ' . implode(', ', array_map(fn ($field, $direction) => "$field $direction", array_keys($order), $order));
        }

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }        

        $result = $db->getArrays($sql, $conditions);

        return $result ?: null;
    }

    public function delete(string $table, array $conditions = []): void
    {
        $db = $this->getDb();
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE ' . implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "DELETE FROM $table $where";

        $db->run($sql, $conditions);
    }

    public function update(
        string $table,
        array $data,
        array $conditions = []
    ): void {
        $db = $this->getDb();

        $fields = array_keys($data);

        $set = implode(', ', array_map(fn ($field) => "$field = :$field", $fields));

        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE ' . implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "UPDATE $table SET $set $where";

        $merge = array_merge($data, $conditions);

        $db->run($sql, $merge);
    }
}
