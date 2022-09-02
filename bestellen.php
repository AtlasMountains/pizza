<?php
declare(strict_types = 1);

use App\Business\BestellingenService;
use App\Business\GebruikersService;
use App\Entities\Bestelling;
use App\Entities\Gebruikers;

require_once('vendor/autoload.php');
session_start();
// als we pizzas hebben en gegevens dan kunnen we verder anders terug naar overzicht
if (((isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true) ||
        (isset($_SESSION['gegevens']) && $_SESSION['gegevens'] === true)) &&
    (isset($_COOKIE['mandje']) && $_COOKIE['mandje'] !== 'null')) {

    $gebruiker = unserialize($_SESSION['gebruiker'], [Gebruikers::class]);
    $mandje    = json_decode($_COOKIE['mandje'], true);
    $opmerking = htmlspecialchars($_POST['opmerking']);
    $prijs     = $_SESSION['prijzen'][0];

    $bestelling = new Bestelling(
        $gebruiker->getID(), $gebruiker->getKorting(), $opmerking, $prijs, 1, $mandje);

    $bestelSVC = new BestellingenService();
    $success   = $bestelSVC->voegVolledigeBestellingToe($bestelling, $mandje);
    if ($success) {
        $mandje = null;
        setcookie('mandje', '', time() - 60);
    }
} else {
    header('location: afrekenen.php');
    exit(0);
}
if ($gebruiker->getEmail() !== null) {
    $korting = (new GebruikersService())->regelKorting($gebruiker->getEmail());
    $gebruiker->setKorting($korting);
    $_SESSION['gebruiker'] = serialize($gebruiker);
}
header('location: bestelOverzicht.php');
exit(0);