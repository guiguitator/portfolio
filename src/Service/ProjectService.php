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

    /**
     * Retrieves all projects, ordered by creation date in descending order.
     * @return Project[] An array of all projects.
     */
    public function getAllProjects(): array
    {
        return $this->projectRepository->findBy([], ['createdAt' => 'DESC']);
    }

    /**
     * Retrieves featured projects, ordered by creation date in descending order.
     * @return Project[] An array of featured projects.
     */
    public function getFeaturedProjects(): array
    {
        return $this->projectRepository->findBy(['featured' => true], ['createdAt' => 'DESC']);
    }

    /**
     * Retrieves a project by its ID.
     * @param int $id The ID of the project to retrieve.
     * @return Project The project with the specified ID.
     */
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
