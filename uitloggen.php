<?php
// uitloggen.php
declare(strict_types=1);
require_once("vendor/autoload.php");
session_start();
if (isset($_SESSION["ingelogd"])) {
    unset($_SESSION);
    unset($_COOKIE['gebruikerID']);
    session_destroy();
}
header("location: index.php");
exit(0);