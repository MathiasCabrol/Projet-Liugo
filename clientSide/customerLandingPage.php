<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Landing page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="../assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/clientSide.css">
</head>
<body class="mainSection">
    <section>
        <!-- Form container -->
        <div class="container">
            <!-- Form row -->
            <div class="row justify-content-center">
                <!-- Form Col -->
                <div class="col-10 col-md-4 col-lg-4 pricingCol rounded mt-4">
                    <!-- Form title -->
                    <h1 class="tangerine mt-3 text-center">Prêts pour l'aventure ?</h1>
                    <!-- Inner form row -->
                    <div class="row justify-content-center">
                        <!-- Inner form col -->
                        <div class="col-8 text-center">
                            <form action="" method="post">
                                <label class="mt-3 didot" for="fname">Nom</label><br>
                                <input type="text" id="lastName" name="lastName"><br>
                                <label class="mt-3 didot" for="lname">Prénom</label><br>
                                <input type="text" id="firstName" name="firstName">
                                <label class="mt-3 didot" for="mail">Adresse e-mail</label><br>
                                <input type="mail" id="mail" name="mail"><br>
                                <label class="mt-3 didot" for="phone">Numéro de téléphone</label><br>
                                <input type="text" id="phone" name="phone">
                            </form>
                        </div>
                        <!-- Button col -->
                        <div class="col-12 text-center">
                            <button class="btn btn-outline-light priceButton border rounded shadow my-3"> C'est parti !</button>
                        </div>
                        <div class="col-12 text-center my-4">
                        <a class="didot accountCreationLink" href="">Créer un compte</a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?php include '../proSide/footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</html>