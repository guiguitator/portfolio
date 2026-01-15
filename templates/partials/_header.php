<header>
    <div class="header-container container">
        <div class="header-title">Meunier Guillaume</div>
        <div>
            <!-- Desktop -->
            <div id="desktop-menu" class="visible-desktop">
                <?php include PROJECT_ROOT . '/templates/partials/_navigation.php'; ?>
            </div>
            <!-- Mobile -->
            <div class="mobile-menu-icon visible-mobile">
                <a id="mobile-open-menu"><i class="bi bi-list"></i></a>
            </div>
            <div id="mobile-menu" class="visible-mobile">
                <div class="mobile-menu-wrapper">
                    <?php include PROJECT_ROOT . '/templates/partials/_navigation.php'; ?>
                    <div class="mobile-menu-icon visible-mobile">
                        <a id="mobile-close-menu"><i class="bi bi-x-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>