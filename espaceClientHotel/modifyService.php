<?php
require 'controller/servicesController.php';
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="hotelTitle mt-5 ">Modification de service</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 hotelIntro">
                <p>Ci-dessous vous trouverez le formulaire vous permettant de modifier le service <span class="bold"><?= $serviceInfos->serviceTitle ?></span>.</p>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            
        </form>
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