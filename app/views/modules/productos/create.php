    <?php

    $seccionesOptions = $view_data['seccionesOptions'];

    ?>
    <div class="container">

        <div class="card my-5 col-12 col-md-8 col-lg-6 col-xl-5 m-auto animate__animated animate__fadeIn">

            <form action="<?= APP_URL; ?>productos/nuevo" method="POST" enctype="multipart/form-data" class="m-0">

                <div class="card-body">

                    <h1 class="text-center display-6"><?= $view_formTitle; ?></h1>

                    <hr>

                    <?= $view_alertMsg; ?>

                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="detalle" class="form-label">Detalle</label>
                        <textarea class="form-control" name="detalle" id="detalle" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="seccion_id" class="form-label">Sección</label>
                        <select type="seccion_id" class="form-select" name="seccion_id" id="seccion_id" required>
                            <option value="">Elegir Sección</option>
                            <?= $seccionesOptions; ?>
                        </select>
                    </div>
                    <div class="/mb-3">
                        <label class="form-label">Estado</label>
                        <div class="text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="estado_activo" value="1" required checked>
                                <label class="form-check-label" for="estado_activo">Activo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="estado_inactivo" value="0" required>
                                <label class="form-check-label" for="estado_inactivo">Inactivo</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer p-3">

                    <div class="d-flex gap-3 flex-wrap">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-floppy me-1"></i> Guardar
                        </button>
                        <a href="<?= APP_URL; ?>productos" class="btn btn-secondary flex-grow-1">
                            <i class="bi bi-ban me-1"></i> Cancelar
                        </a>
                    </div>

                </div>

            </form>

        </div>

    </div>

    <script>
        // document.getElementById('foto').addEventListener('change', function(event) {
        //     const file = event.target.files[0];
        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             const preview = document.getElementById('preview');
        //             preview.src = e.target.result;
        //         };
        //         reader.readAsDataURL(file);
        //     }
        // });
    </script>