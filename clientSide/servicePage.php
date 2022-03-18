<?php require 'controller/ServiceController.php';
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
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="tangerine blueFont">Ci-dessous vous trouverez tous les sous-services liés à <?= $selectedServiceInfos->serviceTitle ?>.</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="col-12 text-center">
            <img class="servicePageImage" src="../espaceClient/partners/<?= $selectedServiceInfos->partnerEmail ?>/category/categoryPhoto<?= $selectedServiceInfos->serviceId ?>" alt="Image du service <?= $selectedServiceInfos->serviceTitle ?>">
        </div>
    </section>
    <section>
        <div class="row justify-content-around">
            <div class="col-12 text-center">
                <div class="row justify-content-around my-3">
                    <?php foreach ($selectedSubServices as $subService) { ?>
                        <div class="col-10 col-md-3 col-lg-3 subServiceCol shadow">
                            <h2><?= $subService->subServiceTitle ?></h2>
                            <p>Disponible de <?= substr($subService->subServiceStartingHour, 0, 5) ?> à <?= substr($subService->subServiceFinishingHour, 0, 5) ?>.</p>
                            <p>Au prix de <?= $subService->subServicePrice ?>€.</p>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-10 col-lg-10 reservationCol text-center my-3">
                                    <p>Pour réserver, choisissez votre créneau horaire, le nombre de personnes et éffectuez le règlement :</p>
                                    <form action="" method="post">
                                        <div>
                                        <label for="reservationDate">Date</label>
                                        </div>
                                        <input type="date" name="reservationDate" class="reservationDate">
                                        <div>
                                            <input id="subServiceId" type="hidden" name="id" class="subServiceId" value="<?= $subService->subServiceId ?>">
                                        </div>
                                    </form>
                                    <p>Pour des réservations de plus de 9 personnes, veuillez prendre contact avec l'établissement.</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12 text-center partnerMention">
                <p class="partnerName">Ce service vous est proposé par <?= $selectedServiceInfos->partnerName ?></p>
            </div>
        </div>
    </section>
    <section>

    </section>
    <?php include '../proSide/footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="../assets/javascript/customerReservation.js"></script>

</html>