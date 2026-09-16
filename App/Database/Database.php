<?php

namespace App\Database;

use PDO;
use PDOStatement;

class Database
{
    public string $dsn;
    private PDO $conn;

    public function __construct()
    {
        $this->dsn = getDsn();
        $this->conn = new PDO($this->dsn, config()['user'], config()['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query, array $bindParams = [], mixed $setFetchClass = null): PDOStatement
    {
        // TODO: consertar esse setFetch por argumento - $classNameForSetFetch
        if (empty($bindParams)) {
            $stmt = $this->conn->query($query);
            // if (!empty($classNameForSetFetch))  $stmt->setFetchMode(PDO::FETCH_CLASS, $classNameForSetFetch);
        }

        if (!empty($bindParams)) {
            $stmt = $this->conn->prepare($query);

            if (!empty($setFetchClass)) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, $setFetchClass);
            }

            $stmt->execute($bindParams);
        }

        return $stmt;
    }
}
