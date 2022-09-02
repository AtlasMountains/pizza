<?php

namespace App\Data;

use App\Entities\Gebruikers;
use PDO;

class GebruikersDAO extends DBconfig
{
    public function VoegGebruikerToe(Gebruikers $gebruiker): bool|string
    {
        $voornaam   = $gebruiker->getVoornaam();
        $achternaam = $gebruiker->getAchternaam();
        $straat     = $gebruiker->getStraat();
        $huisnummer = $gebruiker->getHuisnummer();
        $postcode   = $gebruiker->getPostcode();
        $gemeente   = $gebruiker->getGemeente();
        $telefoon   = $gebruiker->getTelefoon();
        $email      = $gebruiker->getEmail();
        $wachtwoord = $gebruiker->getWachtwoord();
        $korting    = $gebruiker->getKorting();

        $this->connect();
        $sql  = "insert into gebruikers (voornaam, achternaam, straat, huisnummer, postcode, gemeente, telefoon, email, wachtwoord_hash)
        values (:voornaam,:achternaam,:straat,:huisnummer,:postcode,:gemeente,:telefoon,:email,:wachtwoord)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':voornaam', $voornaam);
        $stmt->bindParam(':achternaam', $achternaam);
        $stmt->bindParam(':straat', $straat);
        $stmt->bindParam(':huisnummer', $huisnummer);
        $stmt->bindParam(':postcode', $postcode);
        $stmt->bindParam(':gemeente', $gemeente);
        $stmt->bindParam(':telefoon', $telefoon);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':wachtwoord', $wachtwoord);
        $result = $stmt->execute();
        if ($result) {
            $id = $this->pdo->lastInsertId();
        }
        $this->disconnect();
        return $id ?? $result;
    }

    public function getGebruikerByEmail(string $email)
    {
        $this->connect();
        $sql  = "select id, voornaam, achternaam, straat, huisnummer, postcode, gemeente,
            telefoon, email, wachtwoord_hash, korting 
            from gebruikers where email=:email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $this->disconnect();
        return $result;
    }

    public function UpdateGebruiker(Gebruikers $gebruiker): bool
    {
        $this->connect();
        $sql    = 'UPDATE gebruikers SET voornaam=:vnaam,achternaam=:anaam,straat=:straat,
                      huisnummer=:huisnr,postcode=:post,gemeente=:gemeente,telefoon=:tel,
                      email=:email,wachtwoord_hash=:ww,korting=:korting
                      WHERE id=:id';
        $stmt   = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'vnaam'    => $gebruiker->getVoornaam(),
            'anaam'    => $gebruiker->getAchternaam(),
            'straat'   => $gebruiker->getStraat(),
            'huisnr'   => $gebruiker->getHuisnummer(),
            'post'     => $gebruiker->getPostcode(),
            'gemeente' => $gebruiker->getGemeente(),
            'tel'      => $gebruiker->getTelefoon(),
            'email'    => $gebruiker->getEmail(),
            'ww'       => $gebruiker->getWachtwoord(),
            'id'       => (int)$gebruiker->getId(),
            'korting'  => $gebruiker->getKorting() ?? 0.0]);
        $this->disconnect();
        return $result;
    }

    public function pasKortingAan(float $korting, int $id): bool
    {
        $this->connect();
        $sql    = 'UPDATE gebruikers SET korting=:korting
                      WHERE id=:id';
        $stmt   = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'id'      => $id,
            'korting' => $korting]);
        $this->disconnect();
        return $result;
    }

    public function getGebruikerByID(int $gebruikerID)
    {
        $this->connect();
        $sql  = "select id, voornaam, achternaam, straat, huisnummer, postcode, gemeente,
            telefoon, email, wachtwoord_hash, korting 
            from gebruikers where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $gebruikerID]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $this->disconnect();
        return $result;
    }

    public function gebruikerBestaatAl(Gebruikers $gebruiker)
    {
        $this->connect();
        $sql  = "select id, voornaam, achternaam, straat, huisnummer, postcode, gemeente, telefoon 
            from gebruikers where voornaam=:vnaam and achternaam=:anaam and straat=:straat and
                                huisnummer=:huisnr and postcode=:post and gemeente=:gemeente and telefoon=:tel";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'vnaam'    => $gebruiker->getVoornaam(),
            'anaam'    => $gebruiker->getAchternaam(),
            'straat'   => $gebruiker->getStraat(),
            'huisnr'   => $gebruiker->getHuisnummer(),
            'post'     => $gebruiker->getPostcode(),
            'gemeente' => $gebruiker->getGemeente(),
            'tel'      => $gebruiker->getTelefoon()
        ]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        $this->disconnect();
        return $result;
    }
}