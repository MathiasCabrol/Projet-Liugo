<?php include 'controller/servicesController.php'; ?>
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
                <h1 class="hotelTitle mt-5 ">Création de service</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 hotelIntro">
                <p>Ci-dessous vous trouverez le formulaire vous permettant de créer un service.</p>
                <p>Vos potentiels clients auront accès à ces informations lors de leur connexion</p>
                <p>Une fois créé, vous pourrez le retrouver sur la page "services" et le modifier.</p>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center formRow">
                <div class="col-12 col-md-5 text-center categoryCol1 formCol mt-5 mx-3">
                    <input type="text" name="serviceTitle" placeholder="Restauration" class="mt-5">
                    <div class="drop-zone mt-5">
                        <span class="drop-zone__prompt text-black">Photo du service</span>
                        <input type="file" name="categoryPhoto" class="drop-zone__input">
                    </div>
                    <!-- Div services à laquelle sont append les éléments crées dans le DOM en JS -->
                    <div class="services">
                        <!-- Div clonée dans le JS -->
                        <div class="presta">
                            <div class="row justify-content-center">
                                <div class="col-10 text-center mt-4 innerExampleCol">
                                    <button type="button" class="redCrossButton btn btn-outline-light deletePresta my-4">x</button>
                                    <input type="text" name="serviceName[]" class="mt-2" placeholder="Nom du service">
                                    <label for="serviceStartingHour">Heure de début</label>
                                    <input type="time" name="serviceStartingHour[]" class="mt-2" placeholder="heure de début">
                                    <input type="number" min="1" step="any" placeholder="tarif ex: 10.50" name="servicePrice[]" class="mt-2" placeholder="tarifs">
                                    <label for="serviceEndingHour1">Heure de fin</label>
                                    <input type="time" name="serviceEndingHour[]" class="mt-2" placeholder="heure de fin">
                                    <p class="mt-2 radioQuestion">Souhaitez-vous ajouter un bouton ?</p>
                                    <input class="my-2 showInput" type="radio" name="buttonQuestion0" value="1" checked="checked"><span>Oui</span>
                                    <input class="my-2 hideInput" type="radio" name="buttonQuestion0" value="0"><span>Non</span>
                                    <div class="buttonContainer">
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
                    <button type="button" class="exampleButton btn btn-outline-light addPresta my-4">Ajouter une prestation</button>
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
<!-- Linked to radio inputs in the form -->
<script src="../assets/javascript/checkbox.js"></script>
<!-- Cloning presta nodes on request -->
<script src="../assets/javascript/addService.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- My Script -->
<script src="../assets/javascript/showButton.js"></script>

</html>