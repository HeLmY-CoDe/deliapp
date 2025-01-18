<?php

class SeccionesModel extends Database
{
    private $pdo;

    protected function __construct()
    {
        $this->pdo = parent::connect();
    }

    protected function readAll(): array
    {
        $sql = "SELECT
            S.id,
            S.nombre,
            S.descripcion,
            S.status,
            A.nombre AS area
        FROM
            `secciones` S
        INNER JOIN `areas` A ON
            A.id = S.area_id
        ORDER BY
            S.id";

        return $this->pdo->query($sql)->fetchAll();
    }

    protected function readById(int $id): array
    {
        try {
            $sql = "SELECT * FROM `secciones` WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([':id' => $id]);

            $result = $stmt->fetch();

            return $result ?: [];
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function update($updateData): int
    {
        try {
            $sql = "UPDATE `secciones`
            SET
            `nombre` = :nombre,
            `descripcion` = :descripcion,
            `area_id` = :area_id,
            `status` = :status
            WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($updateData);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function create($createData)
    {
        try {
            $sql = "INSERT INTO `secciones` (nombre, descripcion, area_id, status)
            VALUES (:nombre, :descripcion, :area_id, :status)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($createData);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function deleteById(int $id): int
    {
        try {
            $sql = "DELETE FROM `secciones` WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function readAllActive(): array
    {
        $sql = "SELECT id, nombre, descripcion FROM `secciones` WHERE status = 1";
        return $this->pdo->query($sql)->fetchAll();
    }
}
