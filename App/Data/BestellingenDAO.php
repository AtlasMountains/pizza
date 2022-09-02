<?php

namespace App\Data;

use \PDO;

class BestellingenDAO extends DBconfig
{
    public function voegBestellingToe(int    $gebruikerID, float $prijs, float $korting,
                                      string $opmerking, int $statusID = 1): bool|string
    {
        $sql = 'INSERT INTO bestellingen 
                    (gebruikerID,prijs,korting,opmerking,statusID) 
            VALUES  (:gebruikerID,:prijs,:korting,:opm,:statusID)';
        $this->connect();
        $stmt   = $this->pdo->prepare($sql);
        $result = $stmt->execute([
                'gebruikerID' => $gebruikerID,
                'prijs'       => $prijs,
                'korting'     => $korting,
                'opm'         => $opmerking,
                'statusID'    => $statusID]
        );
        if ($result) {
            $result = $this->pdo->lastInsertId();
        }
        $this->disconnect();
        return $result;
    }

    public function getAlleVanGebruiker(int $id): bool|array
    {
        $sql = 'select id,gebruikerID,time,prijs,korting,opmerking,statusID from bestellingen where gebruikerID=? order by time desc';
        $this->connect();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }

    public function getBestellingByID(int $id): object|bool
    {
        $sql = 'select id,gebruikerID,time,prijs,korting,opmerking,statusID from bestellingen where id=?';
        $this->connect();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $this->disconnect();
        return $result;
    }

    public function getAlles(): bool|array
    {
        $sql = 'select id,gebruikerID,time,prijs,korting,opmerking,statusID from bestellingen order by time desc';
        $this->connect();
        $stmt   = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }

    public function updateStatus(int $staat, int $id): bool
    {
        $sql = 'update bestellingen set statusID=:staat where id=:id';
        $this->connect();
        $stmt   = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'id'    => $id,
            'staat' => $staat
        ]);
        $this->disconnect();
        return $result;
    }
}