<?php
    $icon_path = "/assets/images/projects/{$project->getSlug()}.png";
    $icon_full_path = PROJECT_ROOT . '/public/assets/images/projects/' . $project->getSlug() . '.png';
    $has_icon = file_exists($icon_full_path);
?>
<article class="project-card">

    <?php if ($has_icon): ?>
        <div class="project-card-icon">
            <img src="<?= htmlspecialchars($icon_path); ?>" />
        </div>
    <?php endif; ?>

    <div class="project-card-contents">
        <h3 class="project-card-name">
            <?= htmlspecialchars($project->getName()); ?>
        </h3>
        <div class="project-card-tags">
            <?php foreach($project->getTags() as $tag): ?>
                <div class="tag">
                    <i class="<?= $tag->getIcon(); ?>"></i>
                    <span><?= $tag->getName(); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="project-card-caption">
            <?= htmlspecialchars($project->getCaption()); ?>
        </p>
    </div>
    <div class="project-card-actions">
        <a href="/projects/<?= htmlspecialchars($project->getSlug()) ?>" class="btn btn-primary">Voir plus</a>

        <?php if ($project->getGithubUrl()): ?>
            <a class="project-card-github" target="_blank" href="<?= htmlspecialchars($project->getGithubUrl()); ?>">
                <i class="bi bi-github"></i>
            </a>
        <?php endif; ?>

    </div>
</article>