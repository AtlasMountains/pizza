<?php

declare(strict_types = 1);

namespace App\Business;

use App\Data\PizzasDAO;
use App\Entities\Pizza;

class PizzasService
{
//    asl gebruiker wil ik een menu met alle pizzas op
    public function getPizzasVoorMenu(): bool|array
    {
        $result = [];
        $pizzas = new PizzasDAO();
        $pizzas = $pizzas->getAllPizzas();
        if ($pizzas) {
            foreach ($pizzas as $pizza) {
                $result[] = new Pizza($pizza['id'], $pizza['naam'], $pizza['omschrijving'], $pizza['catalogusPrijs'], $pizza['fotoLink']);
            }
            return $result;
        }
        return false;
    }

//als gebruiker wil ik mijn mandje controleren in een overzicht
    public function getPizzasVoorBestelling(): ?array // wordt nergens gebruikt???
    {
        if (isset($_COOKIE['mandje']) && $_COOKIE['mandje'] !== 'null') {
            $mandje    = json_decode($_COOKIE['mandje'], true);
            $pizzasDAO = new PizzasDAO();
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
                }
            }
            return $nieuwmandje ?? null;
        }
        header('location: index.php');
        exit(0);
    }
}