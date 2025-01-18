<?php

class TestController
{
    public function index()
    {
        $viewData = [
            'title' => 'PAGINA DE PRUEBA!!!'
        ];

        View::render(
            module: 'test',
            viewData: $viewData
        );
    }

    // Método que maneja la lógica para 'test'
    public function test($id = null)
    {
        try {
            if ($id === null) {
                echo "<p>DEBE PASAR UN ARGUMENTO!</p>";
                return;
            }

            echo "Ejecutando el método 'test' del controlador 'PagesController' con el parámetro: " . htmlspecialchars($id);
        } catch (Exception $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    // Método que maneja la lógica para 'test'
    public function test2(...$args) // Usa el operador ... para recibir múltiples parámetros
    {
        echo '<pre>$args<br>';
        var_dump($args);
        echo '</pre>';
        // Procesar cada ID por separado
        foreach ($args as $arg) {
            // Aquí puedes hacer lo que necesites con cada ID
            echo "Procesando ID: " . htmlspecialchars($arg) . "<br>";
        }
    }

    public function sumar($num1, $num2)
    {
        // Asegurarse de que los números sean enteros
        $num1 = (int) $num1;
        $num2 = (int) $num2;

        // Sumar los números
        $resultado = $num1 + $num2;

        // Devolver el resultado (puedes usar echo o retornar en un JSON)
        echo "La suma de $num1 y $num2 es: $resultado";
    }

    public function sumarNumeros(...$numeros)
    {
        echo '<pre>$numeros<br>';var_dump($numeros);echo '</pre>';
        // Verificación si no se pasan números
        if (empty($numeros)) {
            $result = "Se debe pasar números como parámetros...";
        } else {
            // Asegurarse de que los números sean enteros
            $numeros = array_map('intval', $numeros);

            // Sumar los números
            $resultado = array_sum($numeros);

            // Devolver el resultado
            $result = "La suma de los números es: $resultado";
        }

        $viewData = [
            'title'  => 'PAGINA DE PRUEBA!!!',
            'result' => $result,
        ];

        Vieww::render(
            module: 'test',
            viewData: $viewData
        );
    }
}
