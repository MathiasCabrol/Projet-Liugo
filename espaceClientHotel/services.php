<?php
if(isset($_POST['saveChanges'])){
    var_dump($_POST['serviceName']);
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
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
            <div class="col-12 text-center">
                <!-- Button linked to showExample.js file -->
                <button id="showExample" class="showExampleButton btn btn-outline-light mt-4">Exemple de service</button>
            </div>
            <!-- Service creation example, shown only if button clicked -->
            <div class="col-12 col-md-5 text-center exampleCol hiddenCol mt-5">
                <p class="mt-2 exampleTitle">Exemple de création d'un service</p>
                <img src="../assets/img/restaurant-g8e7b7bd58_640.jpg" class="exampleImage">
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
        <!-- Creation of the first service -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center formRow">
                <div class="col-12 col-md-5 text-center categoryCol1 formCol mt-5 mx-3">
                    <input type="text" name="serviceTitle[]" placeholder="Restauration" class="mt-5">
                    <div class="drop-zone mt-5">
                        <span class="drop-zone__prompt text-black">Photo du service</span>
                        <input type="file" name="servicePhoto[]" class="drop-zone__input">
                    </div>
                    <!-- Div services à laquelle sont append les éléements crées dans le DOM en JS -->
                    <div class="services">
                        <!-- Div clonée dans le JS -->
                        <div class="presta1">
                            <div class="row justify-content-center">
                                <div class="col-10 text-center mt-2 innerExampleCol">
                                    <input type="text" name="serviceName[]" class="mt-2" placeholder="Nom du service">
                                    <input type="text" name="serviceHour[]" class="mt-2" placeholder="horaires">
                                    <input type="text" name="servicePrice[]" class="mt-2" placeholder="tarifs">
                                    <p class="mt-2 radioQuestion">Souhaitez-vous ajouter un bouton ?</p>
                                    <input class="my-2 showInput" type="radio" value="Oui"><span>Oui</span>
                                    <input class="my-2 hideInput" type="radio" value="non"><span>Non</span>
                                    <div class="buttonContainer hiddenInput">
                                        <input type="text" name="buttonName[]" placeholder="nom du bouton" class="mt-2">
                                        <label>Fichier à télécharger au clic</label>
                                        <input type="file" name="buttonFile[]" class="my-2">
                                    </div>
                                </div>
                            </div>
                            <!-- Closing the "presta" div for JS use -->
                        </div>
                        <!-- CLosing services div -->
                    </div>
                    <button type="button" class="exampleButton btn btn-outline-light addPresta mt-4">Ajouter une prestation</button>
                    <button type="button" class="deleteButton btn btn-outline-light deletePresta my-4">Supprimer la dernière prestation</button>
                </div>
            </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <button id="addCategory" type="button" class="showExampleButton btn btn-outline-light mt-4 mx-3">Ajouter une catégorie</button>
                <button id="deleteCategory" type="button" class="deleteCategoryButton btn btn-outline-light mt-4 mx-3">Supprimer catégorie</button>
            </div>
        </div>
        <hr class="hotelSeparation mt-5">
        <div class="row justify-content-center mt-5">
                <div class="col-12 text-center">
                    <input type="submit" name="saveChanges" class="saveButton btn btn-outline-light" value="Sauvegarder">
                </div>
            </div>
        </form>
    </div>

    <?php include 'footer.php' ?>
</body>
<!-- My script -->
<!-- Drag & drop -->
<script src="../assets/javascript/dragZone.js"></script>
<!-- Linked to showExample button on top of the page -->
<script src="../assets/javascript/showExample.js"></script>
<!-- Linked to radio inputs in the form -->
<script src="../assets/javascript/checkbox.js"></script>
<!-- Cloning presta nodes on request -->
<script src="../assets/javascript/addService.js"></script>
<!-- Cloning category node on request -->
<script src="../assets/javascript/addCategory.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>