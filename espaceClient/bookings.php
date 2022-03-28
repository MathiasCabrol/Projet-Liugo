<?php require 'controller/bookingsCOntroller.php'; ?>
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
                <p>Vous pourrez retrouver ici le récapitulatof de l'ensemble des réservations éffectuées par vos clients dans les établissements partenaires</p>
                <p>Vous pouvez voir vos commissions évoluer en temps réel et télécharger le document si nécéssaire.</p>
                <hr class="hotelSeparation mt-5">
            </div>
            <div class="col-12 col-md-8 text-center">
                <h2 class="tangerine text-white">Réservations maintenues</h2>
                <table class="mt-5 reservationTable">
                    <tr>
                        <td>Nombre total de réservations</td>
                        <td><?= $confirmedBookingsData->numberOfBookings ?> </td>
                    </tr>
                    <tr>
                        <td>Nombre total de pax</td>
                        <td><?= $confirmedBookingsData->numberOfPeople ?></td>
                    </tr>
                    <tr>
                        <td>Chiffre d’affaire total généré</td>
                        <td><?= $confirmedBookingsData->totalPrice ?>€</td>
                    </tr>
                    <tr>
                        <td>Commission totale générée</td>
                        <td><?= $confirmedBookingsData->totalPrice * 0.05 ?>€</td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-8 text-center">
                <h2 class="tangerine text-white mt-5">Réservations annulées</h2>
                <table class="mt-5 reservationTable">
                    <tr>
                        <td>Nombre total de réservations</td>
                        <td><?= $canceledBookingsData->numberOfBookings ?> </td>
                    </tr>
                    <tr>
                        <td>Nombre total de pax</td>
                        <td><?= $canceledBookingsData->numberOfPeople == 0 ? 0 : $canceledBookingsData->numberOfPeople ?></td>
                    </tr>
                    <tr>
                        <td>Chiffre d’affaire total annulé</td>
                        <td><?= $canceledBookingsData->totalPrice == 0 ? 0 : $canceledBookingsData->totalPrice ?></td>
                    </tr>
                    <tr>
                        <td>Commission totale annulée</td>
                        <td><?= $canceledBookingsData->totalPrice * 0.05 ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-12 text-center">
                <button type="button" class="downloadButton mt-5 btn btn-outline-light">Exporter au format PDF</button>
            </div>
        </div>
    </div>        

    <?php include 'footer.php' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>