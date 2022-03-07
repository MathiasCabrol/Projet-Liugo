<?php
require 'controller/serviceModifyController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <title>Accueil</title>
</head>

<body class="hotelBody">
    <!-- Including hotel side navbar -->
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="hotelTitle mt-5 ">Modification de service</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 hotelIntro">
                <p>Ci-dessous vous trouverez le formulaire vous permettant de modifier le service <span class="bold"><?= $serviceInfos->serviceTitle ?></span>.</p>
            </div>
        </div>
        <div class="col-12 text-center my-5">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="serviceTitle" value="<?= $serviceInfos->serviceTitle ?>" class="mt-5">
                <p class="my-5 hotelIntro">Vous pouvez insérer ci-dessous une nouvelle photo qui remplacera l'existante ou laisser le champ vide.</p>
                <div class="drop-zone mt-5">
                    <span class="drop-zone__prompt text-bl  ">Photo du service</span>
                    <input type="file" name="categoryPhoto" class="drop-zone__input">
                </div>
                <input type="submit" name="saveChanges" class="saveButton btn btn-outline-light mt-5" value="Sauvegarder">
            </form>
            <?php if(isset($successMessage)){ ?>
                <p class="my-5 text-success"><?= $successMessage ?></p>
            <?php } ?>
            <?php if(isset($errorMessage)){ ?>
                <p class="my-5 text-success"><?= $errorMessage ?></p>
            <?php } ?>
            <hr class="hotelSeparation my-5">
            <h2 class="hotelTitle my-5">Sous-Services</h2>
            <p class="my-5 hotelIntro">Ici vous pouvez supprimer ou modifier un sous-service associé à <span class="bold"><?= $serviceInfos->serviceTitle ?></span>.</p>
        </div>
        <div class="row justify-content-around mt-5">
            <?php foreach ($subServiceInfos as $subService) { ?>
                <div class="col-2 text-center showService">
                    <div class="col-12 text-center my-5 text-black">
                        <form action="" method="get">
                            <input type="hidden" name="subServiceId" value="<?= $subService->subServiceId ?>">
                            <button type="submit" class="btn btn-danger servicesButtons crossButton" name="action" value="delete">X</button>
                            <button type="submit" class="btn btn-info servicesButtons text-white modifyButton" name="action" value="modify"><i class="fa-solid fa-pen-to-square"></i></button>
                        </form>
                        <h2 class="tangerine hotelSub"><?= $subService->subServiceTitle ?></h2>
                        <p>Ouvert de <?= substr($subService->startingHour, 0, 5) ?> à <?= substr($subService->finishingHour, 0, 5) ?></p>
                        <p>Au prix de <?= $subService->price ?>€</p>
                        <?php if ($subService->addButton) { ?>
                            <button class="btn btn-primary"><?= $buttonValue[$subService->subServiceId] ?></button>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if(isset($infoMessage)){ ?>
            <p class="text-center text-success my-5"><?= $infoMessage ?></p>
        <?php } ?>
        <p class="text-center"></p>
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