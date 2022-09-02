<?php

namespace App\Entities;

class Gebruikers
{
    private int|null    $id;
    private string      $voornaam;
    private string      $achternaam;
    private string      $straat;
    private string      $huisnummer;
    private string      $postcode;
    private string      $gemeente;
    private string      $telefoon;
    private string|null $email;
    private string|null $wachtwoord;
    private float       $korting;

    // types ?
    public function __construct($voornaam, $achternaam, $straat, $huisnummer,
                                $postcode, $gemeente, $telefoon, $korting = 0.0,
                                $id = null, $email = null, $wachtwoord = null)
    {
        $this->id         = $id;
        $this->voornaam   = $voornaam;
        $this->achternaam = $achternaam;
        $this->straat     = $straat;
        $this->huisnummer = $huisnummer;
        $this->postcode   = $postcode;
        $this->gemeente   = $gemeente;
        $this->telefoon   = $telefoon;
        $this->email      = $email;
        $this->wachtwoord = $wachtwoord;
        $this->korting    = $korting;
    }

    /**
     * @return int|null
     */
    public function getId(): int|null
    {
        return $this->id;
    }

    /**
     * @param mixed|string|null $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getVoornaam(): string
    {
        return $this->voornaam;
    }

    /**
     * @return string
     */
    public function getAchternaam(): string
    {
        return $this->achternaam;
    }

    /**
     * @return string
     */
    public function getStraat(): string
    {
        return $this->straat;
    }

    /**
     * @return string
     */
    public function getHuisnummer(): string
    {
        return $this->huisnummer;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @return string
     */
    public function getTelefoon(): string
    {
        return $this->telefoon;
    }

    /**
     * @return string|null
     */
    public function getEmail(): string|null
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getWachtwoord(): string|null
    {
        return $this->wachtwoord;
    }

    /**
     * @param string $wachtwoord
     */
    public function setWachtwoord(string $wachtwoord): void
    {
        $this->wachtwoord = $wachtwoord;
    }

    /**
     * @return string
     */
    public function getGemeente(): string
    {
        return $this->gemeente;
    }

    /**
     * @return float
     */
    public function getKorting(): float
    {
        return $this->korting;
    }

    /**
     * @param float $korting
     */
    public function setKorting(float $korting): void
    {
        $this->korting = $korting;
    }

}