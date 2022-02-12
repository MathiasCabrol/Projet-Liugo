<?php
require 'controller/proAccountCreationVerif.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account creation</title>
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
    <?php include 'header.php' ?>
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
    <!-- Formulaire d'inscription -->
    <?php if(!isset($_GET['type'])) {
        ?>
    <div class="container mt-5">
        <h2 class="pageTitle tangerine text-center">Vous êtes :</h2>
        <div class="row justify-content-center mt-5">
                <div class="col-5 text-center">
                    <img class="modalImage rounded" src="../assets/img/hotelDoor.jpg" alt="Hotel room door">
                    <a type="submit" href="proAccountCreation.php?type=hotel" class="btn blueBackground categoryButton btn-outline-light">Hôtel</a>
                    <!-- Closing Hotel choice col -->
                </div>
                <!-- oppening "or" col -->
                <div class="col-1 text-center align-self-center">
                    <p class="orModal">Ou</p>
                    <!-- Closing "or" col -->
                </div>
                <!-- Opening services choice -->
                <div class="col-5 text-center">
                    <img class="modalImage rounded" src="../assets/img/servicesChoice.jpg" alt="Dancing woman on sunset">
                    <a type="button" href="proAccountCreation.php?type=presta" class="btn blueBackground categoryButton btn-outline-light">Prestataire</a>
                    <!-- Closing services choice -->
                </div>
        </div>
    </div>
    <?php } else if($_GET['type'] == "hotel" || $_GET['type'] == "presta") {
        ?>
    <section>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-7 col-md-3 col-lg-3">
                    <form method="post" action="<?= isset($_POST['confirmer']) && count($errorList) == 0 ? 'accountCreationConfirmed.php' : '' ?>">
                        <div class="inputIcons">
                            <label>Nom de l'établissement</label><br>
                            <input type="text" id="nameInput" name="name">
                            <label class="mt-3">Adresse E-mail</label>
                            <input type="text" id="mailInput" name="mail">
                            <label class="mt-3">Mot de passe</label>
                            <div class="passwordIcon">
                                <input type="password" id="passwordInput" name="password">
                                <i id="showPassword" class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                        <div id="StrengthDisp" class="mt-2 w-100 text-center badge displayBadge"></div>
                        <p class="didot mt-3">Vous avez déja un compte ? <a href="connexionPage.php">Connectez vous</a></p>
                        <div class="col-12 text-center">
                            <input type="submit" name="inscription" value="confirmer" class="btn btn-outline-light priceButton border rounded shadow mt-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php } else {
        include 'errorMessage.php';
        ?>
    <?php } ?>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- My Javascript -->
<script src="../assets/javascript/form1Verif.js"></script>
<script src="../assets/javascript/showPassword.js"></script>

</html>