<?php
declare(strict_types=1);

use App\Business\PizzasService;
use App\Data\GebruikersDAO;
use App\Entities\Gebruikers;

require_once('vendor/autoload.php');
session_start();

$pizzaSVC = new PizzasService();
$pizzas = $pizzaSVC->getPizzasVoorMenu();
$mandje = [];
$totaalPrijs = 0;
if (isset($_COOKIE['mandje']) && $_COOKIE['mandje'] !== 'null') {
    $mandje = json_decode($_COOKIE['mandje']);
    foreach ($mandje as $pizza) {
        $totaalPrijs += $pizza[2];
    }
}
if (isset($_COOKIE['gebruikerID'])) {
//    als ik een gebruiker id heb opgeslagen in de cookie (iemand die iets besteld heeft zonder account)
//    vraag dan de gegevens op vanuit de DB voor deze gebruiker
//    zodat die de bestelling nog altijd kan zien ook als de browser per ongeluk gesloten was
//    cookie beperkte tijd geldig 1uur

    $bg = (new GebruikersDAO())->getGebruikerByID((int)$_COOKIE['gebruikerID']);
    if (!$bg->email) {
        $_SESSION['gegevens'] = true; #zeg dat we met gegevens aan het werken zijn en geen account
        $gebruiker = new Gebruikers($bg->voornaam, $bg->achternaam, $bg->straat, $bg->huisnummer, $bg->postcode, $bg->gemeente, $bg->telefoon, 0.0, $bg->id);
        $_SESSION['gebruiker'] = serialize($gebruiker);
    }
}
require_once('App/Views/menu.php');