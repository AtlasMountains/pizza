<?php

namespace App\Data;

use \PDO;

class StatusDAO extends DBconfig
{
    public function getStatusByID(int $id)
    {
        $sql = 'select status from statussen where id=?';
        $this->connect();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $this->disconnect();
        return $result;
    }

    public function getAllStatussen(): bool|array
    {
        $sql = 'select id,status from statussen order by id';
        $this->connect();
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
}