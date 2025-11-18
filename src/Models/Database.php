<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct($host, $port, $dbname, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host={$host};port={$port};dbname={$dbname};charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Se conecto correctamente");
        } catch (PDOException $e) {
            die("Error al conectar: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error en la ejecucion: " . $e->getMessage());
        }
    }

    public function loadDeps()
    {
        return $this->query("SELECT * FROM depart");
    }

    public function loadDep($id)
    {
        return $this->query("SELECT * FROM depart WHERE depart_no=:id", [":id" => $id]);
    }

    public function createDep($a, $b, $c)
    {
        return $this->execute("INSERT INTO depart VALUES (:a, :b, :c)", [":a" => $a, ":b" => $b, ":c" => $c]);
    }

    public function updateDep($a, $b, $c)
    {
        return $this->execute("UPDATE depart SET dnombre= :b, loc= :c WHERE depart_no = :a", [":a" => $a, ":b" => $b, ":c" => $c]);
    }

    public function deleteDep($id)
    {
        return $this->execute("DELETE FROM depart WHERE depart_no = :id", [":id" => $id]);
    }
}
