postCodeInput.addEventListener("input", () => {

    if (postCodeInput.value.length == 5) {

        if (postCodeRegex.test(postCodeInput.value)) {
            const formData = new FormData();
            formData.append("postCode", postCodeInput.value);
            // formData.append("name","value");

            // autre façon de faire de l'ajax
            fetch("./controller/FinalSubscriptionVerif.php", { method: 'POST', body: formData })
                .then(response => response.json()) // si je recois du json je met .json() a la place
                .then(response => {
                    //Utilisation des données renvoyées en réponse en paramètre de la fonction
                    CreateFormElement(response)
                })

        }
    }
    //Si la longueur de la valeur dans l'input n'est pas égale à 5, alors on supprime le select permettant de choisir la ville
    if (postCodeInput.value.length != 5) {
        let cityElement = document.getElementById("city")
        if (cityElement) {
            city.remove()
            citySelect.remove()
        }
    }
})

//Création du select avec label et insertion
CreateFormElement = (param) => {
    let label = document.createElement("label")
    label.setAttribute("for", "city")
    label.classList.add("mt-3")
    label.innerText = "Ville"
    label.id = "city"
    postCodeInput.insertAdjacentElement('afterend', label)
    let select = document.createElement("select")
    select.setAttribute("name", "city")
    select.classList.add("w-100")
    select.id = "citySelect"
    label.insertAdjacentElement('afterend', select)
    for (let i = 0; i < param.length; i++) {
        let option = document.createElement("option")
        option.value = param[i].id
        option.innerText = param[i].city
        select.append(option)
    }
}