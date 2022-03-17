//Regex (possibilité d'en ajouter si nécéssaire)
const titleRegex = /^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'._\s-]{2,50}$/
const priceRegex = /^[0-9]{1,5}([.][0-9]{2})?$/

//Création des messages d'erreur
const titleError = 'Veuillez entrer une valeur valide pour le titre de service.'
const nameError = "Veuillez entrer une valeur valide pour le nom du sous-service."
const priceError = "Veuillez insérer un prix, séparer les centimes avec un point ex 10.50"

//Ajouter les noms des inputs ainsi que les regex associées
const inputsArray = {
    "serviceTitle": titleRegex,
    "serviceName": titleRegex,
    "servicePrice": priceRegex
}

//Ajouter les messages d'erreur avec les noms des inputs ainsi que les messages associés
const errorMessages = {
    "serviceTitle": titleError,
    "serviceName": nameError,
    "servicePrice": priceError
}

let check = []

//Ecouteur d'évènement sur tous les éléments de la page lors de l'insertion de caractères
document.addEventListener("input", event => {
    //Pour chaque attribut de l'objet inputsArray, on crée un tableau avec le nom des inputs en clé
    //et la regex en valeur
    for (const [input, regex] of Object.entries(inputsArray)) {
        //Si le nom de l'input correspond à l'input modifié
        if (event.target.matches("[name^=" + input + "]")) {
            //Récupération du paragraphe d'erreur créé plus bas
            let errorMessageElement = document.getElementById(input + "Error")
            //Si le paragraphe d'erreur existe et que l'input est vide
            if (errorMessageElement && event.target.value.length == 0) {
                //On supprime le paragraphe d'erreur
                errorMessageElement.remove()
            }
            //On effectue le test de la regex avec la valeur de l'input
            if (regex.test(event.target.value)) {
                //Si le test est concluant et que le paragraphe d'erreur existe, on le supprime
                if (errorMessageElement) {
                    errorMessageElement.remove()
                }
                //Si le test de Regex n'est pas concluant
            } else {
                //Si le paragraphe d'erreur n'existe pas et que l'input n'est pas vide
                if (!errorMessageElement && event.target.value.length > 0) {
                    //On crée une variable contenant une balise <p>
                    let errorMessage = document.createElement("p")
                    //On lui donne un id en fonction de l'input
                    errorMessage.id = input + "Error"
                    //Classe permettant l'affichage du style css définit en amont
                    errorMessage.className = "errorMessage"
                    //Message d'erreur
                    for (const [inputName, inputErrorMessage] of Object.entries(errorMessages)) {
                        if (inputName == input) {
                            errorMessage.innerText = inputErrorMessage
                        }
                    }
                    //Insertion du paragraphe d'erreur juste après l'input
                    event.target.insertAdjacentElement("afterend", errorMessage)
                }
            }
        }
    }
    //Variable qui récupère tous les noeuds des éléments inputs
    let inputs = document.querySelectorAll("input")
    for (let i = 0; i < inputs.length; i++) {
        //Déclaration variable nulle
        let realInputName
        //Si l'attribut name du noeud inclus des crochets
        if(inputs[i].name.includes("[]")){
            //Les supprimer et insérer le name dans une variable
            realInputName = inputs[i].name.slice(0, -2)
        } else {
            //Sinon insérer directement le name
            realInputName = inputs[i].name
        }
        //Si l'input n'est pas vide, et que le paragraphe d'erreur associé n'existe pas
        if (inputs[i].value != "" && !document.getElementById(realInputName + "Error")) {
            //Alors la vérification passe
            check[i] = 1
        } else {
            //Si l'élément parent de l'input contient la classe qui permet de le cacher (pour le bouton)
            if (inputs[i].parentElement.classList.contains("hiddenInput")) {
                //Le test passe
                check[i] = 1
            } else {
                //Sinon le test ne passe pas
                check[i] = 0
            }
        }
    }
    //En cas de suppression ou d'ajout, SI la taille du tableau est différente du nombre d'inputs, on les aligne
    if(check.length != inputs.length) {
        check.length = inputs.length
    }
    //On recherche les tests négatifs dans le tableau
    let checkResult = check.find(element => element == 0)
    //Si il y en a, le bouton sauvegarder est désactivé
    if (checkResult != undefined) {
        save.disabled = true
    //Sinon le bouton sauvegarder est activé
    } else {
        save.disabled = false
    }
})
//Gestion de la suppressione et de l'ajout
document.addEventListener("click", event => {
    if(event.target.matches(".redCrossButton")){
        save.disabled = true
    }
    if(event.target.matches(".addPresta")){
        save.disabled = true
    }
})
