<?php

namespace App\Data;

use \PDO;

class BestelLijnenDAO extends DBconfig
{
    public function voegLijnToe(int   $bestelID, int $pizzaID, int $aantal,
                                float $prijs): bool|string
    {
        $sql = 'insert into bestellijnen (bestelID, pizzaID, aantal, prijs) 
        values (
            :bestelID,:pizzaID,:aantal,:prijs
        )';
        $this->connect();
        $stmt   = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'bestelID' => $bestelID,
            'pizzaID'  => $pizzaID,
            'aantal'   => $aantal,
            'prijs'    => $prijs
        ]);
        if ($result) {
            $result = $this->pdo->lastInsertId();
        }
        $this->disconnect();
        return $result;
    }

    public function getAllByBestelID(int $bestelID)
    {
        $sql = 'select pizzaID,aantal,prijs from bestellijnen where bestelID=?';
        $this->connect();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$bestelID]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
}