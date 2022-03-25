<?php require 'controller/customerController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QPage d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/clientSide.css">
</head>

<body class="mainSection">
    <header>
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
    <section>
        <!-- Form container -->
        <div class="container">
            <!-- Form row -->
            <div class="row justify-content-center">
                <!-- Form Col -->
                <div class="col-10 col-md-4 col-lg-4 pricingCol rounded mt-4">
                    <!-- Form title -->
                    <h1 class="tangerine mt-3 text-center">Prêts pour l'aventure ?</h1>
                    <!-- Inner form row -->
                    <div class="row justify-content-center">
                        <!-- Button col -->
                        <div class="col-12 text-center">
                            <form action="" method="post">
                            <button id="saveButton" class="btn btn-outline-light priceButton border rounded shadow my-3" name="guest" type="submit"> Continuer en tant qu'invité</button>
                            </form>
                        </div>
                        </form>
                        <?php if (isset($hotelErrorMessage)) { ?>
                            <p class="errorMessage"><?= $hotelErrorMessage ?></p>
                        <?php } ?>
                        <div class="col-12 text-center my-1">
                            <button class="didot btn btn-outline-light customerAccountButton" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                        </div>
                        <div class="col-12 text-center my-1">
                            <a class="didot accountCreationLink" href="customerAccountCreation.php">Créer un compte</a>
                        </div>
                    </div>
                </div>

            </div>
    </section>
    <!-- Modal pour la connexion -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="didot blueFont" id="loginModalLabel">Vous êtes de retour ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-10 text-center customerFormCol">
                                <p class="didot blueFont">Renseignez vos identifiants pour vous connecter</p>
                                <form action="" method="post">
                                    <div>
                                        <label for="email">Adresse email</label>
                                    </div>
                                    <input type="text" name="email">
                                    <div>
                                        <label for="password">Mot de passe</label>
                                    </div>
                                    <input type="password" name="password">
                                    <button class="btn btn-outline-light customerAccountButton" name="login" type="submit">Se connecter</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="absoluteFooter">
        <?php include 'footer.php' ?>
    </div>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</html>