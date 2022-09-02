<?php
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <?php require_once('head.html'); ?>
    <script defer src="App/Javascript/verbergen.js"></script>
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

<div class="container mt-4 mb-4">
    <h1>gegevens nodig</h1>
    <form action="" method="post">

        <div class="row">
            <div class="col-sm form-group">
                <label for="voornaam" class="form-label">voornaam</label>
                <input type="text" class="form-control" name="voornaam" id="voornaam" maxlength="45"
                       value="<?= $voornaam ?>" required>
            </div>
            <div class="col-sm form-group">
                <label for="achternaam" class="form-label">achternaam</label>
                <input type="text" class="form-control" name="achternaam" id="achternaam" maxlength="45"
                       value="<?= $achternaam ?>"
                       required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm form-group">
                <label for="straat" class="form-label">straat</label>
                <input type="text" class="form-control" name="straat" id="straat" maxlength="45" value="<?= $straat ?>"
                       required>
            </div>
            <div class="col-sm form-group">
                <label for="huisnummer" class="form-label">huisnummer</label>
                <input type="text" class="form-control" name="huisnummer" id="huisnummer" maxlength="10"
                       value="<?= $huisnummer ?>"
                       required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm form-group">
                <label for="postcode" class="form-label">postcode</label>
                <input type="text" class="form-control" name="postcode" id="postcode" maxlength="10"
                       value="<?= $postcode ?>" required>
            </div>
            <div class="col-sm form-group">
                <label for="postcode" class="form-label">gemeente</label>
                <input type="text" class="form-control" name="gemeente" id="gemeente" maxlength="45"
                       value="<?= $gemeente ?>" required>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-sm form-group">
                <input type="checkbox" class="form-check-input" name="account" id="account"
                       value="1" <?php if ($account) echo 'checked="checked" ' ?>>
                <label for="account" class="form-label">ja ik wil een account maken
                </label>
            </div>
            <div class="col-sm form-group">
                <label for="telefoon" class="form-label">telefoon</label>
                <input type="tel" class="form-control" name="telefoon" id="telefoon" maxlength="45"
                       value="<?= $telefoon ?>" required>
            </div>
        </div>

        <div id="verbergen">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" maxlength="45"
                       placeholder="name@email.com"
                       value="<?= $email ?>">
            </div>
            <div class="row">
                <div class="form-group col-sm">
                    <label for="password" class="form-label">wachtwoord</label>
                    <input type="password" class="form-control" name="password" id="password" maxlength="45"
                           placeholder="a-z/A-Z/0-9">
                </div>
                <div class="form-group col-sm">
                    <label for="password2" class="form-label">herhaal wachtwoord</label>
                    <input type="password" class="form-control" name="password2" id="password2" maxlength="45">
                </div>
            </div>
        </div>
        <button class="btn btn-success mt-2" type="submit" name="submit" value="submit">doorgaan</button>
        <a class="btn btn-danger mt-2" href="index.php">annuleer</a>
    </form>
</div>
</body>
</html>