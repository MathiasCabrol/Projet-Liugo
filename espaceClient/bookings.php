<?php require 'controller/bookingsController.php'; ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <title>Réservations</title>
</head>

<body class="hotelBody">
    <?php include 'navbar.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="hotelTitle mt-5 ">Mes Réservations</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 mb-5 hotelIntro">
                <p>Vous pourrez retrouver ici le récapitulatif de l'ensemble des réservations éffectuées par vos clients dans les établissements partenaires</p>
                <p>Vous pouvez voir vos commissions évoluer en temps réel et télécharger le document si nécéssaire.</p>
                <hr class="hotelSeparation mt-5">
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-6">
                        <p class="mt-5">Rechercher par date</p>
                        <form action="" method="post">
                            <input class="w-100" type="date" name="dateSearch" id="reservationSearch">
                            <?php if (isset($dateErrorMessage)) { ?>
                                <p class="errorMessage"><?= $dateErrorMessage ?></p>
                            <?php } ?>
                            <button type="submit" class="btn btn-outline-light priceButton border rounded mt-2">Rechercher</button>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-6">
                        <p class="mt-5">Rechercher par nom</p>
                        <form action="" method="post">
                            <input class="w-100" type="search" name="nameSearch" id="reservationSearch">
                            <?php if (isset($nameErrorMessage)) { ?>
                                <p class="errorMessage"><?= $nameErrorMessage ?></p>
                            <?php } ?>
                            <button type="submit" class="btn btn-outline-light priceButton border rounded mt-2">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <?php foreach ($bookingsDisplayed as $booking) { ?>
                    <div class="col-12 col-md-6 col-lg-6 my-5">
                        <div class="row justify-content-center">
                            <div class="col-10 bookingInformationCol text-center">
                                <div class="coloredHeader text-white didot"><?= $booking->bookingnumber ?></div>
                                <p><?= $booking->customerLastname ?> <?= $booking->customerFirstname ?></p>
                                <p><?= $booking->subserviceTitle ?></p>
                                <p>Le <?= $booking->date ?> à <?= $booking->hour ?></p>
                                <p>Contacts : </p>
                                <p><?= $booking->customerEmail ?></p>
                                <p><?= $booking->customerPhone ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>

    <?php include 'footer.php' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>