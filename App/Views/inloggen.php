<?php
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

<div class="container mt-4">
    <h1>Inloggen</h1>
    <p>u ben in de inlog pagina</p>
    <form action="" method="post">
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="name@email.com"
                   value="<?= $email ?>">
        </div>
        <div class="form-group">
            <label for="password">wachtwoord</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <button class="btn btn-primary mt-2" type="submit" name='submit' value="true">inloggen</button>
    </form>
</div>
</body>
</html>