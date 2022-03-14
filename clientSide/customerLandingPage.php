<?php require 'controller/customerController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Landing page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="../assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/clientSide.css">
</head>
<body class="mainSection">
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
                        <!-- Inner form col -->
                        <div class="col-8 text-center customerFormCol">
                            <form action="" method="post">
                                <label class="mt-2 didot" for="fname">Nom</label>
                                <input type="text" id="lastName" name="lastName" value="<?= isset($_POST['lastName']) ? $_POST['lastName'] : '' ?>">
                                <label class="mt-2 didot" for="lname">Prénom</label>
                                <input type="text" id="firstName" name="firstName" value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : '' ?>">
                                <label class="mt-2 didot" for="mail">Adresse e-mail</label>
                                <input type="mail" id="mail" name="mail" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>">
                                <label class="mt-2 didot" for="phone">Numéro de téléphone</label>
                                <input type="text" id="phone" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                        </div>
                        <!-- Button col -->
                        <div class="col-12 text-center">
                            <button id="saveButton" class="btn btn-outline-light priceButton border rounded shadow my-3" name="confirm" type="submit" disabled> C'est parti !</button>
                        </div>
                        </form>
                        <?php if(isset($hotelErrorMessage)){ ?>
                            <p class="errorMessage"><?= $hotelErrorMessage ?></p>
                        <?php } ?>
                        <div class="col-12 text-center my-4">
                        <a class="didot accountCreationLink" href="">Créer un compte</a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="absoluteFooter">
    <?php include '../proSide/footer.php' ?>
    </div>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<!-- My script -->
<script src="../assets/javascript/clientSideFrom.js"></script>


</html>