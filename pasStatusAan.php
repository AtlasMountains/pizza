<?php
declare(strict_types=1);

use App\Data\BestellingenDAO;

require_once('vendor/autoload.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: index.php');
    exit(0);
}

if (isset($_POST['submit'])) {
    $status = (int)htmlspecialchars($_POST['status']);
    $id = (int)htmlspecialchars($_POST['submit']);
    var_dump($status);
    $bestelDAO = new BestellingenDAO();
    $bestelDAO->updateStatus($status, $id);
}
header('location: admin.php');
exit(0);