<?php require 'controller/subscriptionController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/clientSide.css">
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-10 col-md-4 col-lg-4 text-center mt-3">
        <img class="logo" src="../assets/marque/Logo_Liugo.png" alt="Logo Liugo">
      </div>
      <!--Closing row logo-->
    </div>
    <!--Closing container-->
  </div>
    <div class="container-fluid">
        <h1 class="didot customerAccounTitle">Création de compte</h1>
        <div class="row justify-content-center">
            <div class="col-10 col-md-4 col-lg-4 text-center customerFormCol">
                <form action="" method="post">
                    <div>
                    <label for="lastname">Nom</label>
                    </div>
                    <div>
                    <input type="text" id="lastNameInput" name="lastname">
                    </div>
                    <div>
                    <label for="firstname">Prénom</label>
                    </div>
                    <div>
                    <input type="text" id="firstNameInput" name="firstname">
                    </div>
                    <div>
                    <label for="phone">Numéro de téléphone</label>
                    </div>
                    <div>
                    <input type="text" id="phoneInput" name="phone">
                    </div>
                    <div>
                    <label for="email">Adresse email</label>
                    </div>
                    <div>
                    <input type="text" id="emailInput" name="email">
                    </div>
                    <div>
                    <label for="password">Mot de passe</label>
                    </div>
                    <div class="passwordIcon">
                        <input type="password" id="passwordInput" name="password">
                        <i id="showPassword" class="fa-solid fa-eye"></i>
                    </div>
                    <div id="StrengthDisp" class="mt-2 w-80 text-center badge displayBadge"></div>
                    <button type="submit" class="btn btn-outline-light customerAccountButton" name="inscription">Inscription</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
<!-- Bootstrap Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- My script -->
<script src="../assets/javascript/showPassword.js"></script>
<script src="../assets/javascript/customerFormVerif.js"></script>

</html>