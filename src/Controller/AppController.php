<?php

namespace App\Controller;

use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AppController extends AbstractController
{
    public function __construct(
        private ProjectService $projectService
    ) {}

    #[Route('/', name: 'app_home_index')]
    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('app/home.html.twig', [
            'featured_projects' => $this->projectService->getFeaturedProjects()
        ]);
    }

    #[Route('/projects', name: 'app_projects')]
    public function projects(): Response
    {
        return $this->render('app/projects.html.twig', [
            'projects' => $this->projectService->getAllProjects()
        ]);
    }

    #[Route('/projects/{id}', name: 'app_project_details')]
    public function projectDetails(int $id): Response
    {
        return $this->render('app/project_details.html.twig', [
            'project' => $this->projectService->getProjectById($id)
        ]);
    }
}
