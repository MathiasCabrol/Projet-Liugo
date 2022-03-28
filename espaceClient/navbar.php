<?php
// On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
$page = $_SERVER['REQUEST_URI'];
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark sandBackground">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav my-2">
                    <li class="nav-item">
                        <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/home.php" ? ' hotelActive' : '' ?>" href="home.php">Mon Établissement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/services.php" ? ' hotelActive' : '' ?>" href="services.php">Mes services</a>
                    </li>
                    <?php if($_SESSION['type'] == 'partners'){ ?>
                    <li class="nav-item">
                        <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/bookings.php" ? ' hotelActive' : '' ?>" href="bookings.php">Mes réservations</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/account.php" ? ' hotelActive' : '' ?>" href="account.php">Mon compte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>