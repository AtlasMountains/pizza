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
<div class="container">
    <h1>Wie Zijn Wij</h1>
    <div class="card bg-light mt-2 mb-2">
        <h2 class="card-title">bezorgen</h2>
        <p class="card-body">wij bezorgen enkel in de postcodes 2000-2100</p>
    </div>
    <div class="card bg-light mt-2 mb-2">
        <h2 class="card-title">promo</h2>
        <p class="card-body">na 3 bestellingen(zonder korting) 5 euro korting</p>
    </div>
    <div class="card bg-light mt-2 mb-2">
        <h2 class="card-title">voorwaarden</h2>
        <p class="card-body">Door te bestellen via onze website gaat u ermee akkoord dat uw gegevens worden opgeslagen
            in onze database ook als u geen account heeft aangemaakt.<br>
            We hebben deze gegevens nodig om uw bestelling correct te kunnen verwerken.</p>
    </div>
    <div class="card bg-light mt-2 mb-2">
        <h2 class="card-title">known bugs</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">fullscreen winkelmandje #id scrolt achter navbar</li>
            <li class="list-group-item">
                <p>security: gebruiker id opgeslagen in cookie die kan je aanpassen om gegevens
                    van andere gebruikers te bekijken.
                    oplossing: enkel via SESSION maar dan is de gebruiker
                    zonder account zijn sessie en bestellingen kwijt na het sluiten van de browser</p>
                <p>security improvement: kan enkel nog de gegevens zien van gebruikers zonder account</p>
            </li>
            <li class="list-group-item">als je u adres later wijzigt staat er niet bij de bestelling naar welk adres het
                ging enkel naar welke gebruiker, oplossing: DB update aparte tabel adressen en linken bij
                gebruiker en bestelling naar adresID.
            </li>
        </ul>
    </div>
</div>