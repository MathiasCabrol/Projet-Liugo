const dateRegex = /^20[2-9][0-9]-((0[1-9])||(1[0-2]))-((0[1-9])||([1-2][0-9])||(3[0-1]))$/

document.addEventListener("input", event => {
    let url_string = window.location.href
    let url = new URL(url_string);
    let serviceId = url.searchParams.get("serviceId");
    if (event.target.matches(".reservationDate")) {
        let parentDiv = event.target.closest("div")
        let SubServiceId = parentDiv.querySelector(".subServiceId").value
        let hiddenInput = parentDiv.querySelector("#subServiceId")
        let checkSubmitButton = parentDiv.querySelector("#book")
        if (dateRegex.test(event.target.value)) {
            const formData = new FormData()
            formData.append('reservationDate', event.target.value)
            formData.append('serviceId', serviceId)
            formData.append('subServiceId', SubServiceId)
            fetch("./controller/reservationController.php", { method: 'POST', body: formData })
                .then(response => response.json()) // si je recois du json je met .json() a la place
                .then(response => {
                    if (checkSubmitButton) {
                        checkSubmitButton.remove();
                        let previousForm = parentDiv.querySelector(".insertedForm")
                        previousForm.remove()
                    }
                    response.forEach(element => {
                        let htmlToAppend = `<div class="insertedForm"><div>
                    <label for="hourSlot">Créneau horaire</label>
                </div>
                <select name="hourSlot">`
                        for (let i = element.startingHour; i < element.finishingHour; i++) {
                            if (response.hasOwnProperty('bookedHours')) {
                                if (response.bookedHours.find(element => element = i) != undefined) {
                                    htmlToAppend += `<option value="${i + ':00'}" disabled>${i + ':00'}</option>`
                                } else {
                                    htmlToAppend += `<option value="${i + ':00'}">${i + ':00'}</option>`
                                }
                            } else {
                                htmlToAppend += `<option value="${i + ':00'}">${i + ':00'}</option>`
                            }
                        }
                        htmlToAppend += `</select>
                    <div>
                        <label for="clientsNumber">Nombre de personnes</label>
                    </div>
                    <select name="clientsNumber">`
                        for (let j = 1; j < 10; j++) {
                            htmlToAppend += `<option value="${j}">${j}</option>`
                        }
                        htmlToAppend += `</select></div>`
                        event.target.insertAdjacentHTML('afterend', htmlToAppend)
                        let submitButton = `<input type="button" id="book" name="book" value="réserver" class="btn btn-outline-light customerAccountButton">`
                        hiddenInput.insertAdjacentHTML('afterend', submitButton)
                    })
                })
        }
    }

})



document.addEventListener('click', event => {
    if (event.target.matches('#book')) {
        let parentDivContainer = event.target.closest('.reservationCol')
        let chosenDate = parentDivContainer.querySelector('.reservationDate').value
        let chosenHour = parentDivContainer.querySelector('select[name="hourSlot"]').value
        let chosenNumberOfPeople = parentDivContainer.querySelector('select[name="clientsNumber"]').value
        let subServiceId = parentDivContainer.querySelector('#subServiceId').value
        const formData = new FormData();
        if (chosenHour.length > 0 && chosenNumberOfPeople.length > 0 && chosenDate.length > 0) {
            formData.append('date', chosenDate)
            formData.append('hour', chosenHour)
            formData.append('numberOfPeople', chosenNumberOfPeople)
            formData.append('subServiceId', subServiceId)
            fetch("./controller/reservationController.php", { method: 'POST', body: formData })
                .then(response => response.text()) // si je recois du json je met .json() a la place
                .then(response => {
                    console.log(response);
                })
        }
    }
})

