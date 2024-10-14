<?php

namespace App\Kernel\Database;

use App\Kernel\Config\Config;
use App\Kernel\Exceptions\DbConnectException;
use App\Kernel\Interfaces\ConfigInterface;
use PDO;
use App\Kernel\Interfaces\DatabaseInterface;

class Database implements DatabaseInterface
{

    private $pdo;
   

    public function __construct()
    {
        try {
            $this->connect();
        } catch (\Exception $ex) {
            throw new DbConnectException("Error Db Connection", 1);
        }
    }

    
    public function run(string $sql, array $data): mixed
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }

    public function getAll(string $sql, array $conditions =[]): ?array
    {
        $stmt = $this->run($sql, $conditions);
        $result =  $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    public function getArrays(string $sql, array $conditions =[]): ?array
    {
        $stmt = $this->run($sql, $conditions);
        $result =  $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    private function connect(): void
    {
        $this->config()->get();
        $this->pdo = new PDO(DSN, USER, PASSWORD);
    }

    private function config(): Config
    {
        $config = new Config();
        return $config;
    }

    public function getLastId(): int
    {
        return $this->pdo->lastInsertId();
    }
}
