<?php

class ProductosModel extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function readAll(): array
    {
        $sql = "SELECT
            P.id,
            P.codigo,
            P.detalle,
            P.stock,
            P.status,
            S.nombre AS seccion
        FROM
            `productos` P
        INNER JOIN `secciones` S ON
            S.id = P.seccion_id
        ORDER BY
            P.id";

        return $this->pdo->query($sql)->fetchAll();
    }

    public function readById(int $id): array
    {
        try {
            $sql = "SELECT * FROM `productos` WHERE id = :id";
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
            $sql = "UPDATE
                `productos`
            SET
                `codigo` = :codigo,
                `detalle` = :detalle,
                `stock` = :stock,
                `seccion_id` = :seccion_id,
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
            $sql = "INSERT INTO `productos`(
                codigo,
                detalle,
                stock,
                seccion_id,
                status
            )
            VALUES(
                :codigo,
                :detalle,
                :stock,
                :seccion_id,
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
            $sql = "DELETE FROM `productos` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    // public function updateFotoroducto($id, $foto): int
    // {
    //     try {
    //         $sql = "UPDATE `productos`
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

    protected function readAllActive(): array
    {
        $sql = "SELECT
            P.id,
            P.codigo,
            P.detalle,
            P.stock,
            S.nombre AS seccion
        FROM
            `productos` P
            INNER JOIN `secciones` S ON S.id = P.seccion_id
        WHERE
            P.status = 1";

        return $this->pdo->query($sql)->fetchAll();
    }

    protected function readAllActiveBySeccion($seccion): array | bool
    {
        $sql = "SELECT
            P.id,
            P.codigo,
            P.detalle,
            P.stock,
            S.nombre AS seccion
        FROM
            `productos` P
            INNER JOIN `secciones` S ON S.id = P.seccion_id
        WHERE
            S.nombre = '{$seccion}'
        AND
            P.status = 1";

        return $this->pdo->query($sql)->fetchAll();
    }

    protected function readActiveById($id): array | bool
    {
        $sql = "SELECT
            P.id,
            P.codigo,
            P.detalle,
            P.stock,
            S.nombre AS seccion
        FROM
            `productos` P
            INNER JOIN `secciones` S ON S.id = P.seccion_id
        WHERE
            P.id = {$id}
        AND
            P.status = 1";

        return $this->pdo->query($sql)->fetch();
    }
}
