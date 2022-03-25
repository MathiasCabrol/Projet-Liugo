//Regex (possibilité d'en ajouter si nécéssaire)
const regexName = /^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/
const regexMail = /^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i
const regexPhone = /^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/
const regexAddress = /^([0-9])*[\s]?([Bb][is])?[\s]([A-Za-zÀ-ÖØ-öø-ÿ\s])*$/
const regexPostcode = /^[0-9]{5}$/


//Création des messages d'erreur
const nameError = 'Veuillez entrer un nom valide.'
const emailError = "Veuillez entrer une vadresse e-mail valide."
const phoneError = "Veuillez entrer un numéro de téléphone valide."
const addressError = "Veuillez entrer une adresse valide."
const postcodeError = "veuillez entrer un code postal valide."

//Ajouter les noms des inputs ainsi que les regex associées
const inputsArray = {
    "name": regexName,
    "email": regexMail,
    "phone": regexPhone,
    "address": regexAddress,
    "postcode": regexPostcode
}

//Ajouter les messages d'erreur avec les noms des inputs ainsi que les messages associés
const errorMessages = {
    "name": nameError,
    "email": emailError,
    "phone": phoneError,
    "address": addressError,
    "postcode": postcodeError

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
                // formData.append("name","value");
                //Si l'information modifiée est le code postal, on ajoute le nom de la ville sélectionnée
                if (inputName == "postcode") {
                    let optionCollection = citySelect.selectedOptions
                    if (citySelect.firstChild) {
                        formData.append("cityId", optionCollection[0].value)
                    }
                }
                // Envoi des données au controller
                fetch("./controller/ajaxAccountController.php", { method: 'POST', body: formData })
                    .then(response => response.text()) // si je recois du json je met .json() a la place
                    .then(response => {
                        //Si les vérifications du controller sont éffectuées, on recharge la page pour afficher les n ouvelles informations.
                        window.location.reload();
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
                //Si l'input modifié est le code postal, on doit également afficher le nom des vilels correspondantes
                if (input == "postcode" && event.target.value.length == 5) {
                    //Message d'aide pour l'utilisateur
                    let helpMessage = document.createElement("p")
                    helpMessage.innerText = "Veuillez séléctionner une ville ci-dessous."
                    helpMessage.className = "helpMessage"
                    saveButton.insertAdjacentElement("afterend", helpMessage)
                    //Instance FormData
                    const formData = new FormData()
                    //Envoi de la valeur du code postal au controlleur
                    formData.append("postCodeValue", event.target.value)
                    fetch("./controller/ajaxAccountController.php", { method: 'POST', body: formData })
                    //Le controlleur va ensuite renvoyer en réponse un JSON contenant les informations de toutes les villes qui 
                    //correspondent au code postal
                        .then(response => response.json()) // si je recois du json je met .json() a la place
                        .then(response => {
                            //Création d'un select en utilisant la fonction et passant en paramètre le fichier JSON
                            CreateFormElement(response)
                        })
                }
                //Permission à l'utilisateur de valider les données
                saveButton.disabled = false
                //Si le message d'erreur existe, le supprime
                if (errorCheck) {
                    errorCheck.remove()
                }
            //Si la REGEX n'est pas validée ou que l'input est vide
            } else {
                //Si la taille de l'input est n'est pas égale à 5, on supprime le select
                if (event.target.value.length != 5) {
                    DeleteFormElement()
                }
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

//Fonction permettant de créer le select en utilisant la réponse AJAX en paramètre
CreateFormElement = (param) => {
    let cityNameToDelete = document.querySelector('[data-name="city"]')
    cityNameToDelete.style.display = "none"
    let select = document.createElement("select")
    select.setAttribute("name", "city")
    select.classList.add("w-100")
    select.id = "citySelect"
    cityNameToDelete.insertAdjacentElement('afterend', select)
    console.log(param)
    for (let i = 0; i < param.length; i++) {
        let option = document.createElement("option")
        option.value = param[i].id
        option.innerText = param[i].city
        select.append(option)
    }
}

//Fonction permettant de supprimer le select
DeleteFormElement = () => {
    let elementToDelete = document.querySelector('[name="city"]')
    if (elementToDelete) {
        elementToDelete.remove()
        let cityNameToShow = document.querySelector('[data-name="city"]')
        cityNameToShow.style.display = "block"
    }
}