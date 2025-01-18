<?php

class DotEnv
{
    private static array $variables = [];

    /**
     * Carga las variables de entorno desde el archivo especificado.
     *
     * @param string $path Ruta al archivo .env.
     * @throws Exception Si el archivo no existe o tiene un formato inválido.
     */
    public static function load(string $path): void
    {
        if (!file_exists($path)) {
            throw new Exception("El archivo .env no existe en: {$path}");
        }

        // Leer y procesar el archivo línea por línea
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // Ignorar comentarios y líneas vacías
            if ($line === '' || $line[0] === '#') {
                continue;
            }

            // Separar nombre y valor
            if (strpos($line, '=') !== false) {

                [$name, $value] = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value, " \t\n\r\0\x0B\"'"); // Eliminar espacios y comillas

                // Convertir ciertos valores a booleanos o nulos
                if (strtolower($value) === 'true') {
                    $value = true;
                } elseif (strtolower($value) === 'false') {
                    $value = false;
                } elseif (strtolower($value) === 'null') {
                    $value = null;
                }

                // Guardar en el array y establecer variable de entorno
                self::$variables[$name] = $value;
                putenv("{$name}={$value}");
                $_ENV[$name] = $value; // También actualizar $_ENV

            } else {
                throw new Exception("Línea inválida en .env: {$line}");
            }
        }
    }

    /**
     * Obtiene el valor de una variable de entorno.
     *
     * @param string $key Clave de la variable.
     * @param mixed $default Valor por defecto si la clave no existe.
     * @return mixed Valor de la variable de entorno o valor por defecto.
     */
    public static function get(string $key, $default = null)
    {
        return self::$variables[$key] ?? $default;
    }

    /**
     * Verifica si una variable de entorno existe.
     *
     * @param string $key Clave de la variable.
     * @return bool True si existe, False si no.
     */
    public static function has(string $key): bool
    {
        return array_key_exists($key, self::$variables);
    }

    /**
     * Obtiene todas las variables de entorno cargadas.
     *
     * @return array Arreglo de todas las variables.
     */
    public static function all(): array
    {
        return self::$variables;
    }
}
