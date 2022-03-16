<?php
require 'controller/subServiceModifyController.php';
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
                <h1 class="hotelTitle mt-5">Modification de sous-service</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 hotelIntro">
                <p>Ci-dessous vous trouverez le formulaire vous permettant de modifier le sous-service <span class="bold"><?= $selectedSubService->subServiceTitle ?></span>.</p>
            </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-5 text-center my-5 modifyCol">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="ssTitle">Titre du sous-service</label>
                <div><input type="text" name="ssTitle" value="<?= $selectedSubService->subServiceTitle ?>"></div>
                <?php if(isset($errorList['ssTitle'])){ ?>
                <p class="errorMessage"><?= $errorList['ssTitle'] ?></p>
                <?php } ?>
                <label for="ssStartingHour">Heure de début</label>
                <div><input type="time" name="ssStartingHour" value="<?= substr($selectedSubService->startingHour, 0, 5) ?>"></div>
                <?php if(isset($errorList['ssStartingHour'])){ ?>
                <p class="errorMessage"><?= $errorList['ssStartingHour'] ?></p>
                <?php } ?>
                <label for="ssFinishingHour">Heure de fin</label>
                <div><input type="time" name="ssFinishingHour" value="<?= substr($selectedSubService->finishingHour, 0, 5) ?>"></div>
                <?php if(isset($errorList['ssFinishingHour'])){ ?>
                <p class="errorMessage"><?= $errorList['ssFinishingHour'] ?></p>
                <?php } ?>
                <label for="ssPrice">Prix du sous-service</label>
                <div><input type="number" name="ssPrice" value="<?= $selectedSubService->price ?>"></div>
                <?php if(isset($errorList['ssPrice'])){ ?>
                <p class="errorMessage"><?= $errorList['ssPrice'] ?></p>
                <?php } ?>
                <?php if($selectedSubService->addButton){ ?>
                    <label for="ssButtonValue">Nom du bouton</label>
                    <div><input type="text" name="ssButtonValue" value="<?= $buttonValue ?>"></div>
                    <?php if(isset($errorList['ssButtonValue'])){ ?>
                    <p class="errorMessage"><?= $errorList['ssButtonValue'] ?></p>
                    <?php } ?>
                    <div><input type="file" name="buttonFile"></div>
                    <?php if(isset($errorList['buttonFile'])){ ?>
                    <p class="errorMessage"><?= $errorList['buttonFile'] ?></p>
                    <?php } ?>
                <?php } ?>
                <div><input type="submit" name="saveModification" class="saveButton btn btn-outline-light my-5" value="Modifier"></div>
            </form>
        </div>
        </div>

            <hr class="hotelSeparation my-5">

</div>        

    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>