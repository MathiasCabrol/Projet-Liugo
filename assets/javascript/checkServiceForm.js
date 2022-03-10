//Regex (possibilité d'en ajouter si nécéssaire)
const titleRegex = /^([A-Za-zÀ-ÖØ-öø-ÿ])+([-\ .]|[A-Za-zÀ-ÖØ-öø-ÿ])*$/

//Création des messages d'erreur
const titleError = 'Veuillez entrer une valeur valide pour le titre de service.'
const nameError = "Veuillez entrer une valeur valide pour le nom du sous-service."

//Ajouter les noms des inputs ainsi que les regex associées
let inputsArray = { 
    "serviceTitle": titleRegex, 
    "serviceName": titleRegex
}

//Ajouter les messages d'erreur avec les noms des inputs ainsi que les messages associés
let errorMessages = {
    "serviceTitle": titleError,
    "serviceName": nameError
}

let errorMessagesArray = []

//Ecouteur d'évènement sur tous les éléments de la page lors de l'insertion de caractères
document.addEventListener("input", event => {
    //Pour chaque attribut de l'objet inputsArray, on crée un tableau avec le nom des inputs en clé
    //et la regex en valeur
    for (const [input, regex] of Object.entries(inputsArray)) {
        //Si le nom de l'input correspond à l'input modifié
        if(event.target.matches("[name^=" + input + "]")){
            //Récupération du paragraphe d'erreur créé plus bas
            let errorMessageElement = document.getElementById(input + "Error")
            //Si le paragraphe d'erreur existe et que l'input est vide
            if(errorMessageElement && event.target.value.length == 0){
                //On supprime le paragraphe d'erreur
                errorMessageElement.remove()
            }
            //On effectue le test de la regex avec la valeur de l'input
            if(regex.test(event.target.value)){
                //Si le test est concluant et que le paragraphe d'erreur existe, on le supprime
                if(errorMessageElement){
                    errorMessageElement.remove()
                }
            //Si le test de Regex n'est pas concluant
            } else {
                //Si le paragraphe d'erreur n'existe pas et que l'input n'est pas vide
                if(!errorMessageElement && event.target.value.length > 0) {
                //On crée une variable contenant une balise <p>
                let errorMessage = document.createElement("p")
                //On lui donne un id en fonction de l'input
                errorMessage.id = input + "Error"
                //Classe permettant l'affichage du style css définit en amont
                errorMessage.className = "errorMessage"
                //Message d'erreur
                for (const [inputName, inputErrorMessage] of Object.entries(errorMessages)) {
                    if(inputName == input){
                        errorMessage.innerText = inputErrorMessage
                    }
                }
                //Insertion du paragraphe d'erreur juste après l'input
                event.target.insertAdjacentElement("afterend", errorMessage)
                }
            }
        }
        
    }

})