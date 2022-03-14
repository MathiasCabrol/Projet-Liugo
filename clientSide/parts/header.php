<?php
// On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
// $page = $_SERVER['REQUEST_URI'];
// $page = str_replace("/Liugo\/proSide/", "", $page);
?>
<header>
  <!-- Navbar creation -->
  <nav class="navbar navbar-expand-lg navbar-dark blueBackground">
    <button class="navbar-toggler mx-2" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon white"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav my-2">
        <li class="nav-item">
          <a class="nav-link" href="homepage.php">Accueil</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="functions.php">Fonctionnalités</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="prices.php">Tarifs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="proAccountCreation.php">Mon compte</a>
        </li> -->
      </ul>
    </div>
  </nav>
  <!-- Openning logo container -->
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