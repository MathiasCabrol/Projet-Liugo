
const siretRegex = /^[0-9]{14}$/
//Regex Nom de l'établissement  
const textRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s\-\'\.]+$/
//Regex format mail
const phoneRegex = /^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/

//Messages d'erreur pour les champs
const errorMessageText = "Merci d'entrer un secteur d'activités uniquement en lettres, il est possible d'utiliser des tirets, des underscores et des apostrophes."
const errorMessagePhone = "Merci d'entrer un numéro de téléphone avec unnformat valide."
const errorMessageSiret= "Merci d'entrer un Numéro de Siret au format valide (14 chiffres)."


sectorInput.addEventListener("input", function () {
    regexTest(this, textRegex, errorMessageText)
})

phoneInput.addEventListener("input", function () {
    regexTest(this, phoneRegex, errorMessagePhone)
})

siretInput.addEventListener("input", function () {
    regexTest(this, siretRegex, errorMessageSiret)
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