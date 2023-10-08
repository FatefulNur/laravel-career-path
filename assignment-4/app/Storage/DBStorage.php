<?php

namespace App\Storage;

use App\Contract\Storage;
use PDO;

class DBStorage implements Storage
{
    private ?PDO $conn;

    public function __construct() {
        $dbConfig = config("database");
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $dbConfig->hostname . ";dbname=" . $dbConfig->databasename, 
                $dbConfig->username, 
                $dbConfig->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
          }
    }
    
    public function createTable(string $sql)
    {
        try {
            $this->conn->exec($sql);
          } catch(\PDOException $e) {
            die($sql . PHP_EOL . $e->getMessage());
          }
    }

    public function load(string $model): array
    {
        $sql = "SELECT `data` FROM $model ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return array_map(
            fn ($item) => unserialize($item['data']), 
            $stmt->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function store(string $model, array $data): void
    {
        $sql = "INSERT INTO `$model` (`data`) VALUES (?)";
        $stmt = $this->conn->prepare($sql);

        $lastRecord = end($data);
        $binary_data = serialize($lastRecord);

        $stmt->execute([$binary_data]);
    }

    public function __destruct()
    {
        $this->conn = null;   
    }
}