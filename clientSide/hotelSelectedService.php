<?php require 'controller/selectedServiceController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service sélectionné</title>
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

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="shadow-lg col-12 col-md-10 col-lg-10 mainService text-center">
                <h2 class="tangerine serviceTitle"><?= $selectedService->title ?></h2>
                <img class="serviceImage" src="<?= '../espaceClient/hotels/' . $selectedHotelEmail->email . '/category/categoryPhoto' . $selectedService->id ?>" alt="image du service <?= $selectedService->title ?>">
                <div class="row justify-content-around">
                    <?php foreach ($selectedServiceSS as $subService) { ?>
                        <div class="col-10 col-md-5 col-lg-5 text-center my-5 showSS shadow">
                            <h3><?= $subService->ssTitle ?></h3>
                            <div class="col-12 bg-white text-black shadow mt-4">
                                <div class="col-12 text-center seprationSS">
                                    <p>De <?= substr($subService->ssStartingHour, 0, 5) ?> à <?= substr($subService->ssFinishingHour, 0, 5) ?> heures.</p>
                                </div>
                                <div class="col-12 text-center seprationSS">
                                    <p>A partir de <?= $subService->ssPrice ?>€</p>
                                </div>
                            </div>
                            <?php if($subService->ssAddButton == 1){ ?>
                                <a href="../espaceClient/hotels/<?= $selectedHotelEmail->email ?>/buttonFiles/buttonFile<?= $ssButtonArray[$subService->ssId]['buttonId'] ?>" class="btn-light btn btn-outline-dark my-4"><?= $ssButtonArray[$subService->ssId]['buttonValue'] ?></a>
                                <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>