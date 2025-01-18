<?php

class ClientesModel extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function readAll(): array
    {
        $sql = "SELECT * FROM `clientes`";

        return $this->pdo->query($sql)->fetchAll();
    }

    public function readById(int $id): array
    {
        try {
            $sql = "SELECT * FROM `clientes` WHERE id = :id";
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
                `clientes`
            SET
                `nombres` = :nombres,
                `apellidos` = :apellidos,
                `fecha_nacimiento` = :fecha_nacimiento,
                `celular` = :celular,
                `direccion` = :direccion,
                `email` = :email,
                {$passwordField}
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

    public function create($createData)
    {
        try {
            $sql = "INSERT INTO `clientes`(
                nombres,
                apellidos,
                fecha_nacimiento,
                celular,
                direccion,
                email,
                password,
                status
            )
            VALUES(
                :nombres,
                :apellidos,
                :fecha_nacimiento,
                :celular,
                :direccion,
                :email,
                :password,
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
            $sql = "DELETE FROM `clientes` WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }
}
