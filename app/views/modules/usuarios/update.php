<?php

$usuario          = $view_data['fetchData'];
$seccionesOptions = $view_data['seccionesOptions'];
$cargosOptions    = $view_data['cargosOptions'];

?>

<div class="container">

    <div class="card my-5 col-12 col-md-8 col-lg-6 col-xl-5 m-auto animate__animated animate__fadeIn">

        <form action="<?= APP_URL; ?>usuarios/editar<?= '/' . $view_id; ?>" method="POST" enctype="multipart/form-data" class="m-0">

            <input type="hidden" name="id" value="<?= $usuario['id']; ?>">

            <div class="card-body">

                <h1 class="text-center display-6"><?= $view_formTitle; ?></h1>

                <hr>

                <?= $view_alertMsg; ?>

                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" id="nombres" value="<?= $usuario['nombres']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apelllidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?= $usuario['apellidos']; ?>">
                </div>
                <div class="mb-3">
                    <label for="cod_empleado" class="form-label">Código Empleado</label>
                    <input type="text" class="form-control" name="cod_empleado" id="cod_empleado" value="<?= $usuario['cod_empleado']; ?>">
                </div>
                <div class="mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="number" class="form-control" name="celular" id="celular" value="<?= $usuario['celular']; ?>">
                </div>
                <div class="mb-3">
                    <label for="nombre_usuario" class="form-label">Nombre Usuario</label>
                    <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" value="<?= $usuario['nombre_usuario']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-danger">Cambiar Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label for="seccion_id" class="form-label">Sección</label>
                    <select type="seccion_id" class="form-select" name="seccion_id" id="seccion_id" required>
                        <option value="">Elegir Sección</option>
                        <?= $seccionesOptions; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cargo_id" class="form-label">Cargo</label>
                    <select type="cargo_id" class="form-select" name="cargo_id" id="cargo_id" required>
                        <option value="">Elegir Cargo</option>
                        <?= $cargosOptions; ?>
                    </select>
                </div>
                <div class="/mb-3">
                    <label class="form-label">Estado</label>
                    <div class="text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="estado_activo" value="1" <?= ($usuario['status'] == 1) ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="estado_activo">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="estado_inactivo" value="0" <?= ($usuario['status'] == 0) ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="estado_inactivo">Inactivo</label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer p-3">

                <div class="d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-floppy me-1"></i> Actualizar
                    </button>
                    <a href="<?= APP_URL; ?>usuarios" class="btn btn-secondary flex-grow-1">
                        <i class="bi bi-ban me-1"></i> Cancelar
                    </a>
                </div>

            </div>

        </form>

    </div>

</div>

<script>
    document.getElementById('foto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>