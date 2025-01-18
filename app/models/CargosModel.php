<?php

class CargosModel extends Database
{
    private $pdo;

    protected function __construct()
    {
        $this->pdo = parent::connect();
    }

    protected function readAll(): array
    {
        $sql = "SELECT * FROM `cargos`";
        return $this->pdo->query($sql)->fetchAll();
    }

    protected function readById(int $id): array
    {
        try {
            $sql = "SELECT * FROM `cargos` WHERE id = :id";
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
            $sql = "UPDATE `cargos`
            SET
            `nombre` = :nombre,
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
            $sql = "INSERT INTO `cargos` (nombre, status)
            VALUES (:nombre, :status)";

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
            $sql = "DELETE FROM `cargos` WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    protected function readAllActive(): array
    {
        $sql = "SELECT id, nombre FROM `cargos` WHERE status = 1";
        return $this->pdo->query($sql)->fetchAll();
    }
}
