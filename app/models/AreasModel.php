<?php

class AreasModel extends Database
{
    private $pdo;

    protected function __construct()
    {
        $this->pdo = parent::connect();
    }

    protected function readAll(): array
    {
        $sql = "SELECT * FROM `areas`";
        return $this->pdo->query($sql)->fetchAll();
    }

    protected function readById(int $id): array
    {
        try {
            $sql = "SELECT * FROM `areas` WHERE id = :id";
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
            $sql = "UPDATE `areas`
            SET
            `nombre` = :nombre,
            `descripcion` = :descripcion,
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
            $sql = "INSERT INTO `areas` (nombre, descripcion, status)
            VALUES (:nombre, :descripcion, :status)";

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
            $sql = "DELETE FROM `areas` WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function readAllActive(): array
    {
        $sql = "SELECT id, nombre, descripcion FROM `areas` WHERE status = 1";
        return $this->pdo->query($sql)->fetchAll();
    }
}
