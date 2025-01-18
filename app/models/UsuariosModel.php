<?php

class UsuariosModel extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function readAll(): array
    {
        $sql = "SELECT
            U.id,
            U.nombres,
            U.apellidos,
            U.cod_empleado,
            U.celular,
            U.nombre_usuario,
            U.status,
            C.nombre AS cargo,
            S.nombre AS seccion,
            A.nombre AS area
        FROM
            `usuarios` U
        INNER JOIN `cargos` C ON
            C.id = U.cargo_id
        INNER JOIN `secciones` S ON
            S.id = U.seccion_id
        INNER JOIN `areas` A ON
            A.id = S.area_id
        ORDER BY
            U.id";

        return $this->pdo->query($sql)->fetchAll();
    }

    public function readById(int $id): array
    {
        try {
            $sql = "SELECT * FROM `usuarios` WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([':id' => $id]);

            $result = $stmt->fetch();

            return $result ?: [];
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function update($updateData): int
    {
        try {
            $passwordField  = '';

            if (isset($updateData['password'])) {

                $passwordField = ($updateData['password'] != '')
                ? "`password` = :password,"
                : "";

                $hash = password_hash($updateData['password'], PASSWORD_DEFAULT);
                $updateData['password'] = $hash;
            }

            $sql = "UPDATE
                `usuarios`
            SET
                `nombres` = :nombres,
                `apellidos` = :apellidos,
                `cod_empleado` = :cod_empleado,
                `celular` = :celular,
                `nombre_usuario` = :nombre_usuario,
                {$passwordField}
                `seccion_id` = :seccion_id,
                `cargo_id` = :cargo_id,
                `status` = :status
            WHERE
                `id` = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($updateData);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function create($createData)
    {
        try {
            $sql = "INSERT INTO `usuarios`(
                nombres,
                apellidos,
                cod_empleado,
                celular,
                nombre_usuario,
                password,
                seccion_id,
                cargo_id,
                status
            )
            VALUES(
                :nombres,
                :apellidos,
                :cod_empleado,
                :celular,
                :nombre_usuario,
                :password,
                :seccion_id,
                :cargo_id,
                :status
            )";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($createData);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function deleteById(int $id): int
    {
        try {
            $sql = "DELETE FROM `usuarios` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    // public function updateFotoUsuario($id, $foto): int
    // {
    //     try {
    //         $sql = "UPDATE `usuarios`
    //         SET
    //         `foto` = :foto
    //         WHERE id = :id";

    //         $updateData = [
    //             'id'   => $id,
    //             'foto' => $foto
    //         ];

    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute($updateData);

    //         return $stmt->rowCount();
    //     } catch (PDOException $e) {
    //         die("<p>ERROR!<br>{$e->getMessage()}</p>");
    //     }
    // }
}
