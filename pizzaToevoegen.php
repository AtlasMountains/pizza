<?php
//om de gekozen pizza op te slaan in cookies
require_once('vendor/autoload.php');
session_start();

use App\Data\PizzasDAO;
use App\Entities\Pizza;

if (isset($_GET['id'], $_GET['amount'])) {
    $id = (int)htmlspecialchars($_GET['id']);
    $amount = (int)htmlspecialchars($_GET['amount']);
    $mandje = [];
    if (isset($_COOKIE['mandje'])) {
        $mandje = json_decode($_COOKIE['mandje'], true);
    }
    $pizzasDAO = new PizzasDAO();
    $pizza = $pizzasDAO->getById($id);
    $naam = $pizza['naam'];
    $prijs = $pizza['catalogusPrijs'];
    foreach ($mandje as $idm => $item) {
        if ($id === $idm) {
            $amount += $item[1];
        }
    }
    $mandje[$id] = [$naam, $amount, $amount * $prijs];
    setcookie('mandje', json_encode($mandje), time() + 60 * 10); #10minuten geldig
}
header('location: index.php');
