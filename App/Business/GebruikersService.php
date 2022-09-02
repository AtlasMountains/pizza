<?php

namespace App\Business;

use App\Data\BestellingenDAO;
use App\Data\GebruikersDAO;
use App\Entities\Gebruikers;

class GebruikersService
{
    public function VoegGebruikerToeService(Gebruikers $gebruiker): string|bool
    {
        return (new GebruikersDAO())->voegGebruikerToe($gebruiker);
    }

    public function pasGebruikerGegevensAan(Gebruikers $gebruiker): bool
    {
        return (new GebruikersDAO())->UpdateGebruiker($gebruiker);
    }

    public function inloggen(string $email, string $wachtwoord): string|bool
    {
        $gebruiker = (new GebruikersDAO())->getGebruikerByEmail($email);
        if ($gebruiker && password_verify($wachtwoord, $gebruiker->wachtwoord_hash)) {
            $_SESSION['ingelogd'] = true;
            $_SESSION['gebruiker'] = $gebruiker;
            return true;
        }
        return false;
    }

    public function regelKorting(string $email): float|bool
    {
        $gebruiker = (new GebruikersDAO())->getGebruikerByEmail($email);
        $bestellingen = (new BestellingenDAO())->getAlleVanGebruiker($gebruiker->id);
        $vorigeKorting = 0;
        $korting = 0;
        for ($i = 0; $i < 3; $i++) {
            $vorigeKorting += $bestellingen[$i]['korting'] ?? 1;
        }
        if (!$vorigeKorting) {
            $korting = 5.0;
        }
        $gelukt = (new GebruikersDAO())->pasKortingAan($korting, $gebruiker->id); // $gelukt wordt nergens gebruikt
        return $korting;
    }

    public function gebruikerBestaatAl(Gebruikers $gebruiker)
    {
        $bg = (new GebruikersDAO())->gebruikerBestaatAl($gebruiker); // $bg ? probeer betekenisvolle benamingen te gebruiken
        if ($bg) {
            return $bg->id;
        }
        return false;
    }
}