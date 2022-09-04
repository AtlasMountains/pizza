<?php
declare(strict_types=1);
require_once('vendor/autoload.php');
session_start();

use App\Business\GebruikersService;
use App\Data\GebruikersDAO;
use App\Entities\Gebruikers;

$email = '';
if (isset($_COOKIE['email'])) {
    $email = htmlspecialchars($_COOKIE['email']);
}
if (isset($_POST['submit']) && $_POST['submit'] === 'true') {
    $email = filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $error = 'geen geldig email adres';
    } else {
        $wachtwoord = htmlspecialchars($_POST['password']);
        $gebruikersSVC = new GebruikersService();
        $gelukt = $gebruikersSVC->inloggen($email, $wachtwoord);
        if ($gelukt) {
            $success = 'je bent ingelogd';
            $_SESSION['ingelogd'] = true;
            $_SESSION['gegevens'] = false;
            setcookie('email', $email, time() + 60 * 60 * 24); #voor 1 dag
            $gebruikersDAO = new GebruikersDAO();
            $gebruikerdata = $gebruikersDAO->getGebruikerByEmail($email);
            $gebruiker = new Gebruikers($gebruikerdata->voornaam, $gebruikerdata->achternaam, $gebruikerdata->straat,
                $gebruikerdata->huisnummer, $gebruikerdata->postcode, $gebruikerdata->gemeente, $gebruikerdata->telefoon,
                $gebruikerdata->korting, $gebruikerdata->id, $gebruikerdata->email, $gebruikerdata->wachtwoord_hash);
            $_SESSION['gebruiker'] = serialize($gebruiker);
            if (isset($_COOKIE['mandje']) && $_COOKIE['mandje']) {
                header('location: afrekenen.php');
                exit(0);
            }
            #admin redirect
            if ($email === 'admin@mail.com') {
                $_SESSION['admin'] = true;
                header('location: admin.php');
                exit(0);
            }
            header('location: index.php');
            exit(0);
        }
        $error = 'email en/of wachtwoord niet correct';
    }
}
require_once('App/Views/inloggen.php');