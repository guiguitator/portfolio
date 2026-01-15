<section>
    <h1>Projets</h1>
    <p>
        Bacon ipsum dolor amet rump porchetta short loin jerky. Bacon frankfurter pig burgdoggen
        meatloaf landjaeger chislic capicola cupim kevin sausage. Pig short loin tenderloin, chicken
        buffalo prosciutto rump. Leberkas pork belly swine chislic porchetta tail tongue chuck strip
        steak bacon pork ham hock. Porchetta jerky pork belly short ribs pig spare ribs.
    </p>
</section>
<section class="section-projects-list">
    <div class="project-card-wrapper">
        <?php
            $projects = $projectService->getAllProjects();

            if (sizeof($projects) > 0) {
                foreach ($projects as $project) {
                    include PROJECT_ROOT . '/templates/partials/_project_card.php';
                }
            } else {
                echo "<p>Aucun projet à afficher pour le moment.</p>";
            }
        ?>
    </div>
</section>