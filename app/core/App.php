<?php

class App
{
    // Variable estática para almacenar la única instancia de la clase (patrón Singleton)
    private static $instance = null;
    // Ruta del archivo de configuración
    private $configFile      = './app/config/globals.php';
    private $autoloaderFile  = './app/core/Autoloader.php';

    // Constructor privado para evitar la creación directa de instancias desde fuera de la clase
    private function __construct()
    {
        // Mensaje de inicio al crear la instancia de la aplicación
        // echo "<p>INICIANDO APP...</p>";
        // Llama al método init para inicializar varios componentes de la aplicación
        $this->init();
    }

    // Método que inicializa varias configuraciones, autoload, sesión y enrutamiento
    private function init()
    {
        // Inicializa el autoloader de clases
        $this->init_autoloader();
        // Inicializa la configuración cargando el archivo de configuración
        $this->init_config();
        // Inicializa la sesión, verificando su estado
        $this->init_session();
        // Inicializa el enrutador para gestionar las solicitudes
        $this->init_router();
    }

    // Método para cargar el archivo de configuración si existe
    private function init_config()
    {
        // Verifica si el archivo de configuración existe y lo incluye
        if (is_file($this->configFile)) {
            require_once $this->configFile;
        }
    }

    // Método para inicializar el autoloader si el archivo existe
    private function init_autoloader()
    {
        // Verifica si el archivo del autoloader está definido y existe
        if (is_file($this->autoloaderFile)) {
            // Incluye el archivo del autoloader
            require_once $this->autoloaderFile;

            // Registra el autoloader llamando al método estático 'register' de la clase Autoloader
            Autoloader::register();
        }
    }

    // Método para inicializar la sesión y validar su estado
    // private function init_session()
    // {
    //     if (session_status() === PHP_SESSION_NONE) {
    //         session_start();
    //     }
    // }

    // Método para inicializar la sesión y validar su estado actual
    // Se asegura de que la sesión esté iniciada y en un estado válido antes de continuar
    private function init_session()
    {
        // Esto previene el acceso no autorizado y refuerza la seguridad de la aplicación
        Session::verify();
    }


    // Método para inicializar el enrutador y obtener la URI solicitada
    private function init_router()
    {
        // Llama al enrutador para procesar la URI
        Router::processUri();
    }

    // Método estático para obtener la única instancia de la clase (Singleton)
    public static function start()
    {
        // Si no hay una instancia, la crea
        if (self::$instance === null) {
            self::$instance = new self(); // Crea la instancia solo si no existe
        }
        // Devuelve la única instancia de la clase
        return self::$instance;
    }

    // Método privado para evitar la clonación de la instancia (parte del patrón Singleton)
    private function __clone() {}

    // Método público para evitar la deserialización de la instancia (parte del patrón Singleton)
    public function __wakeup() {}
}
