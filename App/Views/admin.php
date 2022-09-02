<!DOCTYPE html>
<html lang="nl">
<head>
    <?php require_once('head.html'); ?>
    <link rel="stylesheet" href="assets/bootstrap-table.min.css">
</head>
<body>
<?php require_once('nav.php');
if (isset($error) && $error) :?>
    <div class="alert alert-warning">
        <p><?= $error ?></p>
    </div>
    <!--    <div class="container"><a href="index.php" class="btn btn-primary">Terug</a></div>-->
<?php endif; ?>
<?php if (isset($success) && $success) : ?>
    <div class="alert alert-success">
        <p><?= $success ?></p>
    </div>
<?php endif; ?>

<div class="container mb-3 text-center">
    <div class="container-md"><h1>Admin panel</h1></div>
    <!-- gegevens van de bestelling -->
    <div class="row">
        <div class="">
            <div class="row mb-3">
                <div class="col"><strong>Bestelling (id)</strong></div>
                <div class="col"><strong>datum</strong></div>
                <div class="col"><strong>prijs</strong></div>
                <div class="col"><strong>korting</strong></div>
                <div class="col"><strong>eind bedrag</strong></div>
                <div class="col"><strong>status</strong></div>
                <div class="col"><strong>opmerking</strong></div>
                <!--                <div class="col"><strong>actie</strong></div>-->
            </div>
            <div class="accordion" id="myAccordion">
                <?php if (isset($bestellingen)): ?>
                    <?php foreach ($bestellingen as $bestelling): ?>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <div class="row mb-1">
                                    <div class="accordion-button collapsed text-center" data-bs-toggle="collapse"
                                         data-bs-target="#collapse<?= $bestelling['id'] ?>">
                                        <div class="col"><?= $bestelling['id'] ?></div>
                                        <div class="col"><?= $bestelling['time'] ?></div>
                                        <div class="col"><?= $bestelling['prijs'] ?></div>
                                        <div class="col"><?= $bestelling['korting'] ?></div>
                                        <div class="col"><?= $bestelling['prijs'] - $bestelling['korting'] ?></div>
                                        <div class="col"><?= $statusDAO->getStatusByID($bestelling['statusID'])->status ?></div>
                                        <div class="col"><?= $bestelling['opmerking'] ?></div>
                                    </div>
                                    <form action="pasStatusAan.php" method="post">
                                        <label for="status">status</label>
                                        <select name="status" id="status">
                                            <?php foreach ($statussen as $status): ?>
                                                <?php var_dump($status); ?>
                                                <option value="<?= $status['id'] ?>"><?= $status['status'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" name="submit" value="<?= $bestelling['id'] ?>"
                                                class="btn btn-info">pas aan
                                        </button>
                                    </form>
                                </div>

                            </div>
                            <div class="accordion-collapse collapse" data-bs-parent='#myAccordion'
                                 id="collapse<?= $bestelling['id'] ?>">
                                <!-- details van de bestelling -->
                                <div class="accordion-body">
                                    <div class="row mb-2">
                                        <div class="col"><strong>foto</strong></div>
                                        <div class="col"><strong>naam</strong></div>
                                        <div class="col"><strong>omschrijving</strong></div>
                                        <div class="col"><strong>aantal</strong></div>
                                        <div class="col"><strong>prijs</strong></div>
                                    </div>
                                    <?php foreach ($pizzas[$bestelling['id']] as $pizza): ?>
                                        <div class="row">
                                            <div class="col">
                                                <img src="<?= $pizza['foto'] ?>" width="145.5" height="100"
                                                     alt="">
                                            </div>
                                            <div class="col"><?= $pizza['naam'] ?></div>
                                            <div class="col"><?= $pizza['omschrijving'] ?></div>
                                            <div class="col"><?= $pizza['aantal'] ?></div>
                                            <div class="col">€<?= $pizza['prijs'] ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- end row-->
</div>
</body>
</html>

