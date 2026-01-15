<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;
use App\Config\DatabaseConfig;

final class Database
{
    private PDO $pdo;

    public function __construct(DatabaseConfig $dbConfig)
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $dbConfig->host,
            $dbConfig->port,
            $dbConfig->name
        );

        try {
            $this->pdo = new PDO($dsn, $dbConfig->user, $dbConfig->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $exception) {
            http_response_code(500);
            exit('Database connection failed: ' . $exception->getMessage());
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
