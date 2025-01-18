<?php

class LoginModel extends Database
{
    private $pdo;

    protected function __construct()
    {
        $this->pdo = parent::connect();
    }

    protected function readAll(): array
    {
        $sql = "SELECT * FROM cargos";
        return $this->pdo->query($sql)->fetchAll();
    }

    protected function usernameExists(string $userName): array | bool
    {
        try {
            $sql = "SELECT
                nombre_usuario,
                status
            FROM
                `usuarios`
            WHERE
                BINARY `nombre_usuario` = :nombre_usuario LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$userName]);

            return $stmt->fetch();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function getDBPassword(string $userName): string
    {
        try {
            $sql  = "SELECT password FROM usuarios WHERE nombre_usuario = :nombre_usuario";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$userName]);

            return $stmt->fetch()['password'];
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function passwordVerify($password, $dbPasswordHash): bool
    {
        try {
            return ($dbPasswordHash && password_verify($password, $dbPasswordHash));
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function initUserSession($userName)
    {
        try {
            $sql = "SELECT
                U.id,
                U.nombres,
                U.apellidos,
                U.status,
                C.nombre AS cargo,
                S.nombre AS seccion
            FROM
                usuarios U
            INNER JOIN cargos C ON
                C.id = U.cargo_id
            INNER JOIN secciones S ON
                S.id = U.seccion_id
            WHERE
                U.nombre_usuario = '{$userName}'";

            $datosUsuario = $this->pdo->query($sql)->fetch();

            $_SESSION['id']         = $datosUsuario['id'];
            $_SESSION['nombres']    = $datosUsuario['nombres'];
            $_SESSION['apellidos']  = $datosUsuario['apellidos'];
            $_SESSION['cargo']      = $datosUsuario['cargo'];
            $_SESSION['seccion']    = $datosUsuario['seccion'];
            $_SESSION['estado']     = $datosUsuario['status'];
            $_SESSION['status']     = 'OK';
            $_SESSION['login_time'] = time();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }
}
