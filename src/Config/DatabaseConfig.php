<?php

declare(strict_types=1);

namespace App\Config;

use RuntimeException;

final readonly class DatabaseConfig
{
    public string $host;

    public int $port;

    public string $name;

    public string $user;
    
    public string $pass;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST']   ?? throw new RuntimeException('DB_HOST is missing');
        $this->port = (int) ($_ENV['DB_PORT'] ?? throw new RuntimeException('DB_PORT is missing'));
        $this->name = $_ENV['DB_NAME']   ?? throw new RuntimeException('DB_NAME is missing');
        $this->user = $_ENV['DB_USER']   ?? throw new RuntimeException('DB_USER is missing');
        $this->pass = $_ENV['DB_PASS']   ?? throw new RuntimeException('DB_PASS is missing');
    }
}