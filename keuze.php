<?php
declare(strict_types=1);
require_once('vendor/autoload.php');
session_start();
if ((isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true) ||
    (isset($_SESSION['gebruiker']) && $_SESSION['gebruiker'] !== '')) {
    header('location: afrekenen.php');
    exit(0);
}
require_once('App/Views/keuze.php');