<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

final class Message
{
    private int $id;

    private string $username;

    private string $email;

    private string $subject;

    private string $content;

    private DateTimeImmutable $createdAt;

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $subject,
        string $content,
        DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->subject = $subject;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}