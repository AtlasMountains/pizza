<?php
declare(strict_types = 1);
require_once('vendor/autoload.php');
session_start();

use App\Business\GebruikersService;

// niet nodig
use App\Data\BestelLijnenDAO;
use App\Data\BestellingenDAO;
use App\Data\GebruikersDAO;

// niet nodig
use App\Data\PizzasDAO;
use App\Data\StatusDAO;
use App\Entities\Gebruikers;

// niet nodig

if (!isset($_SESSION['admin'])) {
    header('location: index.php');
    exit(0);
}

$statusDAO     = new StatusDAO();
$statussen     = $statusDAO->getAllStatussen();
$bestelDAO     = new BestellingenDAO();
$bestellingen  = $bestelDAO->getAlles();
$bestelLijnDAO = new BestelLijnenDAO();
$pizzaDAO      = new PizzasDAO();
$pizzaLijnen   = [];
$pizzas        = [];
if (!$bestellingen) {
    $error = 'er heeft nog niemand iets besteld';
} else {
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
}
require_once('App/Views/admin.php');
