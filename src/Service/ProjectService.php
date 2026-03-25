<?php

namespace App\Service;

use App\Entity\Project;
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
}
