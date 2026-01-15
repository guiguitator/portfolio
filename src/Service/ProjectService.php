<?php

declare(strict_types=1);

namespace App\Service;

use App\Database;
use App\Model\Project;
use App\Model\Tag;
use DateTime;
use DateTimeImmutable;
use PDO;

final class ProjectService
{
    private PDO $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->getPdo();
    }

    /**
     * @return array<Project>
     */
    public function getFeaturedProjects(): array
    {
        return $this->fetchProjectsWithTags("WHERE is_featured = 1");
    }

    /**
     * @return array<Project>
     */
    public function getAllProjects(): array
    {
        return $this->fetchProjectsWithTags("");
    }

    public function getProjectBySlug(string $slug): ?Project
    {
        $projects = $this->fetchProjectsWithTags("WHERE slug = ?", [$slug]);
        return $projects[0] ?? null;
    }

    /**
     * @return array<Project>
     */
    private function fetchProjectsWithTags(string $whereClause = '', array $params = []): array
    {
        $sql = "
            SELECT 
                p.id AS project_id,
                p.name AS project_name,
                p.slug AS project_slug,
                p.caption AS project_caption,
                p.github_url AS project_github_url,
                p.documentation_url AS project_documentation_url,
                p.is_featured AS project_is_featured,
                p.content AS project_content,
                p.created_at AS project_created_at,
                p.updated_at AS project_updated_at,
                t.id AS tag_id,
                t.name AS tag_name,
                t.icon AS tag_icon
            FROM projects p
            LEFT JOIN projects_tags pt ON p.id = pt.project_id
            LEFT JOIN tags t ON pt.tag_id = t.id
            $whereClause
            ORDER BY p.created_at DESC, t.name ASC
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];

        $projectsMap = [];

        foreach ($rows as $row) {
           $projectId = (int) $row['project_id'];
           
            if (!isset($projectsMap[$projectId])) {
                $projectsMap[$projectId] = [
                    'id' => $projectId,
                    'name' => $row['project_name'],
                    'slug' => $row['project_slug'],
                    'caption' => $row['project_caption'],
                    'githubUrl' => $row['project_github_url'] ?? null,
                    'documentationUrl' => $row['project_documentation_url'] ?? null,
                    'isFeatured' => (bool) $row['project_is_featured'],
                    'content' => $row['project_content'] ?? '',
                    'createdAt' => new DateTimeImmutable($row['project_created_at']),
                    'updatedAt' => new DateTime($row['project_updated_at']),
                    'tags' => []
                ];
            }

            if ($row['tag_id'] !== null) {
                $projectsMap[$projectId]['tags'][] = new Tag(
                    id: (int) $row['tag_id'],
                    name: $row['tag_name'],
                    icon: $row['tag_icon'] ?? ''
                );
            }
        }

        $projects = [];
        foreach ($projectsMap as $data) {
            $projects[] = new Project(
                id: $data['id'],
                name: $data['name'],
                slug: $data['slug'],
                caption: $data['caption'],
                githubUrl: $data['githubUrl'],
                documentationUrl: $data['documentationUrl'],
                isFeatured: $data['isFeatured'],
                content: $data['content'],
                createdAt: $data['createdAt'],
                updatedAt: $data['updatedAt'],
                tags: $data['tags']
            );
        }

        return $projects;
    }
}
