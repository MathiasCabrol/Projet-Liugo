let numberOfServices = 1
document.addEventListener("click", event => {
    let textToAppend
    if (event.target.matches(".addPresta") && numberOfServices >= 5) {
        return alert("Vous pouvez ajouter un maximum de 5 services")
    }
    if (event.target.matches(".addPresta")) {
        textToAppend = `<div class="presta">
        <div class="row justify-content-center">
            <div class="col-10 text-center mt-2 innerExampleCol">
                <input type="text" name="serviceName[]" class="mt-2" placeholder="Nom du service">
                <input type="text" name="serviceHour[]" class="mt-2" placeholder="horaires">
                <input type="text" name="servicePrice[]" class="mt-2" placeholder="tarifs">
                <p class="mt-2 radioQuestion">Souhaitez-vous ajouter un bouton ?</p>
                <input class="my-2 showInput" type="radio" name="buttonQuestion${numberOfServices}-${j}" value="1"><span>Oui</span>
                <input class="my-2 hideInput" type="radio" name="buttonQuestion${numberOfServices}-${j}" value="0"><span>Non</span>
                <div class="buttonContainer hiddenInput">
                    <input type="text" name="buttonName[]" placeholder="nom du bouton" class="mt-2">
                    <label>Fichier à télécharger au clic</label>
                    <input type="file" name="buttonFile[]" class="my-2">
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


