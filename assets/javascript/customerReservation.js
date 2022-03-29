const dateRegex = /^20[2-9][0-9]-((0[1-9])||(1[0-2]))-((0[1-9])||([1-2][0-9])||(3[0-1]))$/

//Ecouteur d'évènement global lors d'un input
document.addEventListener("input", event => {
    //Récupération de l'url
    let url_string = window.location.href
    let url = new URL(url_string);
    //Insertion du paramètre get dans la variable
    let serviceId = url.searchParams.get("serviceId");
    //SI l'utilisateur insère une date dans l'input prévu
    if (event.target.matches(".reservationDate")) {
        //On récupère la div parent la plus proche
        let parentDiv = event.target.closest("div")
        //Sélection des différents élements qui seront utiles par la suite
        let SubServiceId = parentDiv.querySelector(".subServiceId").value
        let hiddenInput = parentDiv.querySelector(".subServiceId")
        let checkSubmitButton = parentDiv.querySelector("#book")
        //Si la valeur de l'input correspond à la regex déclarée plus haut
        if (dateRegex.test(event.target.value)) {
            //Instance form data
            const formData = new FormData()
            //Envoi des données
            formData.append('reservationDate', event.target.value)
            formData.append('serviceId', serviceId)
            formData.append('subServiceId', SubServiceId)
            //Envoi des données vers le controller php pour gestion des requêtes sql
            fetch("./controller/reservationController.php", { method: 'POST', body: formData })
                .then(response => response.json()) // si je recois du json je met .json() a la place
                .then(response => {
                    //Si le bouton de validation existe déja dans cette div, cela veut dire que l'utilisateur a déja généré un formulaire
                    //Donc on supprime l'ancien formulaire
                    if (checkSubmitButton) {
                        checkSubmitButton.remove();
                        let previousForm = parentDiv.querySelector(".insertedForm")
                        previousForm.remove()
                    }
                    //Pour chaque élément de réponse du fichier json créé en php
                    response.forEach(element => {
                        //Début du code html à insérer dans le DOM
                        let htmlToAppend = `<div class="insertedForm"><div>
                    <label for="hourSlot">Créneau horaire</label>
                </div>
                <select name="hourSlot">`
                //TODO débugguer le système de gestion des crénaux horaires déja réservés
                        //Création des éléments option dans une boucle for
                        for (let i = element.startingHour; i < element.finishingHour; i++) {
                            //Si le fichier json contient la propriété "bookedHours", cela signifie que le traitement en php
                            //A détécté que d'autres réservations sont présentes au même jour pour ce service
                            if (response.bookedHours) {
                                //Dans la boucle, si la variable i qui correspond à l'heure de réservation existe dans les heures déja réservées
                                //On rend l'option innacessible
                                if (response.bookedHours.find(element => element = i) != undefined) {
                                    htmlToAppend += `<option value="${i + ':00'}" disabled>${i + ':00'}</option>`
                                    //Sinon l'option s'affiche normalement
                                } else {
                                    htmlToAppend += `<option value="${i + ':00'}">${i + ':00'}</option>`
                                }
                                //Si le fichier json ne contient pas cette propriété, on affiche toutes les heures disponibles
                            } else {
                                htmlToAppend += `<option value="${i + ':00'}">${i + ':00'}</option>`
                            }
                        }
                        //SUite du code html à insérer
                        htmlToAppend += `</select>
                    <div>
                        <label for="clientsNumber">Nombre de personnes</label>
                    </div>
                    <select name="clientsNumber">`
                        //On fait boucler les options dans le select pour choisir le nombre de personnes
                        for (let j = 1; j < 10; j++) {
                            htmlToAppend += `<option value="${j}">${j}</option>`
                        }
                        htmlToAppend += `</select></div>`
                        //Insertion du code html à côté de l'input date
                        event.target.insertAdjacentHTML('afterend', htmlToAppend)
                        //Création d'un bouton de validation
                        let submitButton = `<input type="button" id="book" name="book" value="réserver" class="btn btn-outline-light customerAccountButton">`
                        //Insertion en bas de la div de réservation
                        hiddenInput.insertAdjacentHTML('afterend', submitButton)
                    })
                })
        }
    }

})


//Ecouteur d'évènement de click sur la page
document.addEventListener('click', event => {
    //SI le bouton cliqué correspond bien au bouton de validation créé dans le DOM
    if (event.target.matches('#book')) {
        //Récupération de l'url
        let url_string = window.location.href
        let url = new URL(url_string);
        //Insertion du paramètre get dans la variable
        let serviceId = url.searchParams.get("serviceId");
        //Variable indiquant la div de réservation la plus proche
        let parentDivContainer = event.target.closest('.reservationCol')
        let dateInput = parentDivContainer.querySelector('.reservationDate')
        let chosenDate = parentDivContainer.querySelector('.reservationDate').value
        let chosenHour = parentDivContainer.querySelector('select[name="hourSlot"]').value
        let chosenNumberOfPeople = parentDivContainer.querySelector('select[name="clientsNumber"]').value
        let subServiceId = parentDivContainer.querySelector('.subServiceId').value
        let customerId = parentDivContainer.querySelector('.customerId').value
        //Instance fomrData
        const formData = new FormData();
        //Si les inputs ne sont pas vides
        if (chosenHour.length > 0 && chosenNumberOfPeople.length > 0 && chosenDate.length > 0) {
            //Envoi des données en post
            formData.append('date', chosenDate)
            formData.append('hour', chosenHour)
            formData.append('numberOfPeople', chosenNumberOfPeople)
            formData.append('subServiceId', subServiceId)
            formData.append('serviceId', serviceId)
            formData.append('customerId', customerId)
            //Fetch des données vers le controlleur php de gestion
            fetch("./controller/reservationController.php", { method: 'POST', body: formData })
                .then(response => response.text()) // si je recois du json je met .json() a la place
                .then(response => {
                    if(response == 0){
                        let errorMessageToAppend = `<p class="errorMessage">Veuillez indiquer une date future.</p>`
                        dateInput.insertAdjacentHTML("afterend", errorMessageToAppend)
                        return
                    }
                    window.location.href = response
                })
        }
    }
})

