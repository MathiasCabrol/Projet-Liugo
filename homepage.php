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
<link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php' ?>
    <!--Carousel section-->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-md-8 col-lg-8 mt-3 shadow blueBackground rounded">
                    <div id="welcomeCarouselControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner py-3">
                          <div class="carousel-item active">
                            <img class="d-block w-100 rounded slideImage" src="assets/img/slide_accueil/hands.jpg" alt="First slide">
                            <!-- Carousel caption -->
                            <div class="carousel-caption">
                                <h5>Concept</h5>
                                <p>LIUGO est une plateforme permettant
                                    aux clients individuels de nos 
                                   établissements hôteliers partenaires de 
                                   réserver leurs activités en ligne.</p>
                              </div>
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100 rounded slideImage" src="assets/img/slide_accueil/diary.jpg" alt="Second slide">
                            <!-- Carousel caption -->
                            <div class="carousel-caption">
                                <h5>Gérez votre planning</h5>
                                <p>Grâce aux différents outils mis à votre 
                                    disposition sur notre plateforme, vous pourrez, par exemple, contacter vos clients ou encore affecter des réservations selon vos disponibilités.</p>
                              </div>
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100 rounded slideImage" src="assets/img/slide_accueil/mountain.jpg" alt="Third slide">
                            <!-- Carousel caption -->
                            <div class="carousel-caption">
                                <h5>Augmentez votre visibilité</h5>
                                <p>Des milliers de voyageurs ne connaissant 
                                    pas la région ont la possibilité de
                                     scanner des QR code donnant un accès 
                                    instantané à notre outil avec la possibilité 
                                    de réserver des centaines d’activités.</p>
                              </div>
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#welcomeCarouselControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          </a>
                          <a class="carousel-control-next" href="#welcomeCarouselControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          </a>
                        </div>
                </div>
            <!-- Closing slides row -->    
            </div>
        <!-- Closing container slides -->    
        </div>
    </section>
    <section>
        <div class="container">
            <!-- Informations row -->
            <div class="row justify-content-center mt-5">
                <!-- List col -->
                <div class="col-10 col-md-8 col-lg-8 border rounded shadow mx-md-3 ">
                    <h2 class="tangerine mt-2">Quelques chiffres :</h2>
                    <ul class="didot">
                        <li class="listMargin">117 établissements hôteliers nous ont fait confiance et sont déja partenaire.</li>
                        <li class="listMargin">Des centaines de prestataires proposant des services de qualité et sélectionnés pour leur proffessionalisme.</li>
                        <li class="listMargin">Des milliers de services réservés chaque jour par les clients en séjour dans les établissements partenaires.</li>
                        <li class="listMargin">Augmentation moyenne de 50% du taux de réservation des prestataires partenaires.</li>
                        <li class="listMargin">Reversement de Plusieurs millions d'euros en commission annuellement.</li>
                    </ul>
                <!-- Closing list col -->    
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <!-- Oppening account informations col-->
                <div class="col-10 col-md-5 col-lg-5 mt-5 mt-md-0 mt-lg-0 mx-md-3 border rounded shadow">
                    <h2 class="tangerine mt-2">Essayez dès maintenant :</h2>
                    <p class="listMargin didot">Créez votre compte gratuitement afin d’essayer Les services de notre plateforme, et augmentez votre taux de réservatione ainsi que votre chiffre d'affaire dès maintenant !</p>
                <!-- Closing account informations col-->    
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <!-- Account creation button -->
                <div class="col-8 col-md-4 col-lg-4 text-center">
                    <button class="btn btn-outline-light accountButton border rounded shadow" type="button" data-toggle="modal" data-target="#accountModal">Créer un compte</button>
                <!-- Closing btn col -->
                </div>
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
            <!-- Closing informations row -->
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