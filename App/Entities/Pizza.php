<?php

namespace App\Entities;

class Pizza
{
    private int    $id;
    private string $naam;
    private string $omschrijving;
    private float  $prijs;
    private string $foto;

    // types ???
    public function __construct($id, $naam, $omschrijving, $prijs, $foto)
    {
        $this->id           = $id;
        $this->naam         = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs        = $prijs;
        $this->foto         = $foto;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    /**
     * @return string
     */
    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    /**
     * @return float
     */
    public function getPrijs(): float
    {
        return $this->prijs;
    }

    /**
     * @return string
     */
    public function getFoto(): string
    {
        return $this->foto;
    }

}