<?php require 'controller/customerMainController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de services</title>
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
        <fiv class="row">
            <div class="col-12 text-center">
            <h1 class="tangerine blueFont">Ci-dessous vous trouverez les différents services proposés par votre hébergeur, n'hésitez pas à en découvrir davantage.</h1>
            </div>
        </fiv>
    </div>
    <section id="slider">
        <?php $i = 1;
        foreach ($hotelServices as $service) {
            if ($i == 1) { ?>
                <input type="radio" name="slider" id="s<?= $i ?>" checked>
            <?php } else { ?>
                <input type="radio" name="slider" id="s<?= $i ?>">
        <?php }
            $i++;
        } ?>
        <?php $j = 1;
        foreach ($hotelServices as $service) {
        ?>
        <label for="s<?= $j ?>" id="slide<?= $j ?>"><p class="serviceName didot"><?= $service->title ?></p><a class="serviceFrameButton btn btn-outline-light blueBackground didot" href="hotelSelectedService.php?serviceId=<?= $service->id ?>">explorer</a><img src="<?= '../espaceClient/hotels/' . $selectedHotel->email . '/category/categoryPhoto' . $service->id ?>" alt=""></label>
        <?php $j++;
    } ?>
    </section>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>