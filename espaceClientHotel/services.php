<?php include 'controller/servicesController.php'; ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link href="../assets/css/style.css" rel="stylesheet">
    <title>Document</title>
</head>

<body class="hotelBody">
    <?php include 'navbar.php' ?>
    <!-- Page title and intro -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="hotelTitle mt-5 ">Mes Services</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 hotelIntro">
                <p>Vous trouverez sur cette page la totalité des services que vous pouvez proposer à vos clients.</p>
                <p>Ils auront la possibilité de les réserver directement sur la page de votre établissement.</p>
                <p>Ajoutez des photos, des descriptions, tarifs et plus encore !</p>
            </div>
            <hr class="hotelSeparation mt-5">
            <?php if(isset($getErrorMessage)){ ?>
            <div class="col-12 text-center text-danger"><p><?= $getErrorMessage ?></p></div>
            <?php } ?>
            <?php if ($newUser) {
            ?>
                <div class="col-12 col-md-12 col-lg-12 text-center mt-5 hotelIntro">
                    <p><?= $tutoText ?></p>
                </div>
                <!-- Service creation example, shown only if button clicked -->
                <div class="col-12 col-md-5 text-center exampleCol mt-5">
                    <p class="mt-2 exampleTitle">Exemple de création d'un service</p>
                    <img src="../assets/img/restaurant-g8e7b7bd58_640.jpg" class="exampleImage2">
                    <div class="row justify-content-center">
                        <div class="col-10 text-center mt-2 innerExampleCol">
                            <p class="tangerine mt-2 exampleTitle">Petit-Déjeuner</p>
                            <p>De 7h00 à 10h30</p>
                            <p>10€/enfant - 18€/adulte</p>
                        </div>
                        <div class="col-10 text-center mt-2 innerExampleCol">
                            <p class="tangerine mt-2 exampleTitle">Déjeuner</p>
                            <p>De 12h00 à 14h30</p>
                            <p>Menu du jour à 25€/adulte - 15€/enfant</p>
                            <p>Possibilté de choix à la carte</p>
                            <button class="exampleButton btn btn-outline-light mb-2">Consulter notre carte</button>
                        </div>
                        <div class="col-10 text-center mt-2 innerExampleCol mb-2">
                            <p class="tangerine mt-2 exampleTitle">Diner</p>
                            <p>De 19h00 à 23h00</p>
                            <p>Choix à la carte</p>
                            <button class="exampleButton btn btn-outline-light mb-2">Consulter notre carte</button>
                        </div>
                    </div>
                </div>
        </div>
    <?php } else { ?>
        <!-- Affichage des différents services crées  -->
        <div class="row justify-content-around mt-5">
            <?php foreach ($servicesInfos as $service) { ?>
                <div class="col-5 col-md-3 col-lg-2 text-center showService">
                    <div class="col-12 text-center my-5 text-black">
                        <form action="" method="get">
                            <input type="hidden" name="id" value="<?= $service->id ?>">
                        <button type="submit" class="btn btn-danger servicesButtons crossButton" name="action" value="delete">X</button>
                        <button type="submit" class="btn btn-info servicesButtons text-white modifyButton" name="action" value="modify"><i class="fa-solid fa-pen-to-square"></i></button>
                        </form>
                        <h2 class="tangerine hotelSub"><?= $service->title ?></h2>
                        <img class="mt-5 previewImage" src="<?= 'hotels/' . $_SESSION['login'] . '/' . 'category/' . 'categoryPhoto' . $service->id . '.' . $extension[$service->id] ?>">
                    </div>
                </div>
            <?php } ?>
            <div class="col-5 col-md-3 col-lg-2 text-center">
                <div class="col-12 emptyService">
                    <p><button onclick="window.location='addService.php'" class="btn-outline-light">+</button></p>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

    <?php include 'footer.php' ?>
</body>
<!-- My script -->
<!-- Drag & drop -->
<script src="../assets/javascript/dragZone.js"></script>
<!-- Linked to radio inputs in the form -->
<script src="../assets/javascript/checkbox.js"></script>
<!-- Cloning presta nodes on request -->
<script src="../assets/javascript/addService.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>