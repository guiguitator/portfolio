<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Service\ProjectService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AppController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProjectService $projectService
    ) {}

    #[Route('/', name: 'app_home_index')]
    #[Route('/home', name: 'app_home')]
    public function home(Request $request): Response
    {
        $message = new Message();

        $messageForm = $this->createForm(MessageType::class, $message);
        $messageForm -> handleRequest($request);

        if ($messageForm->isSubmitted()) {

            if ($messageForm->isValid()) {

                $message = $messageForm->getData();

                $this->entityManager->persist($message);
                $this->entityManager->flush();

                $this->addFlash('success', 'Votre message a bien été enregistré.');
            } else {
                $this->addFlash('danger', 'Une erreur s\'est produite.');
            }

            return $this->redirectToRoute('app_home');
        }

        return $this->render('app/home.html.twig', [
            'featured_projects' => $this->projectService->getFeaturedProjects(),
            'message_form' => $messageForm
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
