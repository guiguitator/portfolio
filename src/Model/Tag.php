<?php

declare(strict_types=1);

namespace App\Model;

final class Tag
{
    private int $id;

    private string $name;

    private string $icon;

    public function __construct(int $id, string $name, string $icon)
    {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }
}