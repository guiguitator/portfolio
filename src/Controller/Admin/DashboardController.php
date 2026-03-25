<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration')
            ->setLocales([
                'fr' => '🇫🇷 Français'
            ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-table-columns');
        yield MenuItem::section('Boîte de réception');
        yield MenuItem::linkTo(MessageCrudController::class, 'Messages', 'fas fa-envelope');
        yield MenuItem::section('Contenus');
        yield MenuItem::linkTo(ProjectCrudController::class, 'Projets', 'fas fa-briefcase');
        yield MenuItem::linkTo(TagCrudController::class, 'Tags', 'fas fa-tag');
        yield MenuItem::section('Autres');
        yield MenuItem::linkToRoute('Accueil', 'fas fa-home', 'app_home');
        yield MenuItem::linkToLogout('Déconnexion', 'fas fa-right-from-bracket');
    }
}
