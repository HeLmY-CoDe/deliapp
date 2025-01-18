
    <nav class="navbar sticky-top navbar-expand-lg /bg-body-tertiary px-2 px-md-5 py-1">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= APP_URL; ?>pages/menu">
                <img src="<?= ASSETS_URL; ?>img/logo.png" alt="" class="navbar-logo">
                <span class="ms-3"><?= APP_NAME; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">MY APP!</a>
                    </li>
                </ul> -->

                <div class="navbar-username">
                    <i class="bi bi-person-circle me-3"></i>
                    <?= Session::getFullUserName(); ?>
                </div>

                <!-- <div class="theme-toggle ms-5" id="theme-toggle"></div> -->
            </div>
        </div>
    </nav>