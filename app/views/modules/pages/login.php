    <style>
        /* body {
            height: 100vh;
            background-image: linear-gradient(45deg, #2e32b0, #e72926);
            background-size: 430% 160%;
            background-position: fixed;
            animation: gradientBG 60s ease-in-out infinite;
        }

        @keyframes gradientBG {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        } */
    </style>
    <div class="wrapper /vh-100 d-flex justify-content-center align-items-center p-3">

        <div class="card col-12 col-sm-10 col-md-6 col-lg-4 col-xl-3 animate__animated animate__fadeIn">

            <div class="card-body /pb-0">


                <div class="text-center">
                    <img src="<?= ASSETS_URL; ?>img/logo.png" alt="" class="sidebar-logo-login">
                </div>

                <!-- <h1 class="text-center display-6 mb-4 mt-2 text-muted">Inicio de Sesión</h1> -->

                <form action="" method="post" class="mt-2">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="" required autofocus>
                        <label for="usuario">
                            <i class="bi bi-person me-1"></i> Nombre de Usuario
                        </label>
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control pe-5" name="password" id="password" placeholder="" required>
                        <label for="password">
                            <i class="bi bi-key me-1"></i> Contraseña
                        </label>
                        <!-- Icono para mostrar/ocultar contraseña -->
                        <i class="bi bi-eye-slash text-primary position-absolute end-0 translate-middle-y ps-3  pe-1 cursor-pointer togglePassword" id="togglePassword"></i>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        <i class="bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                    </button>

                    <div>
                        <?= $view_alertMsg; ?>
                    </div>

                </form>
            </div>

        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            togglePassword.addEventListener('click', function() {
                // Alternar el atributo type entre 'password' y 'text'
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Alternar el icono entre el ojo abierto y cerrado
                this.classList.toggle('bi-eye-slash');
                this.classList.toggle('text-primary');
                this.classList.toggle('bi-eye');
                this.classList.toggle('text-danger');
            });
        });
    </script>

    <script>
        const alertElement = document.querySelector(".alert");

        if (alertElement) {
            setTimeout(function() {
                bootstrap.Alert.getOrCreateInstance(alertElement).close();
            }, 3000);
        }
    </script>