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
<?php if (isset($message) && $message) : ?>
    <div class="alert alert-info">
        <p><?= $message ?></p>
    </div>
<?php endif; ?>
<?php if (isset($success) && $success) : ?>
    <div class="alert alert-success">
        <p><?= $success ?></p>
    </div>
<?php endif; ?>
<div class="container-fluid mb-3">
    <h1>Afrekenen </h1>
    <!-- gegevens van de bestelling -->
    <div class="row">
        <?php if ($pizzas): ?>
            <table class="col table text-center">
                <thead>
                <tr>
                    <th scope="col">foto</th>
                    <th scope="col">pizza</th>
                    <th scope="col">omschrijving</th>
                    <th scope="col">aantal</th>
                    <th scope="col">prijs</th>
                    <th scope="col">actie</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pizzas as $id => $item): ?>
                    <tr>
                        <!--  foto  -->
                        <td><img src="<?= $item[5] ?>" width="145.5" height="100" alt=""></td>
                        <!--  naam  -->
                        <td><?= $item[0] ?></td>
                        <!--  omschrijving  -->
                        <td><?= $item[4] ?></td>
                        <!--  aantal  -->
                        <td><?= $item[1] ?></td>
                        <!--  prijs  -->
                        <td>€<?= $item[2] ?></td>
                        <td>
                            <form action="" method="get">
                                <button class="btn btn-outline-danger" type="submit" name="verwijder"
                                        value="<?= $item[3] ?>"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <!-- gegevens van de gebruiker -->
        <div class="col-md-auto text-center">
            <div class="card p-2 mb-2">
                <h3 class="card-title">Gebruiker</h3>
                <p>zijn deze gegevens correct?</p>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if ($gebruiker): ?>
                            <li class="list-group-item">
                                <div class="row justify-content-center">
                                    <div class="col"><?php echo $gebruiker->getVoornaam() ?></div>
                                    <div class="col"><?= $gebruiker->getAchternaam() ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row justify-content-center">
                                    <div class="col"><?php echo $gebruiker->getStraat() ?></div>
                                    <div class="col"><?= $gebruiker->getHuisnummer() ?></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row justify-content-center">
                                    <div class="col"><?php echo $gebruiker->getPostcode() ?></div>
                                    <div class="col"><?= $gebruiker->getGemeente() ?></div>
                                </div>
                            </li>
                            <li class="list-group-item"><?= $gebruiker->getTelefoon(); ?></li>
                        <?php else: ?>
                            <li class="list-group-item">we hebben gegevens nodig</li>
                        <?php endif; ?>
                        <li class="list-group-item">
                            <a href="registreer.php?aanpassen=ja" class="btn btn-info">Aanpassen</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <a href="index.php" class="btn btn-primary">Menu</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-light">
            <thead>
            <tr>
                <th scope="col">totaal</th>
                <th scope="col">korting</th>
                <th scope="col">Eind bedrag</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>€<?= $totaalPrijs ?></td>
                <td>€<?= $korting ?></td>
                <td>€<?= $eindPrijs ?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <?php if (!isset($error) && isset($pizzas) && $gebruiker): ?>
    <form action="bestellen.php" method="post" class="d-inline">
        <button class="btn btn-success" type="submit" name="submit" value="submit">Bestellen</button>
        <label for="opmerking" class="form-label">Opmerking</label>
        <input type="text" class="" name="opmerking" id="opmerking" maxlength="20">
        <?php endif; ?>
    </form>
</div>
</body>
</html>