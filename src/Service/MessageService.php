<?php

declare(strict_types=1);

namespace App\Service;

use App\Database;
use Exception;
use PDO;

final class MessageService
{
    private PDO $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->getPdo();
    }

    public function sendMessage(string $username, string $email, string $subject, string $content): bool
    {
        try {
            $sql = "INSERT INTO messages (username, email, subject, content) VALUES (?, ?, ?, ?);";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$username, $email, $subject, $content]);

            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}