<?php
require 'controller/connexionPage.php';
var_dump($_SESSION);
var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'header.php'
    ?>
    <!-- Titre page -->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-md-6 col-lg-6 text-center">
                    <h1 class="pageTitle tangerine">Un horizon de possibilités</h1>
                    <p class="didot diagonalP">À portée de clic !</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Formulaire de connexion -->
    <section>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-10 text-center">
                    <h2 class="tangerine">De retour ? Connectez-vous.</h2>
                </div>
                <div class="col-7 col-md-3 col-lg-3">
                    <form method="post" action="">
                        <div class="inputIcons">
                            <label class="mt-3">Adresse E-mail</label><br>
                            <input type="text" id="mailInput" name="mailInput"></input>
                            <label class="mt-3">Mot de passe</label>
                            <div class="passwordIcon">
                                <input type="password" id="passwordInput" name="passwordInput"></input>
                                <i id="showPassword" class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                        <?php if(isset($errorMessage)){
                            ?>
                        <p class="errorMessage"><?= $errorMessage ?></p>
                        <?php } ?>
                        <div class="col-12 text-center">
                            <button type="submit" name="confirm" class="btn btn-outline-light priceButton border rounded shadow mt-3">Confirmer</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 text-center mt-4">
                    <img class="rounded connexionImage" src="../assets/img/welcome-sign-g19613aaa4_640.jpg" alt="Signe de bienvenue avec décor de jungle">
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- My Javascript -->
<script src="assets/javascript/script.js"></script>
<script src="../assets/javascript/showPassword.js"></script>

</html>