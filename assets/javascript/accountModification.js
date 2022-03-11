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


document.addEventListener("click", event => {
    let divContainer = event.target.closest("div")
    let infosToDelete = divContainer.querySelector(".inline")
    inputName = infosToDelete.getAttribute("data-name")
    let infoName = divContainer.querySelector(".infoName")
    let createdInput = divContainer.querySelector("#" + inputName)
    let errorMessage = divContainer.querySelector(".errorMessage")

    if (event.target.matches(".accountModifyButton")) {
        if (!createdInput) {
            infosToDelete.style.display = "none"
            let formToAppend = `
                <input type="text" name="${inputName}" id="${inputName}">
                <button class="btn btn-primary btn-outliner-light" id="save${inputName}" disabled>Modifier</button>
                `
            infoName.insertAdjacentHTML("afterend", formToAppend)
        }
    }

    if (event.target.matches(["#save" + inputName])) {
        if (!errorMessage) {
            const formData = new FormData();
            formData.append(inputName, createdInput.value);
            // formData.append("name","value");

            // autre façon de faire de l'ajax
            fetch("./controller/ajaxAccountController.php", { method: 'POST', body: formData })
                .then(response => response.text()) // si je recois du json je met .json() a la place
                .then(response => {
                    console.log(response)
                    window.location.reload();
                })
        }
    }

})

document.addEventListener("input", event => {
    let divContainer = event.target.closest("div")
    let errorCheck = divContainer.querySelector(".errorMessage")
    let saveButton = divContainer.querySelector("#save" + event.target.name)
    for (const [input, regex] of Object.entries(inputsArray)) {
        if (event.target.matches("#" + input)) {
            if (regex.test(event.target.value) && event.target.value.length > 0) {
                saveButton.disabled = false
                if (errorCheck) {
                    errorCheck.remove()
                }
            } else {
                saveButton.disabled = true
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
