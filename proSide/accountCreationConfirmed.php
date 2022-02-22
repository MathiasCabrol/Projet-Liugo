<?php
session_start();
var_dump($_SESSION);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'header.php'
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-8 col-lg-8  text-center">
                <h1 class="pageTitle tangerine mt-5">Dernière étape avant de rejoindre l'aventure !</h1>
                <p class="didot">Nous avons bien enregistrée votre demande.</p>
                <hr class="mt-5" style="width:100%; color:#4E629C; height:5px;">
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <img class="laptopImage rounded" src="../assets/img/desk-gf4ea73706_640.jpg">
    </div>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-10 col-md-6 col-lg-6 text-center pricingCol rounded">
                <h2 class="tangerine mt-5">Vous faites partie de la communauté Liugo !</h2>
                <p class="didot mt-5">Vous recevrez prochainement un e-mail de confirmation. Afin de pouvoir accéder à votre espace et commencer à personnaliser votre page d'accueil et les services proposés, nous avons besoin de plus d'informations.</p>
                <p class="didot">Dans l'attente de la complétion de vos informations, vous pouvez dès maintenant découvrir les différentes fonctionnalités proposées</p>
                <a href="functions.php"><button href="functions.php" type="button" class="btn btn-outline-light priceButton border rounded shadow mb-4">Découvrir</button></a>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>