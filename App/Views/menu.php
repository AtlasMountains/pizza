<?php
declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <?php require_once('head.html'); ?>
</head>
<body>
<?php require_once('nav.php');
if (isset($error) && $error) :?>
    <div class="alert alert-warning">
        <p><?= $error ?></p>
    </div>
<?php endif; ?>
<?php if (isset($success) && $success) : ?>
    <div class="alert alert-success">
        <p><?= $success ?></p>
    </div>
<?php endif; ?>

<div class="container-fluid mt-4 mb-4">
    <div class="container-lg">
        <h1>welcome in de pizza Zaak</h1>
        <p class="h5 text-muted">bekijk hier het menu</p>
    </div>
    <section class="container-xxl">

        <div class="row">
            <div class="col mb-3">
                <div class="row g-2">
                    <!--  Pizzas tonen  -->
                    <?php if ($pizzas) : ?>
                        <?php foreach ($pizzas as $pizza): ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="card" max-width="220">
                                    <img src="<?= $pizza->getFoto() ?>"
                                         class="card-img-top" alt="<?= $pizza->getNaam() ?>">
                                    <div class="card-body">
                                        <form action="pizzaToevoegen.php" method="get">
                                            <h5 class="card-title"><?= $pizza->getNaam() ?></h5>
                                            <p class="card-text"><?= $pizza->getOmschrijving() ?></p>
                                            <div class="row">
                                                <p class="col">€<?= $pizza->getPrijs() ?></p>
                                                <input type="number" name='amount' class="col form-control"
                                                       value="1" min="1">
                                                <button type="submit" name='id' value="<?= $pizza->getId() ?>"
                                                        class="btn btn-primary col">toevoegen
                                                </button>
                                                <!-- als je op toevoegen drukt item toevoegen aan winkelmandje opslaan in een cookie-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- winkelmandje als er iets in zit-->
            <?php if ($mandje): ?>
                <div class="col-md-auto" id="mandje">
                    <div class="card">
                        <h5 class="card-title text-center">Winkelmandje <small><a href="mandjeLeeg.php"
                                                                                  class="btn btn-outline-danger"><i
                                            class="bi bi-trash3-fill"></i></a></small>
                        </h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row text-center">
                                        <p class="col">naam</p>
                                        <p class="col">stuks</p>
                                        <p class="col">prijs</p>
                                    </div>
                                </li>
                                <!-- item oproepen uit cookie -->
                                <?php foreach ($mandje as $id => $pizza): ?>
                                    <li class="list-group-item">
                                        <form class="row text-center" method="get" action="pizzaVerwijderen.php">
                                            <p class="col"><?= $pizza[0] ?></p>
                                            <!--  naam-->
                                            <p class="col"><?= $pizza[1] ?></p>
                                            <!--  amount-->
                                            <p class="col">€<?= $pizza[2] ?></p>
                                            <!--   prijs-->
                                            <button class="col btn-close" name="verwijder" value="<?= $id ?>"></button>
                                        </form>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="card-footer">
                                <p>totaal prijs</p>
                                <div class="row">
                                    <p class="col">€<?= $totaalPrijs ?></p>
                                    <a href="keuze.php" class="btn btn-success col">Afrekenen</a>
                                    <!-- link naar keuze, inloggen/registreren en verder gaan-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
</body>
</html>