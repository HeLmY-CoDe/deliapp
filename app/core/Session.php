<?php

class Session
{
    // Definir los cargos permitidos para cada módulo
    private static $moduleCargos = [

        'usuarios'    => ['admin'],
        'cargos'      => ['admin'],
        'areas'       => ['admin'],
        'secciones'   => ['admin', 'clientes'],
        'productos'   => ['admin', 'ventas'],
        'inventarios' => ['admin', 'ventas'],
    ];

    // Definir los módulos comunes que pueden ser accedidos por cualquier usuario autenticado
    private static $commonModules = ['pages', 'login'];

    public function __construct() {}

    // Método para verificar si el usuario tiene acceso al módulo
    public static function checkModuleAccess($modulo)
    {
        if ($modulo === 'login' || $modulo === 'test') {
            return true;
        }

        // Verificar si la variable de sesión 'cargo' está definida
        if (!isset($_SESSION['cargo']) || !isset($_SESSION['status']) || $_SESSION['status'] != 'OK') {
            return false;
        }

        // Verificar si el módulo es común
        if (in_array($modulo, self::$commonModules)) {
            // Acceso permitido para cualquier usuario autenticado
            return true;
        }

        // Obtener el cargo actual de la sesión
        $rolUsuario = $_SESSION['cargo'];

        // Verificar si el módulo existe en la lista de módulos permitidos
        if (!array_key_exists($modulo, self::$moduleCargos)) {
            return false; // Si el módulo no está definido, denegar el acceso
        }

        // Verificar si el cargo del usuario tiene acceso al módulo
        if (in_array($rolUsuario, self::$moduleCargos[$modulo])) {
            return true; // Acceso permitido
        }

        return false; // Acceso denegado
    }

    // public static function verify()
    // {
    //     if (session_status() === PHP_SESSION_NONE) {
    //         session_start([
    //             'cookie_lifetime' => 86400, // Tiempo de vida de la cookie en segundos (1 día en este ejemplo)
    //             'cookie_secure'   => true,  // Solo envía la cookie a través de HTTPS
    //             'cookie_httponly' => true,  // Evita el acceso a la cookie desde JavaScript
    //             'use_strict_mode' => true,  // Evita que se reutilicen identificadores de sesión
    //         ]);
    //     }

    //     // Verifica si hay una sesión activa
    //     if (!empty($_SESSION) && isset($_SESSION['status']) && $_SESSION['status'] === 'OK') {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public static function verify()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'use_strict_mode' => true,  // Evita reutilización de IDs de sesión
                'use_cookies'     => true,  // Fuerza el uso de cookies para sesiones
                'cookie_lifetime' => 86400, // Vida de la cookie (1 día)
                'cookie_secure'   => isset($_SERVER['HTTPS']), // Solo en HTTPS
                'cookie_httponly' => true,  // Bloquea acceso desde JavaScript
                'cookie_samesite' => 'Strict' // Previene ataques CSRF
            ]);

            // Regenerar el ID de sesión si es una sesión nueva
            if (!isset($_SESSION['initiated'])) {
                session_regenerate_id(true);
                $_SESSION['initiated'] = true;
            }
        }

        // Verificar si la sesión es válida
        return isset($_SESSION['status']) && $_SESSION['status'] === 'OK';
    }


    public static function hasCargoAccess(...$cargosPermitidos)
    {
        return true;

        // Verificar si la variable de sesión 'cargo' está definida y contiene un valor
        if (empty($_SESSION['cargo'])) {
            return false; // Si no hay cargo en la sesión, el acceso está denegado
        }

        // Obtener el cargo actual de la sesión
        $rolUsuario = $_SESSION['cargo'];

        // Verificar si el cargo del usuario está en la lista de cargos permitidos
        return in_array($rolUsuario, $cargosPermitidos, true); // Comparación estricta
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        Redirect::to(APP_URL, 2.5);
    }

    public static function getFullUserName()
    {
        return $_SESSION['nombres'] . ' ' . $_SESSION['apellidos'];
    }

    public static function getUserCargo()
    {
        $cargo = $_SESSION['cargo'];

        switch ($cargo) {
            case 'admin':
                $cargo = 'ADMINISTRADOR';
                break;

            default:
                $cargo = 'OTRO';
                break;
        }

        return $cargo;
    }

    public static function getUserId()
    {
        return $_SESSION['id'];
    }

    public static function getUserSeccion()
    {
        return $_SESSION['seccion'];
    }
}
