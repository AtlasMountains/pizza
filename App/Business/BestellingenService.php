<?php

namespace App\Business;

use App\Data\BestelLijnenDAO;
use App\Data\BestellingenDAO;
use App\Entities\Bestelling;
use App\Entities\Gebruikers; // wat niet gebruikt wordt mag weg

class BestellingenService
{
//als gebruiker wil ik mijn bestelling toevoegen
    public function voegVolledigeBestellingToe(Bestelling $bestelling, array $lijnen) // output type?
    {
//        bestelling toe voegen
        $bestelDAO = new BestellingenDAO();
        $bestelID = $bestelDAO->voegBestellingToe(
            $bestelling->getGebruikerID(),
            $bestelling->getPrijs(),
            $bestelling->getKorting(),
            $bestelling->getOpmerking(),
            $bestelling->getStatusID()
        );
        if ($bestelID) {
            $success = 'bestelling gelukt';
//            // bestelLijnen toe voegen
            $bestelLijnDAO = new BestelLijnenDAO();
            $lijnIDs = [];
            foreach ($lijnen as $lijn) {
                $id = $bestelLijnDAO->voegLijnToe(
                    $bestelID,
                    $lijn[3], #pizzaID
                    $lijn[1], #aantal
                    $lijn[2] #prijs
                );
                $lijnIDs[] = $id;
            }
            $success = 'volledige bestelling gelukt';
        }
        return $success ?? 'niet gelukt';
    }
}