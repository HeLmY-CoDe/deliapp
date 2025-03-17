    <aside class="sidebar /show" id="sidebar">
        <div class="toggle-btn ps-1" id="toggle-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="app-title">
            <a href="<?= APP_URL; ?>pages/menu" class="text-decoration-none ms-3"><?= APP_NAME_HTML; ?></a>
        </div>
        <div class="user-avatar">
            <a class="sidebar-brand" href="<?= APP_URL; ?>pages/menu">
                <img src="<?= ASSETS_URL; ?>img/logo.png" alt="" class="sidebar-logo">
            </a>
            <div class="sidebar-username">
                <i class="bi bi-person-circle me-3"></i>
                <?= Session::getFullUserName(); ?>
            </div>
            <div class="user-rol">
                <?= Session::getUserCargo(); ?>
            </div>
        </div>

        <div class="separator"></div>
        <div class="d-flex justify-content-center">
            <div class="theme-toggle" id="theme-toggle"></div>
        </div>
        <div class="separator"></div>

        <div class="links">
            <?php if (isset($_SESSION['cargo']) || true): ?>
                <?php if (Session::hasCargoAccess('admin')): ?>

                    <a href="<?= APP_URL; ?>areas">
                        <i class="bi bi-buildings me-2"></i> Áreas
                    </a>
                    <a href="<?= APP_URL; ?>secciones">
                        <i class="bi bi-building me-2"></i> Secciones
                    </a>
                    <a href="<?= APP_URL; ?>cargos">
                        <i class="bi bi-person-vcard me-2"></i> Cargos
                    </a>
                    <a href="<?= APP_URL; ?>usuarios">
                        <i class="bi bi-people me-2"></i> Usuarios
                    </a>
                    <a href="<?= APP_URL; ?>productos">
                        <i class="bi bi-r-circle me-2"></i> Productos
                    </a>
                <?php endif; ?>
                <?php if (Session::hasCargoAccess('admin', 'inventarios')): ?>
                    <a href="<?= APP_URL; ?>inventarios">
                        <i class="bi bi-card-checklist me-2"></i> Inventarios
                    </a>
                    <a href="<?= APP_URL; ?>reportes">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i> Reportes
                    </a>
                <?php endif; ?>
                <a href="<?= APP_URL; ?>pages/logout" class="link-logout text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                </a>
            <?php endif; ?>
        </div>
        <div class="separator"></div>
    </aside>

    <div class="sidebar-overlay"></div>