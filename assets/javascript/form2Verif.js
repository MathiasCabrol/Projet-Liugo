
//Regex format mail
const phoneRegex = /^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/
const adressRegex = /^([0-9])*[\s]?([Bb][is])?[\s]([A-Za-zÀ-ÖØ-öø-ÿ\s])*$/
const postCodeRegex = /^[0-9]{5}$/

//Messages d'erreur pour les champs
const errorMessagePhone = "Merci d'entrer un numéro de téléphone avec unnformat valide."
const errorMessageAddress = "Merci d'entrer une adresse valide"
const errorMessagePostCode= "Merci d'entrer un code postal valide (5 chiffres)."

phoneInput.addEventListener("input", function () {
    regexTest(this, phoneRegex, errorMessagePhone)
})

addressInput.addEventListener("input", function () {
    regexTest(this, adressRegex, errorMessageAddress)
})

postCodeInput.addEventListener("input", function () {
    regexTest(this, postCodeRegex, errorMessagePostCode)
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
        p.innerText = ""
    }
    inputFull.insertAdjacentElement("afterend", p)
}