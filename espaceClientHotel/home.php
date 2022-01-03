<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <title>Accueil</title>
</head>
<body class="hotelBody">
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="hotelTitle mt-5 ">Mon Établissement</h1>
            </div>
            <div class="col-12 col-md-8 col-lg-8 text-center mt-5 mb-5 hotelIntro">
                <p>C’est ici que vous pourrez configurer
l’entièreté de vos services.</p>
                <p>Vous pourrez également sélectionner
Des partenaires dans notre liste afin
De proposer leurs services à vos clients
Contre une commission.</p>
                <p>Attention, cette page est visible par les
Clients qui scannent votre QR code.</p>
            </div>
            <hr class="hotelSeparation">
        </div>
        <div class="col-12 text-center my-5">
            <h2 class="tangerine hotelSub">Hotel du Cap-Ferret<sup>****</sup></h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="drop-zone mt-5">
            <span class="drop-zone__prompt">Ma photo d'accueil</span>
            <input type="file" name="homePhoto" class="drop-zone__input">
            </div>
            <textarea class="formText mt-5" id="description" name="description" rows="5" cols="30" placeholder="Notre établissement hôtelier le Cap-Ferret est idéalement situé sur les côtes pour une vue imprenable"></textarea>
        </form>
        </div>
        </div>
    </div>
</body>
<!-- My script -->
<script src="../assets/javascript/dragZone.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</html>