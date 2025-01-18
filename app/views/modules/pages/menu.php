
    <div class="wrapper d-flex justify-content-center align-items-md-center my-3 my-md-auto">

        <div class="container w-100">

            <div class="card animate__animated animate__fadeIn">

                <div class="card-body">

                    <h1 class="text-center display-5"><?= $view_title; ?></h1>
                    <!-- <h4 class="text-center mb-4"><?= $view_message; ?></h4> -->

                    <hr>

                    <?php if (isset($_SESSION['cargo']) || true): ?>
                        <div class="menu-principal d-flex justify-content-center gap-3 flex-wrap">
                            <?php if (Session::hasCargoAccess('admin')): ?>

                                <a href="<?= APP_URL; ?>areas" class="btn btn-primary py-4">
                                    <i class="bi bi-buildings me-1"></i> Áreas
                                </a>
                                <a href="<?= APP_URL; ?>secciones" class="btn btn-primary py-4">
                                    <i class="bi bi-building me-1"></i> Secciones
                                </a>
                                <a href="<?= APP_URL; ?>cargos" class="btn btn-primary py-4">
                                    <i class="bi bi-person-vcard me-1"></i> Cargos
                                </a>
                                <a href="<?= APP_URL; ?>usuarios" class="btn btn-primary py-4">
                                    <i class="bi bi-people me-1"></i> Usuarios
                                </a>
                                <a href="<?= APP_URL; ?>productos" class="btn btn-primary py-4">
                                    <i class="bi bi-r-circle me-1"></i> Productos
                                </a>
                            <?php endif; ?>
                            <?php if (Session::hasCargoAccess('admin', 'inventarios')): ?>
                                <a href="<?= APP_URL; ?>inventarios" class="btn btn-primary py-4">
                                    <i class="bi bi-card-checklist me-1"></i> Inventarios
                                </a>
                                <a href="<?= APP_URL; ?>reportes" class="btn btn-outline-dark py-4">
                                    <i class="bi bi-file-earmark-bar-graph me-1"></i> Reportes
                                </a>
                            <?php endif; ?>
                            <a href="<?= APP_URL; ?>pages/logout" class="btn btn-danger py-4">
                                <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
                            </a>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>