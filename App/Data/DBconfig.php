<?php

namespace App\Data;

use \PDO;
use \Exception;
use PDOException;

abstract class DBconfig
{
    private string $DB_CONNSTRING = "mysql:host=localhost;dbname=pizza;charset=utf8";
    private string $DB_USERNAME = "root";
    private string $DB_PASSWORD = "root";
    private string $error;
    protected ?PDO $pdo;

    protected function connect(): void
    {
        try {
            $this->pdo = new PDO($this->DB_CONNSTRING, $this->DB_USERNAME, $this->DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error; // echo in classes?
        }
    }

    protected function disconnect(): void
    {
        $this->pdo = null;
    }
}