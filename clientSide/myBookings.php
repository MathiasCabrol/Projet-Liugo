<?php require 'controller/myBookingsController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations</title>
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
                <h1 class="tangerine blueFont">Voici les réservations que vous avez éffectuées :</h1>
            </div>
        </div>
    </div>
    <?php if(isset($canceledBookingNumber)){ ?>
        <p class="errorMessage">La réservation numéro <?= $canceledBookingNumber ?> a bien été annulée.</p>
    <?php } ?>
    <section>
        <div class="container">
                <div class="row justify-content-center">
                    <h2 class="bookingsTitle didot">Réservations prochainement</h2>
                    <?php if (isset($nextBookings)) { ?>
                    <?php foreach ($nextBookings as $nextBooking) { ?>
                        <div class="col-12 col-md-8 col-lg-8 showBookings mt-5">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <img src="../espaceClient/partners/<?= $bookingDetails[$nextBooking->id]->partnerEmail ?>/category/categoryPhoto<?= $bookingDetails[$nextBooking->id]->serviceId ?>" alt="Photo du service <?= $bookingDetails[$nextBooking->id]->subserviceTitle ?>">
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 bookingDetails text-center align-self-center">
                                    <p class="reservationNumber"><?= $nextBooking->bookingnumber ?></p>
                                    <p class="didot"><?= $bookingDetails[$nextBooking->id]->subserviceTitle ?></p>
                                    <p class="didot">le <?= $nextBooking->date ?> à <?= substr($nextBooking->hour, 0, 5) ?></p>
                                    <p class="didot">Réservation pour <?= $nextBooking->pax ?> personnes</p>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 text-center align-self-center">
                                    <p class="reservationNumber"><?= $bookingDetails[$nextBooking->id]->partnerName ?></p>
                                    <p class="didot">situé au</p>
                                    <p class="didot"><?= $bookingDetails[$nextBooking->id]->address ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 text-center mb-5">
                            <form action="" method="post">
                                <input type="hidden" name="bookingId" value="<?= $nextBooking->id ?>">
                                <input class="btn btn-danger btn-outline-light" type="submit" name="cancel" value="Annuler">
                            </form>
                        </div>
                    <?php } ?>
                    <?php } else { ?>
                        <div class="col-12 text-center">
                            <p class="didot">Vouc n'avez aucune réservation prévue prochainement.</p>
                        </div>
                    <?php } ?>
                </div>
            <?php if (isset($previousBookings)) { ?>
                <div class="row justify-content-center">
                    <h2 class="bookingsTitle didot">Historique des réservations</h2>
                    <?php foreach ($previousBookings as $previousBooking) { ?>
                        <div class="col-12 col-md-8 col-lg-8 showBookings mt-5">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <img src="../espaceClient/partners/<?= $bookingDetails[$previousBooking->id]->partnerEmail ?>/category/categoryPhoto<?= $bookingDetails[$previousBooking->id]->serviceId ?>" alt="Photo du service <?= $bookingDetails[$previousBooking->id]->subserviceTitle ?>">
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 bookingDetails text-center align-self-center">
                                    <p class="reservationNumber"><?= $previousBooking->bookingnumber ?></p>
                                    <p class="didot"><?= $bookingDetails[$previousBooking->id]->subserviceTitle ?></p>
                                    <p class="didot">le <?= $previousBooking->date ?> à <?= substr($previousBooking->hour, 0, 5) ?></p>
                                    <p class="didot">Réservation pour <?= $previousBooking->pax ?> personnes</p>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 text-center align-self-center">
                                    <p class="reservationNumber"><?= $bookingDetails[$previousBooking->id]->partnerName ?></p>
                                    <p class="didot">situé au</p>
                                    <p class="didot"><?= $bookingDetails[$previousBooking->id]->address ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>