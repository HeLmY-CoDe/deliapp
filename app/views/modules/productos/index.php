<div class="container">

    <div class="card my-5 animate__animated animate__fadeIn">
        <div class="card-body">

            <div class="mx-3">
                <h1 class="display-5 text-center"><?= $view_moduleTitle; ?></h1>

                <div>
                    <a href="<?= APP_URL; ?>productos/nuevo" class="btn btn-primary btn-rounded">
                        <i class="bi bi-plus me-1"></i> Nuevo Registro
                    </a>

                    <a href="<?= APP_URL; ?>pages/menu" class="btn btn-info float-end">
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
                            <th>Código</th>
                            <th>Detalle</th>
                            <th>Stock</th>
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
            window.location.href = '<?= APP_URL; ?>productos/eliminar/' + id;
        }
    }
</script>