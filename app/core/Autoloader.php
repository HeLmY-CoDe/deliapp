<?php

class Autoloader
{
    // Array de directorios base donde se buscarán las clases
    private static $baseDirs = [
        'app' . DIRECTORY_SEPARATOR . 'core',
        'app' . DIRECTORY_SEPARATOR . 'controllers',
        'app' . DIRECTORY_SEPARATOR . 'models',
        // Agrega más directorios según sea necesario
    ];

    // Método que registra el autoloader
    public static function register()
    {
        // echo "<p>AUTOLOADER OK!</p>";
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    // Método que realiza el autoload de las clases
    public static function autoload($class)
    {
        // echo getcwd();

        // Convertir el namespace a una ruta de archivo
        $classPath = DIRECTORY_SEPARATOR . $class . '.php';

        // Recorrer los directorios base para intentar cargar la clase
        foreach (self::$baseDirs as $baseDir) {

            // $file = getcwd() . DIRECTORY_SEPARATOR . $baseDir . $classPath;
            $file = dirname($_SERVER['SCRIPT_FILENAME']) . DIRECTORY_SEPARATOR . $baseDir . $classPath;

            // echo '<pre>$file<br>';
            // var_dump($file);
            // echo '</pre>';

            // Verificar si el archivo existe y cargarlo
            if (file_exists($file)) {

                // echo '<pre>$file<br>';
                // var_dump($file);
                // echo '</pre>';

                require_once $file;
                return;
            }
        }

        // Si no se encuentra el archivo, registrar un error
        echo ("<p>El archivo para la clase {$class} no fue encontrado.</p>");
        error_log("El archivo para la clase {$class} no fue encontrado.");
    }
}

// Registrar el autoloader
// Autoloader::register();
