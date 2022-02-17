<?php
require 'controller/homeController.php';
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <title>Accueil</title>
</head>

<body class="hotelBody">
    <!-- Including hotel side navbar -->
    <?php include 'navbar.php'; ?>
    <!-- Title and intro -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="hotelTitle mt-5 ">Mon Établissement</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 mb-5 hotelIntro">
                <p>C’est ici que vous pourrez configurer
                    votre page d'accueil.</p>
                <p>À vous de jouer ! Mettez en avant votre établissement à votre façon via des textes entièrement personalisables. Vous pouvez également modifier toutes les images affichées lors de la connexion de vos cients.</p>
                <p>Attention, cette page est visible publiquement sur votre page d'accueil lors du scan de votre QR code.</p>
                <button type="button" class="exampleButton btn-outline-light" data-toggle="modal" data-target="#customerViewModal">Exemple vue utilisateur</button>
                <!-- Example modal -->
                <div class="modal fade" id="customerViewModal" tabindex="-1" role="dialog" aria-labelledby="customerViewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header sandBackground">
                                <button type="button" class="close modalCross btn-secondary btn-outline-light rounded" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                <div class="modal-footer sandBackground">
                                    <button type="button" class="btn btn-secondary btn-outline-light closeModal" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="hotelSeparation mt-5">
            </div>
            <!-- Example Hôtel title -->
            <div class="col-12 text-center mb-5">
                <h2 class="tangerine hotelSub"><?= $hotelName->name ?></h2>
                <!-- Form with personalised content -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="drop-zone mt-5">
                        <span class="drop-zone__prompt">Ma photo d'accueil</span>
                        <input type="file" name="homePhoto" class="drop-zone__input">
                    </div>
                    <p class="errorMessage"><?= isset($errorList['homePhoto']) ? $errorList['homePhoto'] : '' ?></p>
                    <textarea class="formText mt-5" id="description" name="description" rows="5" cols="30" placeholder="Descriptif de l'établissement. ex : Notre établissement hôtelier le Cap-Ferret est idéalement situé sur les côtes pour une vue imprenable."></textarea>
                    <div class="drop-zone mt-5">
                        <span class="drop-zone__prompt">Photo de la section activités</span>
                        <input type="file" name="activityPhoto" class="drop-zone__input">
                    </div>
                    <p class="errorMessage"><?= isset($errorList['activityPhoto']) ? $errorList['activityPhoto'] : '' ?></p>
                    <div class="drop-zone mt-5">
                        <span class="drop-zone__prompt">Photo de la section services</span>
                        <input type="file" name="servicePhoto" class="drop-zone__input">
                    </div>
                    <p class="errorMessage"><?= isset($errorList['servicePhoto']) ? $errorList['servicePhoto'] : '' ?></p>
                    <input class="mt-5 confirmationButton btn-outline-light" type="submit" name="confirm" value="Confirmer">
                </form>
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
<!-- My script -->
<script src="../assets/javascript/dragZone.js"></script>

</html>