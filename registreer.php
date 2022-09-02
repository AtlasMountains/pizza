<?php
declare(strict_types = 1);

use App\Business\gebruikersService;
use App\Data\GebruikersDAO;
use App\Entities\Gebruikers;

require_once('vendor/autoload.php');
session_start();
if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] && $_GET['aanpassen'] !== 'ja') {
    header('location: index.php');
    exit(0);
}
$account = '';
if (isset($_GET['aanpassen']) && $_GET['aanpassen'] === 'ja') {
    $gebruiker = unserialize($_SESSION['gebruiker'], [Gebruikers::class]);
    #admin redirect
    if (isset($_SESSION['admin'])) {
        header('location: admin.php');
        exit(0);
    }
    $voornaam   = $gebruiker->getVoornaam();
    $achternaam = $gebruiker->getAchternaam();
    $straat     = $gebruiker->getStraat();
    $huisnummer = $gebruiker->getHuisnummer();
    $postcode   = $gebruiker->getPostcode();
    $gemeente   = $gebruiker->getGemeente();
    $telefoon   = $gebruiker->getTelefoon();
    $korting    = $gebruiker->getKorting();
    $email      = $gebruiker->getEmail() ?? '';
    $id         = $gebruiker->getID();
    if ($email) {
        $account = 1;
    }
} else {
    $voornaam   = '';
    $achternaam = '';
    $straat     = '';
    $huisnummer = '';
    $postcode   = '';
    $gemeente   = '';
    $telefoon   = '';
    $email      = '';
    $korting    = 0.0;
}
if (isset($_POST['submit']) && $_POST['submit'] === 'submit') {
    $voornaam   = htmlspecialchars($_POST['voornaam']);
    $achternaam = htmlspecialchars($_POST['achternaam']);
    $straat     = htmlspecialchars($_POST['straat']);
    $huisnummer = htmlspecialchars($_POST['huisnummer']);
    $postcode   = htmlspecialchars($_POST['postcode']);
    $gemeente   = htmlspecialchars($_POST['gemeente']);
    $telefoon   = htmlspecialchars($_POST['telefoon']);

    $gebruiker     = new Gebruikers($voornaam, $achternaam, $straat, $huisnummer,
        $postcode, $gemeente, $telefoon, $korting, $id ?? null);
    $gebruikersSVC = new gebruikersService();
//    gebruiker gemaakt zonder account, enkel verder indien account nodig
    if (isset($_POST['account']) && (int)$_POST['account'] === 1) {
        $account = 1; #wordt gebruikt in de view
        if (!isset($_POST['email']) && (!isset($_POST['password'], $_POST['password2']))) {
            $error     = 'je moet een email en wachtwoord ingeven om een account aan te maken';
            $gebruiker = '';
        } else {
            $email = filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $error     = 'geen geldig email adres';
                $gebruiker = '';
            } else {
                $wachtwoord = htmlspecialchars($_POST['password']);
                $number     = preg_match('@\d@', $wachtwoord);
                $uppercase  = preg_match('@[A-Z]@', $wachtwoord);
                $lowercase  = preg_match('@[a-z]@', $wachtwoord);
                if (!$number || !$uppercase || !$lowercase || strlen($wachtwoord) < 1) {
                    $error     = 'het wachtwoord moet minstens 1 kleine letter,1 hoofdletter en 1 cijfer bevatten';
                    $gebruiker = '';
                } else {
                    $wachtwoordHerhaling = htmlspecialchars($_POST['password2']);
                    if ($wachtwoord !== $wachtwoordHerhaling) {
                        $error     = 'de wachtwoorden komen niet overeen';
                        $gebruiker = '';
                    } else {
//                        alle velden zijn nu geldig ingevuld
                        $gebruiker->setEmail($email);
                        $wachtwoord_hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
                        $gebruiker->setWachtwoord($wachtwoord_hash);
//                        wil ik bestaande gegevens aanpassen?
                        if (!isset($_GET['aanpassen']) || $_GET['aanpassen'] !== 'ja') {
//                            nieuwe toevoegen
                            try {
                                $gebruikersSVC = new gebruikersService();
                                $gelukt        = $gebruikersSVC->VoegGebruikerToeService($gebruiker);
                                // $gelukt is false of last insert id
                                if ($gelukt) {
                                    $gebruiker->setId($gelukt);
                                    $success              = 'gebruiker toegevoegd';
                                    $_SESSION['ingelogd'] = true;
                                }
                            } catch (Exception) {
                                $error     = 'gebruiker bestaat al, probeer in te loggen';
                                $gebruiker = '';
                            }
                        } else {
                            //  pas bestaand gebruiker aan (alles inc email en ww)
                            $gebruiker->setId($id);
                            $result = $gebruikersSVC->pasGebruikerGegevensAan($gebruiker);
                            if ($result) {
                                $success              = 'gebruiker aangepast';
                                $_SESSION['ingelogd'] = true;
                            }
                        }
                    }
                }
            }
        }
    } else { # end post voor als we geen account willen
        if (!$gebruiker->getId()) {# gebruiker heeft nog geen id => niet toegevoegd aan DB
//           kijk of dezelfde gebruiker ooit als eens iets heeft besteld
            $bestaatAl = $gebruikersSVC->gebruikerBestaatAl($gebruiker);
            if ($bestaatAl) {
                $gebruiker->setId($bestaatAl);
                $success = 'de gebruiker bestaat al we gebruiken deze geen duplicatie';
            } else {
                $gelukt = $gebruikersSVC->VoegGebruikerToeService($gebruiker);
                // $gelukt is false of last insert id
                if ($gelukt) {
                    $gebruiker->setId($gelukt);
                    $success = 'gebruiker toegevoegd';
                }
            }

        } else { #gebruiker had al wel id => eerder toegevoegd aan DB
            $result = $gebruikersSVC->pasGebruikerGegevensAan($gebruiker);
            if ($result) {
                $success = 'gebruiker aangepast';
            }
        }
        setcookie('gebruikerID', (string)$gebruiker->getId(), time() + 3600); #voor 1 uur
        $_SESSION['gegevens'] = true;
    }# end else post account
    if ($gebruiker) {
        $_SESSION['gebruiker'] = serialize($gebruiker);
        setcookie('email', $email, time() + 3600 * 24 * 7); #voor 1week
        header('location: afrekenen.php');
        exit(0);
    }
} #end post submit

require_once('App/Views/registreer.php');