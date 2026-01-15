<?php

declare(strict_types=1);

namespace App\Model;

use DateTime;
use DateTimeImmutable;

final class Project
{
    private int $id;

    private string $name;

    private string $slug;

    private string $caption;

    private ?string $githubUrl;

    private ?string $documentationUrl;

    private bool $isFeatured;

    private string $content;

    private DateTimeImmutable $createdAt;

    private DateTime $updatedAt;

    /** @var array<Tag> */
    private array $tags = [];

    public function __construct(
        int $id,
        string $name,
        string $slug,
        string $caption,
        ?string $githubUrl,
        ?string $documentationUrl,
        bool $isFeatured,
        string $content,
        DateTimeImmutable $createdAt,
        DateTime $updatedAt,
        array $tags = [],
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->caption = $caption;
        $this->githubUrl = $githubUrl;
        $this->documentationUrl = $documentationUrl;
        $this->isFeatured = $isFeatured;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->tags = $tags;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getCaption(): string
    {
        return $this->caption;
    }

    public function getGithubUrl(): ?string
    {
        return $this->githubUrl;
    }

    public function getDocumentationUrl(): ?string
    {
        return $this->documentationUrl;
    }

    public function isFeatured(): bool
    {
        return $this->isFeatured;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return array<Tag>
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}