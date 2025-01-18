<?php

$productosSeccionOptions = $view_data['productosSeccionOptions'];

?>

<div class="container">

    <div class="card my-5 col-12 col-md-10 col-lg-8 col-xl-6 m-auto">

        <form action="<?= APP_URL; ?>inventarios/nuevo" method="POST" class="m-0">

            <div class="card-body">

                <h1 class="text-center display-6"><?= $view_formTitle; ?></h1>

                <hr>

                <?= $view_alertMsg; ?>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control text-primary" name="usuario" id="usuario" required value="<?= Session::getFullUserName(); ?>" readonly>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="seccion" class="form-label">Sección</label>
                        <input type="text" class="form-control text-primary" name="seccion" id="seccion" required value="<?= mb_strtoupper(Session::getUserSeccion()); ?>" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Productos</label>
                    <select type="producto_id" class="form-select" id="producto_id" autofocus>
                        <option value="">Elegir Producto para realizar el inventario</option>
                        <?= $productosSeccionOptions; ?>
                    </select>
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
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input auto-select" name="equivalencia" id="equivalencia" value="0" step="1" min="0" max="9999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#43;
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="cant_cajas" class="form-label">Cajas</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input auto-select" name="cant_cajas" id="cant_cajas" value="0" step="1" min="0" max="9999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#43;
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="cant_unidades" class="form-label">Unidades</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input auto-select" name="cant_unidades" id="cant_unidades" value="0" step="1" min="0" max="9999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#43;
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="merma" class="form-label">Merma</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input auto-select" name="merma" id="merma" value="0" step="1" min="0" max="9999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#43;
                            </button>
                        </div>
                    </div>
                </div>

                <!-- <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="subtotal" class="form-label">Subtotal</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input auto-select" name="subtotal" id="subtotal" value="0" step="1" min="0" max="9999">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#43;
                            </button>
                        </div>
                    </div>

                    <div class="mb-3 col-12 /col-md-6">
                        <label for="total" class="form-label">Total</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#45;
                            </button>
                            <input type="number" class="form-control text-center number-input" name="total" id="total" value="0" step="1" min="0" max="9999" readonly>
                            <button class="btn btn-outline-secondary btn-inc-dec p-0" type="button" tabindex="-1">
                                &#43;
                            </button>
                        </div>
                    </div>
                </div> -->

                <div class="mb-3 col-12">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control text-center text-primary" id="total" value="0" tabindex="-1" readonly>
                </div>

                <div class="row g-3">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="expresion" class="form-label text-info">Expresión</label>
                        <input type="text" class="form-control text-center auto-select" id="expresion" placeholder="Ingrese una expresión">
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="resultado" class="form-label text-info">Resultado</label>
                        <input type="text" class="form-control text-center auto-select-copy" id="resultado" readonly>
                    </div>
                </div>

            </div>

            <div class="card-footer p-3">

                <div class="d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-floppy me-1"></i> Guardar
                    </button>
                    <button type="reset" class="btn btn-dark flex-grow-1">
                        <i class="bi bi-arrow-clockwise me-1"></i> Limpiar
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
    document.addEventListener('DOMContentLoaded', () => {
        const expresionInput = document.getElementById('expresion');
        const resultDisplay = document.getElementById('resultado'); // Resultado es un input

        // Función para filtrar caracteres válidos
        const filterValidCharacters = (input) => {
            const validCharacters = '0123456789/*-+. ';
            return [...input].filter(char => validCharacters.includes(char)).join('');
        };

        // Validar la entrada del usuario en tiempo real
        expresionInput.addEventListener('input', () => {
            expresionInput.value = filterValidCharacters(expresionInput.value);
        });

        // Evaluar la expresión matemática cuando pierde el foco
        expresionInput.addEventListener('blur', () => {
            const expresion = expresionInput.value.trim();
            let result;

            try {
                // Solo evaluar si hay una expresión válida
                if (expresion) {
                    result = Function(`"use strict"; return (${expresion})`)();

                    // Verifica si el resultado es finito (no infinito o NaN)
                    if (!isFinite(result)) {
                        throw new Error("El resultado no es finito");
                    }
                } else {
                    result = "Ingrese una expresión";
                }
            } catch (error) {
                result = "Expresión Inválida";
            }

            resultDisplay.value = result; // Usamos `value` en lugar de `textContent`
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Seleccionar todos los elementos con la clase 'auto-select'
        const autoSelectInputs = document.querySelectorAll('.auto-select');

        // Agregar el evento de foco a cada elemento seleccionado
        autoSelectInputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.select(); // Seleccionar el contenido del input al hacer foco
            });
        });

        // Seleccionar todos los elementos con la clase 'auto-select'
        const autoSelecCopytInputs = document.querySelectorAll('.auto-select-copy');

        // Agregar el evento de foco a cada elemento seleccionado
        autoSelecCopytInputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.select(); // Seleccionar el contenido del input al hacer foco
                copyToClipboard(input.value); // Copiar el contenido al portapapeles
            });
        });
    });

    // Función para copiar el texto al portapapeles
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => {
                console.log("Texto copiado al portapapeles:", text);
            })
            .catch(err => {
                console.error("Error al copiar al portapapeles:", err);
            });
    }
</script>

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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Seleccionar todos los inputs necesarios
        const cantCajasInput = document.getElementById('cant_cajas');
        const equivalenciaInput = document.getElementById('equivalencia');
        const cantUnidadesInput = document.getElementById('cant_unidades');
        const mermaInput = document.getElementById('merma');
        const totalInput = document.getElementById('total');

        // Función para calcular el total
        function calculateTotal() {
            const cantCajas = parseInt(cantCajasInput.value) || 0;
            const equivalencia = parseInt(equivalenciaInput.value) || 0;
            const cantUnidades = parseInt(cantUnidadesInput.value) || 0;
            const merma = parseInt(mermaInput.value) || 0;

            const total = (cantCajas * equivalencia) + cantUnidades + merma;
            totalInput.value = total; // Actualizar el campo total
        }

        // Agregar evento blur a cada campo relevante para actualizar el total
        [cantCajasInput, equivalenciaInput, cantUnidadesInput, mermaInput].forEach(input => {
            input.addEventListener('blur', calculateTotal);
        });
    });
</script>