//Regex (possibilité d'en ajouter si nécéssaire)
const regexMail = /^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i
const regexPhone = /^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/

//Création des messages d'erreur
const emailError = "Veuillez entrer une vadresse e-mail valide."
const phoneError = "Veuillez entrer un numéro de téléphone valide."

//Ajouter les noms des inputs ainsi que les regex associées
const inputsArray = {
    "email": regexMail,
    "phone": regexPhone,
}

//Ajouter les messages d'erreur avec les noms des inputs ainsi que les messages associés
const errorMessages = {
    "email": emailError,
    "phone": phoneError,
}

//Récupération de toutes les divs contenat les informations de compte
let specificInfoDiv = document.querySelectorAll(".specificInfo")
specificInfoDiv.forEach(element => {
    //Ajout d'un écouteur d'évènement sur chaque élément
    element.addEventListener("click", event => {
        //Récupération des éléments nécésssaires à la suite
        let divContainer = event.target.closest("div")
        let infosToDelete = divContainer.querySelector(".inline")
        let inputName = infosToDelete.getAttribute("data-name")
        let infoName = divContainer.querySelector(".infoName")
        let createdInput = divContainer.querySelector("#" + inputName)
        let errorMessage = divContainer.querySelector(".errorMessage")

        //Si l'utilisateur souhaite modifier l'information
        if (event.target.matches(".accountModifyButton")) {
            //Si l'input ne modification n'existe pas déja
            if (!createdInput) {
                //On masque l'information
                infosToDelete.style.display = "none"
                //On la remplace par un input et un bouton de confirmation
                let formToAppend = `
                        <input type="text" name="${inputName}" id="${inputName}">
                        <button class="btn btn-primary btn-outliner-light" id="save${inputName}" disabled>Modifier</button>
                        `
                //Insertion du code HTML
                infoName.insertAdjacentHTML("afterend", formToAppend)
            }
        }

        //Si l'utilisateur souhahite sauvegadrer l'information modifiée
        if (event.target.matches(["#save" + inputName])) {
            // Si le message d'erreur n'a pas été généré car la REGEX correspond
            if (!errorMessage) {
                //Instance FormData
                const formData = new FormData()
                //Ajout des données
                formData.append(inputName, createdInput.value)
                // Envoi des données au controller
                fetch("./controller/customerAjaxController.php", { method: 'POST', body: formData })
                    .then(response => response.text()) // si je recois du json je met .json() a la place
                    .then(response => {
                        //Si les vérifications du controller sont éffectuées, on recharge la page pour afficher les n ouvelles informations.
                        location.reload()
                    })
            }
        }


    })
})

//Ecouteur d'évènement global
document.addEventListener("input", event => {
    let divContainer = event.target.closest("div")
    let errorCheck = divContainer.querySelector(".errorMessage")
    let saveButton = divContainer.querySelector("#save" + event.target.name)
    //Insetion des attributs de l'objet InputsArray dans un tableau
    for (const [input, regex] of Object.entries(inputsArray)) {
        //Si l'id de l'input correspon à un des attributs du tableau
        if (event.target.matches("#" + input)) {
            //On teste la valeur avec la REGEX associée à l'input et on s'assure que l'input ne soit pas vide
            if (regex.test(event.target.value) && event.target.value.length > 0) {
                //Permission à l'utilisateur de valider les données
                saveButton.disabled = false
                //Si le message d'erreur existe, le supprime
                if (errorCheck) {
                    errorCheck.remove()
                }
            //Si la REGEX n'est pas validée ou que l'input est vide
            } else {
                //Le bouton sauvegarder n'est plus disponible
                saveButton.disabled = true
                //Si le message d'erreur n'existe pas, on le créé
                if (!errorCheck) {
                    for (const [inputName, inputErrorMessage] of Object.entries(errorMessages)) {
                        if (inputName == input) {
                            let errorParagraph = `<p class="errorMessage">${inputErrorMessage}</p>`
                            saveButton.insertAdjacentHTML("afterend", errorParagraph)
                        }
                    }
                }
            }
        }
    }
})
