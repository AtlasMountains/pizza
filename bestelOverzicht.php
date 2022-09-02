<?php
declare(strict_types = 1);

use App\Business\BestellingenService;
use App\Business\GebruikersService;
use App\Data\BestelLijnenDAO;
use App\Data\BestellingenDAO;
use App\Data\PizzasDAO;
use App\Data\StatusDAO;
use App\Entities\Bestelling;
use App\Entities\Gebruikers;

require_once('vendor/autoload.php');
session_start();
#admin redirect
if (isset($_SESSION['admin'])) {
    header('location: admin.php');
    exit(0);
}

if (!((isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true) ||
    (isset($_SESSION['gegevens']) && $_SESSION['gegevens'] === true))) {

    header('loaction : index.php');

} else {
    $gebruiker     = unserialize($_SESSION['gebruiker'], [Gebruikers::class]);
    $statusDAO     = new StatusDAO();
    $bestelDAO     = new BestellingenDAO();
    $bestellingen  = $bestelDAO->getAlleVanGebruiker($gebruiker->getID());
    $bestelLijnDAO = new BestelLijnenDAO();
    $pizzaDAO      = new PizzasDAO();
    $pizzaLijnen   = [];
    $pizzas        = [];
    if ($bestellingen) {
        foreach ($bestellingen as $bestelling) {
            $bestelID    = $bestelling['id'];
            $pizzaLijnen = $bestelLijnDAO->getAllByBestelID((int)$bestelID);
            foreach ($pizzaLijnen as $pizzaLijn) {
                $pizza                     = $pizzaDAO->getById((int)$pizzaLijn['pizzaID']);
                $pizzaLijn['foto']         = $pizza['fotoLink'];
                $pizzaLijn['naam']         = $pizza['naam'];
                $pizzaLijn['omschrijving'] = $pizza['omschrijving'];
                $pizzas[$bestelID][]       = $pizzaLijn;
            }
        }
    } else {
        $error = 'je hebt nog geen bestellingen';
    }
}
require_once('App/Views/overzichtBestellingen.php');