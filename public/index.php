<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;
use App\Service\MessageService;
use App\Service\ProjectService;
use Dotenv\Dotenv;
use App\Config\DatabaseConfig;
use Pecee\SimpleRouter\SimpleRouter;

define('PROJECT_ROOT', dirname(__DIR__));
define('BASE_PATH', '/portfolio/public');


/* Database configuration & Service */

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$dotenv->required(['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS'])->notEmpty();

$dbConfig = new DatabaseConfig();
$database = new Database($dbConfig);

$projectService = new ProjectService($database);
$messageService = new MessageService($database);


/* Router */

SimpleRouter::get('/', function () use ($projectService): void {
    $pageTitle = 'Accueil';
    $contentFile = PROJECT_ROOT . '/templates/pages/home.php';
    require PROJECT_ROOT . '/templates/layout.php';
});

SimpleRouter::get('/home', function (): never {
    header('Location: /');
    exit;
});

SimpleRouter::get('/projects', function () use ($projectService): void {    
    $pageTitle = 'Projets';
    $contentFile = PROJECT_ROOT . '/templates/pages/projects.php';
    require PROJECT_ROOT . '/templates/layout.php';
});

SimpleRouter::get('/projects/{slug}', function ($slug) use ($projectService): void {
    $pageTitle = $slug;
    $contentFile = PROJECT_ROOT . '/templates/pages/project.php';
    require PROJECT_ROOT . '/templates/layout.php';
});

SimpleRouter::get('/contact', function (): never {
    header('Location: /#contact');
    exit;
});

SimpleRouter::post('/contact', function () use ($messageService): void {
    $username = htmlspecialchars($_POST['form-username']);
    $email = htmlspecialchars($_POST['form-email']);
    $subject = htmlspecialchars($_POST['form-subject']);
    $content = htmlspecialchars($_POST['form-content']);

    $result = $messageService->sendMessage($username, $email, $subject, $content);
    $state = $result ? 'success' : 'error';

    header('Location: /?state=' . $state);
    exit;
});

SimpleRouter::start();