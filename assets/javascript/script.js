//Regex Nom de l'établissement  
const regexName = /^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/
//Regex format mail
const regexMail = /^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i
// Regex format mot de passe, sécurité moyenne et forte
const strongPassword = /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})/
const mediumPassword = /((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))/
//Messages d'erreur pour les champs
const errorMessageName = "Merci d'entrer un nom uniquement en lettres, il est possible d'utiliser des tirets, des underscores et des apostrophes."
const errorMessageMail = "Merci d'entrer une adresse mail avec un format valide."
const errorMessagePassword = "Merci d'entrer un mot de passe contenant au minimum 8 caractères, une majuscule, une minuscule et un caractère spécial."

let timeout;

// traversing the DOM and getting the input and span using their IDs

let password = document.getElementById("passwordInput")
let strengthBadge = document.getElementById("StrengthDisp")

function StrengthChecker(PasswordParameter){
    // We then change the badge's color and text based on the password strength

    if(strongPassword.test(PasswordParameter)) {
        strengthBadge.style.backgroundColor = "green"
        strengthBadge.textContent = "Fort"
    } else if(mediumPassword.test(PasswordParameter)){
        strengthBadge.style.backgroundColor = "blue"
        strengthBadge.textContent = "Moyen"
    } else{
        strengthBadge.style.backgroundColor = "red"
        strengthBadge.textContent = "Faible"
    }
}


nameInput.addEventListener("input", function () {
    regexTest(this, regexName, errorMessageName)
})

mailInput.addEventListener("input", function () {
    regexTest(this, regexMail, errorMessageMail)
})
// Adding an input event listener when a user types to the  password input 

passwordInput.addEventListener("input", () => {

    //The badge is hidden by default, so we show it

    strengthBadge.style.display= "block"
    clearTimeout(timeout);

    //We then call the StrengChecker function as a callback then pass the typed password to it

    timeout = setTimeout(() => StrengthChecker(password.value), 500);

    //Incase a user clears the text, the badge is hidden again

    if(password.value.length !== 0){
        strengthBadge.style.display != "block"
    } else{
        strengthBadge.style.display = "none"
    }
});

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
    } 
    inputFull.insertAdjacentElement("afterend", p)
}