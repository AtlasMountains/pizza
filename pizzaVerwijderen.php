<?php
//om de gekozen pizza op te slaan in cookies
require_once('vendor/autoload.php');
session_start();

use App\Data\PizzasDAO;
use App\Entities\Pizza;

if (isset($_GET['verwijder'], $_COOKIE['mandje'])) {
    $id = (int)htmlspecialchars($_GET['verwijder']);
    $mandje = json_decode($_COOKIE['mandje'], true);
    foreach ($mandje as $idm => $item) {
        if ($id !== $idm) {
            $nieuwMandje[$idm] = $item;
        }
    }
    setcookie('mandje', json_encode($nieuwMandje), time() + 60 * 10); #minuten geldig
}
header('location: index.php');
