<?php

class Database
{
    // Variables estáticas para almacenar la instancia PDO
    private static $pdo;

    // Constructor privado para evitar la creación directa de instancias
    private function __construct() {}

    // Método para obtener la instancia de la conexión
    protected static function connect()
    {
        // Si la conexión ya ha sido creada, la retorna
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $host     = DotEnv::get('DB_HOST');
        $port     = DotEnv::get('DB_PORT');
        $dbname   = DotEnv::get('DB_DATABASE');
        $user     = DotEnv::get('DB_USERNAME');
        $password = DotEnv::get('DB_PASSWORD');

        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

        // Opciones de la conexión PDO
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // Desactiva la emulación para seguridad
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en errores
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Modo de obtención por defecto
            PDO::ATTR_STRINGIFY_FETCHES  => false, // Mantiene los tipos originales
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci", // Charset UTF-8
            // PDO::ATTR_PERSISTENT         => true, // Conexión persistente para grandes volúmenes de tráfico
        ];

        // Intenta establecer la conexión y almacenar la instancia
        try {
            self::$pdo = new PDO($dsn, $user, $password, $options);

            if (is_object(self::$pdo)) {
                // echo "<p>CONECTADO A: {$dbname}</p>";
            }

            return self::$pdo;
        } catch (PDOException $e) {
            echo "<p>ERROR DE CONEXIÓN CON LA BASE DE DATOS: {$e->getMessage()}</p>";
            error_log('ERROR DE CONEXIÓN CON LA BASE DE DATOS: ' . $e->getMessage());
            throw new Exception('ERROR DE CONEXIÓN CON LA BASE DE DATOS');
        }
    }

    // Evita la clonación de la instancia
    private function __clone() {}

    // Evita la deserialización de la instancia
    public function __wakeup() {}
}
