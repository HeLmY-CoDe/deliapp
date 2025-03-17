<div class="container">

    <div class="card my-5 animate__animated animate__fadeIn">
        <div class="card-body">

            <div class="mx-3">
                <h1 class="display-5 text-center"><?= $view_moduleTitle; ?></h1>

                <div class="d-flex justify-content-between flex-wrap gap-3">
                    <a href="<?= APP_URL; ?>usuarios/nuevo" class="btn btn-primary flex-grow-1 flex-sm-grow-0">
                        <i class="bi bi-plus me-1"></i> Nuevo Registro
                    </a>

                    <a href="<?= APP_URL; ?>pages/menu" class="btn btn-info flex-grow-1 flex-sm-grow-0">
                        <i class="bi bi-list me-1"></i>
                        Menú
                    </a>
                </div>

                <hr>
            </div>

            <div class="table-responsive">

                <table class="table table-striped table-hover table-sm table-bordered mb-0 align-middle" id="myDataTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Código</th>
                            <th>Celular</th>
                            <th>Nombre Usuario</th>
                            <th>Cargo</th>
                            <th>Sección</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $view_tbodyData; ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

</div>

<script>
    function validarEliminacion(id) {

        if (confirm('¿Realmente desea eliminar el Registro?')) {
            window.location.href = '<?= APP_URL; ?>usuarios/eliminar/' + id;
        }
    }
</script>