<?php require 'controller/accountController.php'; ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/clientSide.css">
</head>

<body>
    <?php include 'parts/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="tangerine blueFont">Ici vous pouvez consulter et modifier les informations de votre compte</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-10 text-center">
                <h2 class="didot my-5">Informations du compte</h2>
                <div class="row customerDetailsRow">
                    <div class="col-12 col-md-6 col-lg-6 text-center">
                        <div class="shadow specificInfo">
                            <p>Nom</p>
                            <p class="didot"><?= $customerDetails->lastname ?></p>
                        </div>
                        <div class="shadow specificInfo">
                            <p>Prénom</p>
                            <p class="didot"><?= $customerDetails->firstname ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 text-center">
                        <div class="shadow specificInfo">
                            <p class="infoName">Adresse e-mail</p>
                            <p class="didot inline" data-name="email"><?= $customerDetails->email ?></p>
                            <button class="btn btn-light btn-outline-dark accountModifyButton"><i class="fa-solid fa-pen-to-square"></i></button>
                        </div>
                        <div class="shadow specificInfo">
                            <p class="infoName">Numéro de téléphone</p>
                            <p class="didot inline" data-name="phone"><?= $customerDetails->phone ?></p>
                            <button class="btn btn-light btn-outline-dark accountModifyButton"><i class="fa-solid fa-pen-to-square"></i></button>

                        </div>
                    </div>
                </div>
                <button type="button" name="delete" class="my-2 btn btn-danger btn-outline-light" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer le compte</button>
                <form action="" method="get">
                    <button type="submit" name="action" value="logout" class="my-2 btn btn-info btn-outline-light"><i class="fa-solid fa-arrow-right-from-bracket"></i>Déconnexion</button>
                </form>
            </div>
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
                        <p class="my-5">Toutes les informations enregistrées seront supprimées définitivement, souhaitez-vous continuer ?</p>
                        <form action="" method="POST">
                            <input type="submit" name="deleteConfirm" value="confirmer" class="btn btn-danger">
                            <input type="submit" name="deleteCancel" value="annuler" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../assets/javascript/customerModification.js"></script>

</html>