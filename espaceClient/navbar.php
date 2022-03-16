<?php
// On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
$page = $_SERVER['REQUEST_URI'];
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark sandBackground">
        <a class="navbar-brand" href="#">
            <img src="../assets/marque/Logo_Liugo.png" width="100" height="50" class="d-inline-block align-top" alt="Logo Liugo">
        </a>
        <button class="navbar-toggler mx-2" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon white"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav my-2">
                <li class="nav-item">
                    <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/home.php" ? ' hotelActive' : '' ?>" href="home.php">Mon Établissement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/services.php" ? ' hotelActive' : '' ?>" href="services.php">Mes services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/bookings.php" ? ' hotelActive' : '' ?>" href="bookings.php">Mes réservations</a>
                </li>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link hotelLink<?= $page == "/Liugo/espaceClientHotel/account.php" ? ' hotelActive' : '' ?>" href="account.php">Mon compte</a>
                    </li>
                </ul>

        </div>
    </nav>
</header>