<?php
require 'controller/activityController.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/clientSide.css">
</head>

<body>
    <?php include 'parts/header.php'; ?>
    <div class="container">
        <div class="row justify-content-cente" id="headerRow">
            <div class="col-12 text-center">
                <div class="filterDiv">
                    <button class="btn btn-outline-light customerAccountButton">+</button>
                    <span>Filtres</span>
                </div>
                <div class="searchDiv">
                    <input id="search" type="search" placeholder="recherche" name="search" class="searchInput shadow align-middle">
                    <i id="searchButton" class="fa-solid fa-magnifying-glass searchIcon"></i>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" id="noSearchRow">
            <?php foreach ($servicesByPage as $service) { ?>
                <div class="col-12 col-md-8 col-lg-8 searchCol">
                    <div class="searchResult">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <img src="../espaceClient/partners/<?= $service->partnerEmail ?>/category/categoryPhoto<?= $service->id ?>" alt="Photo du service <?= $service->title ?>">
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 serviceDescriptionCol">
                                <h3><?= $service->partnerName ?></h3>
                                <p><?= $service->title ?></p>
                                <p>A partir de <?= $serviceLowestPrice[$service->id] ?>€</p>
                                <p>Situé à <?= $cityName[$service->id] ?></p>
                                <a class="btn btn-outline-light customerAccountButton" href="servicePage.php?serviceId=<?= $service->id ?>">Découvrir</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- My script -->

<script src="../assets/javascript/servicesSearchBar.js"></script>

</html>