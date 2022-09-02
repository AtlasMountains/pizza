<?php
// controller enkel om mandje leeg te maken
// zo kan je de cookie weg doen zonder uit te loggen
// en uit loggen zonder het mandje te verliezen
declare(strict_types=1);
require_once("vendor/autoload.php");
session_start();

setcookie('mandje', '', time() - 60);

header("location: index.php");
exit(0);