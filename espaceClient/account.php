<?php require 'controller/accountController.php' ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../assets/css/style.css" rel="stylesheet">
    <title>Mon compte</title>
</head>

<body class="hotelBody">
    <!-- Including hotel side navbar -->
    <?php include 'navbar.php'; ?>
    <!-- Title and intro -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="hotelTitle mt-5 ">Modification de compte</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 hotelIntro">
                <p>Ci-dessous vous trouverez le menu vous permettant de modifier ou supprimer</p>
                <p>les informations associées à votre compte </p>
            </div>
        </div>
    </div>
    <div class="flexColumn">
        <div class="accountContainer">
            <button onclick="window.location='account.php?action=account'"><span class="accountIcon"><i class="fa-solid fa-user"></i></span>Mon compte</button>
            <button onclick="window.location='account.php?action=stats'"><span class="accountIcon"><i class="fa-solid fa-circle-info"></i></span>Statistiques</button>
            <button id="logoutButton" class="btn btn-danger btn-outline-light" onclick="window.location='account.php?action=logout'"><span class="accountIcon"><i class="fa-solid fa-right-from-bracket"></i></span>Déconnexion</button>
        </div>
        <?php if ((isset($_GET['action']) && $_GET['action'] == 'account') || !isset($_GET['action'])) { ?>
            <div class="accountDetails">
                <div class="accountInfos">
                    <h2>Informations personelles</h2>
                    <div class="accountSeparation">
                        <div class="specificInfo">
                            <button class="accountModifyButton btn btn-info" data-input="name"><i class="fa-solid fa-pen-to-square"></i>edit</button>
                            <p class="infoName"><i class="fa-solid fa-signature"></i> Nom de l'établissement</p>
                            <p class="inline" data-name="name"><?= $selectedAccountInfos->name ?></p>
                        </div>
                        <div class="specificInfo">
                            <button class="accountModifyButton btn btn-info"><i class="fa-solid fa-pen-to-square"></i>edit</button>
                            <p class="infoName"><i class="fa-solid fa-envelope"></i> Adresse e-mail</p>
                            <p class="inline" data-name="email"><?= $selectedAccountInfos->email ?></p>
                        </div>
                        <div class="specificInfo">
                            <button class="accountModifyButton btn btn-info"><i class="fa-solid fa-pen-to-square"></i>edit</button>
                            <p class="infoName"><i class="fa-solid fa-phone"></i> Numéro de téléphone</p>
                            <p class="inline" data-name="phone"><?= $selectedAccountInfos->phone ?></p>
                        </div>
                    </div>
                    <div class="accountSeparation">
                        <div class="specificInfo">
                            <button class="accountModifyButton btn btn-info"><i class="fa-solid fa-pen-to-square"></i>edit</button>
                            <p class="infoName"><i class="fa-solid fa-location-dot"></i> Adresse</p>
                            <p class="inline" data-name="address"><?= $selectedAccountInfos->address ?></p>
                        </div>
                        <div class="specificInfo">
                            <button class="accountModifyButton btn btn-info"><i class="fa-solid fa-pen-to-square"></i>edit</button>
                            <p class="infoName"><i class="fa-solid fa-map"></i> Code Postal</p>
                            <p class="inline" data-name="postcode"><?= $selectedAccountInfos->postcode ?></p>
                        </div>
                        <div class="specificInfo">
                            <p class="infoName"><i class="fa-solid fa-building"></i> Ville</p>
                            <p class="inline" data-name="city"><?= $selectedCity->ville_slug ?></p>
                        </div>
                    </div>
                    <div class="accountButtonContainer">
                        <button class="btn btn-danger btn-outline-light" data-bs-toggle="modal" data-bs-target="#deleteModal">Suppression du compte</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header deleteModalHeader">
                                    <h5 class="modal-title" id="deleteModalLabel">Suppression de compte</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="my-2">Êtes-vous sûr de vouloir supprimer votre compte ?</h5>
                                    <p class="my-5">Toutes les informations enregistrés ainsi que les services créés seront supprimés définitivement, souhaitez-vous continuer ?</p>
                                    <form action="" method="POST">
                                        <input type="submit" name="deleteConfirm" value="confirmer" class="btn btn-danger">
                                        <input type="submit" name="deleteCancel" value="annuler" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($_GET['action'] == 'stats') {
        ?>
            <div class="accountDetails">
                <div class="accountInfos">
                    <h2>Statistiques</h2>
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
                </div>
            </div>
        <?php } ?>
    </div>


    <?php include 'footer.php' ?>


    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<!-- My script -->
<script src="../assets/javascript/accountModification.js"></script>

</html>