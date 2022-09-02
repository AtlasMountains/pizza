<nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand"
           href="index.php">Menu</a>

        <?php if (isset($_COOKIE['mandje']) && $_COOKIE['mandje'] !== 'null' && $_SERVER['REQUEST_URI'] === '/projects/eindproef-php-adv-mathies-t/index.php'): ?>
            <a class="navbar-brand" href="#mandje"><i class="bi bi-cart4"></i></a>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['admin'])): ?>
                    <?php if (isset($_SESSION['gebruiker']) || (isset($_COOKIE['mandje']) && $_COOKIE['mandje'] !== 'null')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="keuze.php">afrekenen</a>
                        </li>
                    <?php endif; ?>
                    <?php if (((isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true) ||
                        (isset($_SESSION['gegevens']) && $_SESSION['gegevens'] === true))): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="bestelOverzicht.php">bestellingen</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="nav-item"><a href="about.php" class="nav-link">Wie Zijn Wij</a></li>
                <?php if (!isset($_SESSION['ingelogd']) || $_SESSION['ingelogd'] !== true) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="inloggen.php">inloggen</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true) : ?>
                    <?php if (isset($_SESSION['admin'])): ?>
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link">admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="uitloggen.php">uitloggen</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>