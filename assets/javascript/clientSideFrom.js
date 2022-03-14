const nameRegex = /^[a-zA-ZÀ-ÖØ-öø-ÿ]*([\_\'\-]*[a-zA-ZÀ-ÖØ-öø-ÿ]*)?$/
const mailRegex = /^[a-z0-9]([a-z0-9\-\_\.]*)[@]([a-z0-9\.]+)[\.]([a-z]){2,5}/i
const phoneRegex = /^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/

const lnError = 'Veuillez entrer un nom de famille valide.'
const fnError = "Veuillez entrer un prénom valide."
const mailError = "Veuillez ientrer une adresse email valide"
const phoneError = "Veuillez entrer un numéro de téléphone valide"

const inputsArray = { 
    "lastName": nameRegex, 
    "firstName": nameRegex,
    "mail": mailRegex, 
    "phone": phoneRegex
}
//Ajouter les messages d'erreur avec les noms des inputs ainsi que les messages associés
const errorMessages = {
    "lastName": lnError, 
    "firstName": fnError,
    "mail": mailError, 
    "phone": phoneError
}

document.addEventListener("input", event => {
    for (const [input, regex] of Object.entries(inputsArray)) {
        if(event.target.matches("[name^=" + input + "]")){
            let errorMessageElement = document.getElementById(input + "Error")
            if(regex.test(event.target.value) && event.target.value.length != 0){
                console.log("Bonjour")
                if(errorMessageElement){
                    errorMessageElement.remove()
                }
            } else {
                if(!errorMessageElement) {
                let errorMessage = document.createElement("p")
                errorMessage.id = input + "Error"
                errorMessage.className = "errorMessage"
                for (const [inputName, inputErrorMessage] of Object.entries(errorMessages)) {
                    if (inputName == input) {
                        errorMessage.innerText = inputErrorMessage
                    }
                }
                event.target.insertAdjacentElement("afterend", errorMessage)
                }
            }
        }
    }
    let errorMessagesList = document.querySelectorAll(".errorMessage")
    if(errorMessagesList.length == 0){
        saveButton.disabled = false
    } else {
        saveButton.disabled = true
    }

})