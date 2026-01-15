<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title><?= $pageTitle ?> - Meunier Guillaume</title>
        <link rel="stylesheet" href="/assets/css/main.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script type="text/javascript" src="/assets/js/mobile.js" defer></script>
    </head>
    <body>
        <?php include_once PROJECT_ROOT . '/templates/partials/_header.php'; ?>
        <main class="container">
            <?php include_once $contentFile ?>
        </main>
        <?php include_once PROJECT_ROOT .  '/templates/partials/_footer.php'; ?>
    </body>
</html>