<?php
// On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
// $page = $_SERVER['REQUEST_URI'];
// $page = str_replace("/Liugo\/proSide/", "", $page);
?>
<header>
<nav class="navbar navbar-expand-lg navbar-dark blueBackground">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav my-2">
        <?php if(isset($_SESSION['hotelId'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="customerHomepage.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="hotelServices.php">Hôtel</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="activities.php">Activités</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="myBookings.php">Mes réservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Mon compte</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-10 col-md-4 col-lg-4 text-center mt-3">
        <img class="logo" src="../assets/marque/Logo_Liugo.png" alt="Logo Liugo">
      </div>
      <!--Closing row logo-->
    </div>
    <!--Closing container-->
  </div>
</header>