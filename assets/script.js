//Regex Nom de l'établissement  
const regexName = /^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/
//Regex format mail
const regexMail = /^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i
// Regex format mot de passe
const regexPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/
//Messages d'erreur pour les champs
const errorMessageName = "Merci d'entrer un nom uniquement en lettres, il est possible d'utiliser des tirets, des underscores et des apostrophes."
const errorMessageMail = "Merci d'entrer une adresse mail avec un format valide."
const errorMessagePassword = "Merci d'entrer un mot de passe contenant au minimum 8 caractères, une majuscule, une minuscule et un caractère spécial."

nameInput.addEventListener("input", function () {
    regexTest(this, regexName, errorMessageName)
})

mailInput.addEventListener("input", function () {
    regexTest(this, regexMail, errorMessageMail)
})

passwordInput.addEventListener("input", function () {
    regexTest(this, regexPassword, errorMessagePassword)
})

//Création de la fonction qui vérifie la saisie utilisateur et qui affiche le message correspondant.
function regexTest(inputFull, regex, errorMessage) {
    //Création de la constante permettant de faire l'id du p
    const pId = "p" + inputFull.id
    let p = document.getElementById(pId)
    //On vérifie que le p existe. Si c'est le cas on le modifie. Sinon on le crée
    if (p == null) {
        //Création du paragraphe virtuel
        p = document.createElement("p")
        p.id = pId
    }

    //Création de la condition du test RegExp.
    if (!regex.test(inputFull.value)) {
        //Création texte refus de validation.
        p.innerText = errorMessage
        //Changement de couleur.
        p.style.color = "red"
    } else {
        //Création du texte du paragraphe de validation.
        p.innerText = "Bien joué !"
        //Changement de couleur.
        p.style.color = "green"
    }
    inputFull.insertAdjacentElement("afterend", p)
}