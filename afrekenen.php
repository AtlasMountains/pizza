<?php
declare(strict_types = 1);

use App\Business\PizzasService;

// niet nodig
use App\Data\PizzasDAO;
use App\Entities\Gebruikers;

require_once('vendor/autoload.php');
session_start();
#admin redirect
if (isset($_SESSION['admin'])) {
    header('location: admin.php');
    exit(0);
}
//gegevens voor bestelling
$pizzas = null;
if (isset($_COOKIE['mandje']) && $_COOKIE['mandje'] !== 'null') {
    $mandje      = json_decode($_COOKIE['mandje'], true);
    $pizzasDAO   = new PizzasDAO();
    $totaalPrijs = 0;
    foreach ($mandje as $idm => $item) {
        $id = null;
        if (isset($_GET['verwijder']) && $_GET['verwijder']) {
            $id = (int)htmlspecialchars($_GET['verwijder']);
        }
        if ($idm !== $id) {
            $pizza             = $pizzasDAO->getById($idm);
            $omschrijving      = $pizza['omschrijving'];
            $naam              = $pizza['naam'];
            $amount            = $item[1];
            $prijs             = $amount * $pizza['catalogusPrijs'];
            $foto              = $pizza['fotoLink'];
            $nieuwmandje[$idm] = [$naam, $amount, $prijs, $idm, $omschrijving, $foto];
            $totaalPrijs       += $prijs;
        }
    }
    $pizzas = $nieuwmandje ?? null;
    setcookie('mandje', json_encode($pizzas), time() + 60 * 10); # 10 minuten geldig
} elseif (!isset($_SESSION['gebruiker'])) {
    header('location: index.php');
    exit(0);
}
// gegevens van gebruiker
$gebruiker = unserialize($_SESSION['gebruiker'], [Gebruikers::class]);
if (!$gebruiker->getEmail()) {
    $message = 'u wilt bestellen zonder account, opgelet je kan enkel je bestellingen zien zolang je deze browser openhoud, als je het toch per ongeluk hebt gesloten dan kan je uw gegevens en bestelling nog tot 1uur later bekijken';
}
$korting             = $gebruiker->getKorting() ?? 0;
$totaalPrijs         = $totaalPrijs ?? 0;
$eindPrijs           = $totaalPrijs - $korting;
$_SESSION['prijzen'] = [$totaalPrijs, $korting, $eindPrijs];
if ($gebruiker && ($gebruiker->getPostcode() < 2000 || $gebruiker->getPostcode() > 2100)) {
    $error = 'wij leveren niet in deze regio, enkel in 2000-2100';
}
require_once('App/Views/afrekenen.php');