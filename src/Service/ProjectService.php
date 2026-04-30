<?php

namespace App\Service;

use App\Entity\Project;
use App\Entity\Tag;
use App\Repository\ProjectRepository;

class ProjectService
{
    public function __construct(
        private ProjectRepository $projectRepository
    ) {}

    public function getAllProjects(): array
    {
        return $this->projectRepository->findAll();
    }

    public function getFeaturedProjects(): array
    {
        return $this->projectRepository->findBy(['featured' => true]);
    }

    public function getProjectById(int $id): Project
    {
        return $this->projectRepository->findOneBy(['id' => $id]);
    }

    /**
     * Retrieves projects associated with a specific tag.
     * @param Tag $tag The tag to filter projects by.
     * @return Project[] An array of projects that have the specified tag.
     */
    public function getProjectsByTag(Tag $tag): array
    {
        return $this->projectRepository->findByTag($tag);
    }
}
