<?php

namespace App\Entities;

class Bestelling
{
    private ?int   $id;
    private int    $gebruikerID;
    private string $time;
//date('Y-m-d H:i:s','1299762201428') => dit soort comments altijd verwijderen
    private float  $prijs;
    private float  $korting;
    private string $opmerking;
    private int    $statusID;
    private ?array $bestelLijnen;

    // types ???
    public function __construct($gebruikerID, $korting, $opmerking, $prijs, $statusID, $bestelLijnen = null, $id = null)
    {
        $this->id           = $id;
        $this->gebruikerID  = $gebruikerID;
        $this->korting      = $korting;
        $this->opmerking    = $opmerking;
        $this->bestelLijnen = $bestelLijnen;
        $this->prijs        = $prijs;
        $this->statusID     = $statusID;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getGebruikerID(): int
    {
        return $this->gebruikerID;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @return float
     */
    public function getPrijs(): float
    {
        return $this->prijs;
    }

    /**
     * @return float
     */
    public function getKorting(): float
    {
        return $this->korting;
    }

    /**
     * @return string
     */
    public function getOpmerking(): string
    {
        return $this->opmerking;
    }

    /**
     * @return int
     */
    public function getStatusID(): int
    {
        return $this->statusID;
    }

    /**
     * @return mixed
     */
    public function getBestelLijnen(): mixed // komt niet overeen met annotations
    {
        return $this->bestelLijnen;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }

}