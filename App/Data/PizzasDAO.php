<?php

namespace App\Data;

use PDO;

class PizzasDAO extends DBconfig
{
    public function getAllPizzas(): bool|array
    {
        $this->connect();
        $sql = 'select id,naam,omschrijving,catalogusPrijs,fotoLink from pizzas';
        $result = $this->pdo->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }

    public function getById(int $id): bool|array
    {
        $this->connect();
        $sql = 'select id,naam,omschrijving,catalogusPrijs,fotoLink from pizzas where id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
}