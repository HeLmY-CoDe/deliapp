    <?php

    $areasOptions = $view_data['areasOptions'];

    ?>
    <div class="container">

        <div class="card my-5 col-12 col-md-8 col-lg-6 col-xl-5 m-auto animate__animated animate__fadeIn">

            <form action="<?= APP_URL; ?>secciones/nuevo" method="POST" class="m-0">

                <div class="card-body">

                    <h1 class="text-center display-6"><?= $view_formTitle; ?></h1>

                    <hr>

                    <?= $view_alertMsg; ?>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="area_id" class="form-label">Área</label>
                        <select type="area_id" class="form-select" name="area_id" id="area_id" required>
                            <option value="">Elegir Área</option>
                            <?= $areasOptions; ?>
                        </select>
                    </div>
                    <div class="/mb-3">
                        <label class="form-label">Estado</label>
                        <div class="text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="estado_activo" value="1" checked>
                                <label class="form-check-label" for="estado_activo">Activo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="estado_inactivo" value="0">
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
                        <a href="<?= APP_URL; ?>secciones" class="btn btn-secondary flex-grow-1">
                            <i class="bi bi-ban me-1"></i> Cancelar
                        </a>
                    </div>

                </div>

            </form>

        </div>

    </div>