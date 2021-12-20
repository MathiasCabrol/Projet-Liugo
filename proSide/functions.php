<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome page LIUGO</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php' ?>
    <section>
        <!-- Creating functions container -->
        <div class="container">
            <!-- Functions row -->
            <div class="row justify-content-center">
                <!-- Functions title col -->
                <div class="col-10 text-center mt-5">
                    <h1 class="pageTitle tangerine">Les fonctionnalités proposées</h1>
                </div>
                <!-- Functions content 1 -->
                <div class="col-10 col-md-5 col-lg-5 border rounded shadow mx-md-3 text-center mt-5">
                    <h2 class="tangerine mt-5">Personnalisez votre page d'acceuil et son contenu !</h2>
                    <!-- Functions 1 inner row -->
                    <div class="row justify-content-center mt-5">
                        <!-- First image inner col -->
                        <div class="col-5">
                            <img class="exampleImage" src="assets/img/Exemple1.png" alt="Account welcome page example">
                        </div>
                        <!-- Second image inner col -->
                        <div class="col-5">
                            <img class="exampleImage" src="assets/img/Exemple2.png" alt="Account welcome page example number two">
                        </div>
                    <!-- Closing inner row -->
                    </div>
                    <!-- Oppening end text col -->
                    <div class="col-12 text-center mt-5 mb-5">
                        <p class="didot mx-2">Vous trouverez ci-dessus un aperçu de la page de personnalisation. </p>
                        <p class="didot mx-2">Vous pourrez modifier votre image d'accueil, descriptif et vos services proposés ainsi que leurs tarifs.</p>
                        <p class="didot mx-2">Cette page sera accessible par tous les clients utilisant la plateforme.</p>
                    </div>
                <!-- Closing functions1 content col-->
                </div>
                <!-- Functions content 2 -->
                <div class="col-10 col-md-5 col-lg-5 border rounded shadow mx-md-3 text-center mt-5">
                    <h2 class="tangerine mt-5">Gérez vos réservations ainsi que vos commissions !</h2>
                    <!-- Functions 2 inner row -->
                    <div class="row justify-content-center mt-5">
                        <!-- First image inner col -->
                        <div class="col-5">
                            <img class="exampleImage" src="assets/img/Exemple3.png" alt="Account welcome page example">
                        </div>
                        <!-- Second image inner col -->
                        <div class="col-5">
                            <img class="exampleImage" src="assets/img/Exemple4.png" alt="Account welcome page example number two">
                        </div>
                    <!-- Closing inner row -->
                    </div>
                    <!-- Oppening end text col -->
                    <div class="col-12 text-center mt-5 mb-5">
                        <p class="didot mx-2">Gérez vos réservations en temps réel pour avoir le maximum d'adaptation. </p>
                        <p class="didot mx-2">Annuler des réservations à tout moment ou contactez les clients si nécéssaire.</p>
                        <p class="didot mx-2">Accédez au récapitulatif des commissions engrangées et suivez leur évolution.</p>
                    </div>
                <!-- Closing functions2 content col-->
                </div>
            <!-- Closing functions row -->
            </div>
            <!-- Creating presentation vids row -->
            <div class="row justify-content-center mt-5">
                <!-- Presentation cids title col -->
                <div class="col-10 text-center">
                    <h2 class="functionsTitle tangerine">Découvrez nos vidéos de présentation</h2>
                </div>
                <!-- First vid col -->
                <div class="col-10 col-md-6 col-lg-6 mt-5">
                    <video width="100%" height="100%" controls>
                        <source src="assets/video/Seoul - 21985.mp4">
                    </video>
                </div>
            <!-- Second vid col -->
                <div class="col-10 col-md-6 col-lg-6 mt-5">
                    <video width="100%" height="100%" controls>
                        <source src="assets/video/Scuba Diving - 699.mp4">
                    </video>
                </div>
                  <!-- Account creation button -->
                <div class="col-8 col-md-4 col-lg-4 text-center mt-5">
                    <button class="btn btn-outline-light accountButton border rounded shadow" type="button" data-toggle="modal" data-target="#accountModal">Créer un compte</button>
            <!-- Closing btn col -->
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
                                    <img class="modalImage rounded" src="assets/img/hotelDoor.jpg" alt="Hotel room door">
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
                                    <img class="modalImage rounded" src="assets/img/servicesChoice.jpg" alt="Dancing woman on sunset">
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
                  </div>
            <!-- Closing presentation div row -->   
            </div>
        <!-- Closing container -->
        </div>
    </section>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</html>