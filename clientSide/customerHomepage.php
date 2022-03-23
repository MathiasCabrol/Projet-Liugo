<?php require 'controller/customerMainController.php';
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/clientSide.css">
</head>

<body>
    <?php include 'parts/header.php'; ?>
    <div class="col-12 text-center my-5 text-black">
        <h1 class="tangerine"><?= $selectedHotel->name ?></h1>
        <img class="mt-5 homePhoto" src="<?= '../espaceClient/hotels/' . $selectedHotel->email . '/home/homePhoto' ?>">
        <p class="mt-5"><?= $selectedDescription->description ?></p>
        <div class="row justify-content-start">
            <div class="col-12 col-md-8 col-lg-8">
                <p class="mt-5">Découvrez les activités proposées par nos partenaires</p>
                <img class="customerPhoto" src="<?= '../espaceClient/hotels/' . $selectedHotel->email . '/home/activityPhoto' ?>">
                <button class="btn btn-outline-light blueBackground categoryButton">Explorer</button>
            </div>
        </div>
        <div class="row justify-content-end mt-3">
            <div class="col-12 col-md-8 col-lg-8">
                <p class="mt-5">Découvrez les services proposés par votre hébergeur</p>
                <img class="customerPhoto" src="<?= '../espaceClient/hotels/' . $selectedHotel->email . '/home/servicePhoto' ?>">
                <a href="hotelServices.php" class="btn btn-outline-light blueBackground categoryButton">Découvrir</a>
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="col-12 col-md-8 col-lg-8 infosCol">
                <h2 class="tangerine">Des questions ?</h2>
                <p class="didot">N'hésitez pas à contacter directement votre établissement par téléphone au numéro suivant :</p>
                <p class="didot"><?= $hotelPhone ?></p>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>