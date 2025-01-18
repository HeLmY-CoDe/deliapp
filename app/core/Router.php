<?php

class Router
{
    private $defaultController = DEFAULT_CONTROLLER;
    private $defaultMethod     = DEFAULT_METHOD;

    private function __construct() {}

    private function sanitizeUri($uri)
    {
        // 1. Sanitizar la URL usando FILTER_SANITIZE_URL
        $uri = filter_var($uri, FILTER_SANITIZE_URL);

        // 2. Eliminar etiquetas HTML y PHP
        $uri = strip_tags($uri);

        // 3. Escapar caracteres especiales (como comillas o signos menores que)
        $uri = htmlspecialchars($uri, ENT_QUOTES, 'UTF-8');

        // 4. Convertir a minúsculas
        $uri = mb_strtolower($uri);

        // 5. Eliminar caracteres no permitidos excepto letras, números, guiones y barras
        $uri = preg_replace('/[^\w\-\/]/', '', $uri);

        // 6. Reemplazar guiones bajos con guiones
        $uri = str_replace('_', '-', $uri);

        // 7. Reemplazar múltiples guiones consecutivos por un solo guion
        $uri = preg_replace('/-+/', '-', $uri);

        // 8. Eliminar barras al principio y al final de la URL
        return trim($uri, '/');
    }

    private function parseUri($uri)
    {
        $cleanUri = $this->sanitizeUri($uri);

        // Convertir la URI en un array
        $uriParts = explode('/', $cleanUri);

        // Si existe sesión y no hay ninguna uri, se va al menú
        if (Session::verify() && $uri === '') {
            $this->defaultController = 'pages';
            $this->defaultMethod     = 'menu';
        }

        // Obtener el controlador, método y parámetros
        $controller = !empty($uriParts[0]) ? $uriParts[0] : $this->defaultController;
        $method     = !empty($uriParts[1]) ? $uriParts[1] : $this->defaultMethod;

        // Los argumentos son el resto de la URI
        $args       = array_slice($uriParts, 2);

        return [
            'controller' => $controller,
            'method'     => $method,
            'args'       => $args,
        ];
    }

    private function kebabToPascalCase($name)
    {
        // Capitaliza cada palabra y elimina guiones
        $name = str_replace('-', '', ucwords($name, '-'));
        return $name; // Retorna el nombre en PascalCase
    }

    private function kebabToCamelCase($name)
    {
        $name = $this->kebabToPascalCase($name);

        // Convierte la primera letra a minúscula
        $name = lcfirst($name);
        return $name; // Retorna el nombre en camelCase
    }

    // private function kebabToSnakeCase($name)
    // {
    //     // Reemplaza los guiones con guiones bajos
    //     return str_replace('-', '_', $name); // Retorna el nombre en Snake Case
    // }

    public function dispatch($uri)
    {
        $parsedUri = $this->parseUri($uri);

        // Usar los nuevos nombres de métodos para formatear el controlador y el método
        $controllerName = $this->kebabToPascalCase($parsedUri['controller']) . 'Controller'; // Agregar "Controller"
        $methodName     = $this->kebabToCamelCase($parsedUri['method']); // Obtener el método en Snake Case

        // echo "<p>CONTROLLER: $controllerName</p>";
        // echo "<p>METHOD: $methodName</p>";
        // echo '<pre>$parsedUri[\'args\']<br>';
        // var_dump($parsedUri['args']);
        // echo '</pre>';
        // echo "<p>MODULO: {$parsedUri['controller']}</p>";
        // echo '<hr>';

        // => Validar si Existe la clase y el método del Controlador
        if (!class_exists($controllerName) || !method_exists($controllerName, $methodName)) {
            echo "<p>CONTROLADOR Y/O MÉTODO NO ENCONTRADO!</p>";

            $controllerName = 'PagesController';
            $methodName     = 'error404';
        }

        // ! Validar el accesso a los módulos del sistema de acuerdo al Cargo que tiene el Usuario
        if (!Session::checkModuleAccess($parsedUri['controller'])) {
            $controllerName = 'PagesController';
            $methodName     = 'error403';
        }

        $controller = new $controllerName();

        // => Llamar al método del controlador con los parámetros
        call_user_func_array([$controller, $methodName], $parsedUri['args']);
    }

    public static function processUri()
    {
        $uri = $_GET['uri'] ?? '';

        $Router = new self();
        $Router->dispatch($uri);
    }
}
