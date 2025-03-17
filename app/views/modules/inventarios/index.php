<div class="container">

    <div class="card my-5 animate__animated animate__fadeIn">
        <div class="card-body">
            <h1 class="display-5 text-center"><?= $view_moduleTitle; ?></h1>

            <div class="d-flex justify-content-between flex-wrap gap-3">
                <a href="<?= APP_URL; ?>inventarios/nuevo" class="btn btn-primary flex-grow-1 flex-sm-grow-0">
                    <i class="bi bi-plus me-1"></i> Nuevo Registro
                </a>

                <a href="<?= APP_URL; ?>pages/menu" class="btn btn-info flex-grow-1 flex-sm-grow-0">
                    <i class="bi bi-list me-1"></i>
                    Menú
                </a>
            </div>

            <hr>

            <div class="table-responsive">

                <table class="table table-striped table-hover table-sm table-bordered mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha - Hora</th>
                            <th>Usuario</th>
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
            window.location.href = '<?= APP_URL; ?>inventarios/eliminar/' + id;
        }
    }
</script>