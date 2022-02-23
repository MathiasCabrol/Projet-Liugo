let numberOfServices = 1
document.addEventListener("click", event => {
    let textToAppend
    if (event.target.matches(".addPresta") && numberOfServices >= 5) {
        return alert("Vous pouvez ajouter un maximum de 5 services")
    }
    if (event.target.matches(".addPresta")) {
        radioButtonNumber = event.target.parentElement.querySelectorAll("div[class^=presta]").length + 1
        parentList = event.target.parentElement.classList[3]
        parentColNumber = parentList.slice(11, 12)
        parentColNumber
        textToAppend = `<div class="presta">
        <div class="row justify-content-center">
            <div class="col-10 text-center mt-2 innerExampleCol">
                <input type="text" name="serviceName${parentColNumber}[]" class="mt-2" placeholder="Nom du service">
                <label for="serviceStartingHour${parentColNumber}">Heure de début</label>
                <input type="time" name="serviceStartingHour${parentColNumber}[]" class="mt-2" placeholder="heure de début">
                <input type="number" name="servicePrice1[]" class="mt-2" placeholder="tarifs">
                <label for="serviceEndingHour${parentColNumber}">Heure de fin</label>
                <input type="time" name="serviceEndingHour${parentColNumber}[]" class="mt-2" placeholder="heure de fin">
                <p class="mt-2 radioQuestion">Souhaitez-vous ajouter un bouton ?</p>
                <input class="my-2 showInput" type="radio" name="buttonQuestion${radioButtonNumber}-${parentColNumber}" value="1"><span>Oui</span>
                <input class="my-2 hideInput" type="radio" name="buttonQuestion${radioButtonNumber}-${parentColNumber}" checked="checked" value="0"><span>Non</span>
                <div class="buttonContainer hiddenInput">
                    <input type="text" name="buttonName${parentColNumber}[]" placeholder="nom du bouton" class="mt-2">
                    <label>Fichier à télécharger au clic</label>
                    <input type="file" name="buttonFile${parentColNumber}[]" class="my-2">
                </div>
            </div>
        </div>`
        serviceDiv = event.target.parentElement.querySelector(".services")
        serviceDiv.insertAdjacentHTML('beforeend', textToAppend)
        numberOfServices = event.target.parentElement.querySelectorAll("div[class^=presta]").length
        return
    }
    if (event.target.matches(".deletePresta") && numberOfServices == 1) {
        return alert("Vous ne pouvez pas supprimer le premier service")
    }
    if (event.target.matches(".deletePresta")) {
        ElementToRemove = event.target.parentElement.querySelector("[class^=presta]:last-child")
        ElementToRemove.remove()
        numberOfServices = event.target.parentElement.querySelectorAll("div[class^=presta]").length
        return
    }


})


