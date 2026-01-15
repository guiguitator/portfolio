<?php
    $project = $projectService->getProjectBySlug($slug);

    if (!$project) {
        http_response_code(404);
        $error = "Projet non trouvé.";
    } else {

        if (class_exists('Parsedown')) {
            $parser = new Parsedown();
            $parser->setSafeMode(true);
            $detailed_content = $parser->text($project->getContent());
        } else {
            $detailed_content = "Impossible de charger le contenu détaillé du projet.";
        }
    }
?>

<?php if (isset($error)): ?>
    <section>
        <h1>Erreur</h1>
        <p><?php echo htmlspecialchars($error); ?></p>
    </section>
<?php else: ?>
    <section id="project-header">
        <img src="<?php echo htmlspecialchars("/assets/images/projects/{$slug}.png"); ?>" />
        <div class="project-detail">
            <h1 class="project-detail-title"><?php echo htmlspecialchars($project->getName()); ?></h1>
            <p class="project-detail-caption"><?php echo htmlspecialchars($project->getCaption()); ?></p>
            <div class="project-detail-tags">
                <?php foreach($project->getTags() as $tag): ?>
                    <div class="tag">
                        <i class="<?= $tag->getIcon(); ?>"></i>
                        <span><?= $tag->getName(); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section class="project-detail-content">
        <p><?php echo $detailed_content; ?></p>
    </section>
<?php endif; ?>

<!-- TODO: Add Github and Documentation link (use Bootstrap for icons) -->