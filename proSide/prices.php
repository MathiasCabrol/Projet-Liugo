<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prices page LIUGO</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?>
    <section>
        <!-- Creating prices container -->
        <div class="container">
            <!-- prices row -->
            <div class="row justify-content-center">
                <!-- prices title col -->
                <div class="col-10 text-center mt-5">
                    <h1 class="pageTitle tangerine">Tarification</h1>
                </div>
                <!-- Prices intro col -->
                <div class="col-10 text-center mt-5">
                    <p class="didot">Afin de vous garantir une transparance totale, vous trouverez ci-dessous les différentes tarifications.</p>
                </div>
                <!-- Hotel side prices col -->
                <div class="col-10 col-md-5 col-lg-5 border rounded shadow mx-md-3 text-center mt-5">
                    <h2 class="tangerine mt-4"><i class="fas fa-tag mx-2"></i>Etablissements Hôteliers</h2>
                    <img class="pricesImage mt-4 rounded" src="../assets/img/hotel-webFormat.jpg">
                    <p class="didot my-4">Afin de vous prouver l'éfficacité de notre plateforme. Vous aurez accès à une période d'essai de 1 mois pendant laquelle vous pourrez commencer à faire profiter vos clients de nos services. une fois ce délai dépassé, vous pourrez souscrire notre abonnement afin de couvrir les frais d'entretien de la plateforme.</p>
                    <!-- Inner hotel prices row -->
                    <div class="row justify-content-center">
                        <!-- subscription col -->
                        <div class="col-10 pricingCol rounded mb-5">
                            <h3 class="tangerine mt-4">Abonnement mensuel</h3>
                            <p class="didot mt-4">Abonnement mensuel : 30€/mois</p>
                            <button class="btn btn-outline-light priceButton border rounded shadow mb-4" type="button">J'en profite</button>
                            <h3 class="tangerine mt-4 subBorder pt-5">Abonnement annuel</h3>
                            <p class="didot mt-4">Abonnement mensuel : 300€/an (2 mois offerts)</p>
                            <button class="btn btn-outline-light priceButton border rounded shadow mb-4" type="button">J'en profite</button>
                        </div>
                    </div>
                    <!-- Services side prices -->
                </div>
                <div class="col-10 col-md-5 col-lg-5 border rounded shadow mx-md-3 text-center mt-5">
                    <h2 class="tangerine mt-4"><i class="fas fa-tags mx-2"></i></i>Prestataires de service</h2>
                    <img class="pricesImage mt-4 rounded" src="../assets/img/Services-pricingPage.jpg">
                    <p class="didot my-4">Vous pourrez profiter de l'ensemble de notre plateforme gratuitement. Une légère commisssion afin de couvrir les frais de service sera appliquée uniquement en cas de réservation de la part de nos clients. Vous pouvez également optez pour nos différents package vous permettant d'optimiser votre visibilité dans un second temps.</p>
                    <!-- Inner hotel prices row -->
                    <div class="row justify-content-center">
                        <!-- subscription col -->
                        <div class="col-10 pricingCol rounded mb-5">
                            <h3 class="tangerine mt-4">Tableau des commissions</h3>
                            <table class="mt-4 mb-4">
                                <thead>
                                    <tr>
                                        <th class="px-2">Montant de chiffre d'affaire</th>
                                        <th>Commission en % du montant réglé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Moins de 50.000€ de C.A</td>
                                        <td>6%</td>
                                    </tr>
                                    <tr>
                                        <td>Entre 50k et 100k de C.A</td>
                                        <td>5.5%</td>
                                    </tr>
                                    <tr>
                                        <td>Entre 100k et 250k de C.A</td>
                                        <td>5%</td>
                                    </tr>
                                    <tr>
                                        <td>Entre 250k et 1 million de C.A</td>
                                        <td>4.5%</td>
                                    </tr>
                                    <tr>
                                        <td>Plus de 1 million d'euros de C.A</td>
                                        <td>4%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </section>
    <section>
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-10 text-center">
                    <button class="btn btn-outline-light accountButton border rounded shadow" type="button" data-toggle="modal" data-target="#accountModal">Créer un compte</button>
                </div>
                <!-- Account creation modal -->
                <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header blueBackground">
                                <h5 class="modal-title tangerine" id="modalLabel">Faites votre choix :</h5>
                                <button type="button" class="close modalCross btn-secondary btn-outline-light rounded" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Oppening modal-body container -->
                                <div class="container-fluid">
                                    <!-- Opening modal-body row -->
                                    <div class="row justify-content-between">
                                        <!-- Opening Hotel choice col -->
                                        <div class="col-5 text-center">
                                            <img class="modalImage rounded" src="../assets/img/hotelDoor.jpg" alt="Hotel room door">
                                            <button type="button" class="btn blueBackground categoryButton btn-outline-light">Hôtel</button>
                                            <!-- Closing Hotel choice col -->
                                        </div>
                                        <!-- oppening "or" col -->
                                        <div class="col-2 text-center align-self-center">
                                            <p class="orModal">Ou</p>
                                            <!-- Closing "or" col -->
                                        </div>
                                        <!-- Opening services choice -->
                                        <div class="col-5 text-center">
                                            <img class="modalImage rounded" src="../assets/img/servicesChoice.jpg" alt="Dancing woman on sunset">
                                            <button type="button" class="btn blueBackground categoryButton btn-outline-light">Prestataire</button>
                                            <!-- Closing services choice -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer mt-3 blueBackground rounded">
                                    <button type="button" class="btn btn-secondary btn-outline-light closeModal" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>

    </section>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>