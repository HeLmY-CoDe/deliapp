<div class="container">

    <div class="card my-5 col-12 col-md-10 col-lg-8 col-xl-6 m-auto">

        <form action="<?= APP_URL; ?>inventarios/nuevo" method="POST" class="m-0">

            <div class="card-body">

                <h1 class="text-center display-6"><?= $view_formTitle; ?></h1>

                <hr>

                <?= $view_alertMsg; ?>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="datetime-local" class="form-control" name="fecha" id="fecha" required value="<?= Helpers::getDateTime(); ?>" readonly>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" required value="<?= Session::getFullUserName(); ?>" readonly>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="lote" class="form-label">Lote</label>
                        <input type="text" class="form-control" name="lote" id="lote" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                        <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento" required>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="equivalencia" class="form-label">Equivalencia</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input" name="equivalencia" id="equivalencia" value="1" step="1" min="1" max="999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#43;
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="cant_cajas" class="form-label">Cajas</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input" name="cant_cajas" id="cant_cajas" value="1" step="1" min="1" max="999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#43;
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="cant_unidades" class="form-label">Unidades</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input" name="cant_unidades" id="cant_unidades" value="1" step="1" min="1" max="999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#43;
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="merma" class="form-label">Merma</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input" name="merma" id="merma" value="1" step="1" min="1" max="999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#43;
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="subtotal" class="form-label">Subtotal</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input" name="subtotal" id="subtotal" value="1" step="1" min="1" max="999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#43;
                            </button>
                        </div>
                    </div>

                    <div class="mb-3 col-12 col-md-6">
                        <label for="total" class="form-label">Total</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input" name="total" id="total" value="1" step="1" min="1" max="999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button">
                                &#43;
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer p-3">

                <div class="d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-floppy me-1"></i> Guardar
                    </button>
                    <a href="<?= APP_URL; ?>inventarios" class="btn btn-secondary flex-grow-1">
                        <i class="bi bi-ban me-1"></i> Cancelar
                    </a>
                </div>

            </div>

        </form>

    </div>

</div>

<script>
    function initializeIncrementDecrementControls(container) {
        const numberInput = container.querySelector('.number-input');
        const btnDecrement = container.querySelector('.btn-inc-dec:nth-child(1)');
        const btnIncrement = container.querySelector('.btn-inc-dec:nth-child(3)');

        // Obtener los valores de configuración del input
        const min = parseFloat(numberInput.getAttribute('min')) || 0;
        const max = parseFloat(numberInput.getAttribute('max')) || 100;
        const step = parseFloat(numberInput.getAttribute('step')) || 1;

        btnDecrement.addEventListener('click', () => {
            let value = parseFloat(numberInput.value) || 0;
            if (value > min) {
                numberInput.value = Math.max(min, (value - step).toFixed(2));
            }
        });

        btnIncrement.addEventListener('click', () => {
            let value = parseFloat(numberInput.value) || 0;
            if (value < max) {
                numberInput.value = Math.min(max, (value + step).toFixed(2));
            }
        });

        // Validar el valor solo al salir del campo (evento blur)
        numberInput.addEventListener('blur', () => {
            let value = parseFloat(numberInput.value);

            if (isNaN(value) || value < min) {
                numberInput.value = min;
            } else if (value > max) {
                numberInput.value = max;
            }
        });
    }

    // Inicializar la función para cada grupo de controles
    document.querySelectorAll('.input-group').forEach(container => {
        initializeIncrementDecrementControls(container);
    });
</script>