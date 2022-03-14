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
        <h2 class="tangerine hotelSub"><?= $hotelName->name ?></h2>
        <img class="primaryModalImage mt-5" src="<?= isset($filePath['homePhoto']) ? $filePath['homePhoto'] : '../assets/img/hotel-webFormat.jpg' ?>">
        <p class="mt-5"><?= isset($SelectedDescription) ? $SelectedDescription->description : 'Dans ce lieu de relaxation pensé et étudié pour une clientèle exigeante. Nous faisons honneur à un cadre somptueux tout en conservant un sens aïgue du service et de l\'hospitalité.' ?></p>
        <div class="row justify-content-start">
            <div class="col-10">
                <p class="mt-5 modalSmallp">Découvrez les activités proposées par nos partenaires</p>
                <img class="secondaryModalImage" src="<?= isset($filePath['activityPhoto']) ? $filePath['activityPhoto'] : '../assets/img/hiker-g2509bd607_640.jpg' ?>">
                <button class="exploreButton btn btn-outline-light blueBackground categoryButton">Explorer</button>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-10">
                <p class="mt-5 modalSmallp">Découvrez les services proposés par votre hébergeur</p>
                <img class="secondaryModalImage" src="<?= isset($filePath['servicePhoto']) ? $filePath['servicePhoto'] : '../assets/img/chef-g4f86bc479_640.jpg' ?>">
                <button class="discoverButton btn btn-outline-light blueBackground categoryButton">Découvrir</button>
            </div>
        </div>
    </div>
    <?php include '../proSide/footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</html>