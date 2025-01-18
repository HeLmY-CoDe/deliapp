<?php

class InventariosModel extends Database
{
    private $pdo;

    protected function __construct()
    {
        $this->pdo = parent::connect();
    }

    protected function readAll(): array
    {
        $sql = "SELECT
            I.id,
            I.fecha,
            I.status,
            U.nombres AS usuario
        FROM
            `inventarios` I
        INNER JOIN `usuarios` U ON
            U.id = I.usuario_id";

        return $this->pdo->query($sql)->fetchAll();
    }

    protected function readById(int $id): array
    {
        try {
            $sql = "SELECT * FROM `inventarios` WHERE id = :id";
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
            $sql = "UPDATE
                `inventarios`
            SET
                `fecha` = :fecha,
                `usuario_id` = :usuario_id,
                `status` = :status
            WHERE
                id = :id";

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
            $sql = "INSERT INTO
            `inventarios` (
                `fecha`,
                `usuario_id`,
                `status`
            )
            VALUES (
                :fecha,
                :usuario_id,
                :status
            )";

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
            $sql = "DELETE FROM `inventarios` WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }
}
