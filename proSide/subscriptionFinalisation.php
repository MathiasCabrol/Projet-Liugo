<?php
require 'controller/finalSubscriptionVerif.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account finalisation</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>
    <!-- Titre page -->
    <?php if(isset($_GET['token']) && ($_GET['type'] == 'presta' || $_GET['type'] == 'hotel')){
        ?>
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
    <section>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="tangerine">Voici les informations complémentaires à renseigner</h2>
                </div>
                <div class="col-7 col-md-4 col-lg-3 mt-5">
                    <form method="post" enctype="multipart/form-data" action="">
                        <?php if ($_SESSION['type'] == 'presta') {
                        ?>
                            <label for="sectors">Secteur d'activité</label>
                            <select class="w-100" name="sectors" id="sectors">
                                <?php foreach($sectorList as $sector){
                                    ?>
                                <option value="<?= $sector->sector ?>"><?= $sector->sector ?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                        <label for="phoneInput" class="mt-3">Téléphone</label>
                        <input class="w-100" type="text" id="phoneInput" name="phoneInput"></input>
                        <label for="address" class="mt-3">Adresse</label>
                        <input class="w-100" type="text" id="addressInput" name="addressInput"></input>
                        <label for="postCode" class="mt-3">Code postal</label>
                        <input id="postCodeInput" class="w-100" type="text" id="postCodeInput" name="postCodeInput"></input>
                        <div class="col-12 text-center">
                            <input type="submit" value="confirmer" name="confirm" class="btn btn-outline-light priceButton border rounded shadow mt-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php }else {
        include 'errorMessage.php';
    }
        ?>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- My Javascript -->
<script src="../assets/javascript/form2Verif.js"></script>
<script src="../assets/javascript/showCity.js"></script>

</html>