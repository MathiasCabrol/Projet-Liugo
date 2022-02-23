let numberOfServices = 1
document.addEventListener("click", event => {
    let textToAppend
    if (event.target.matches(".addPresta") && numberOfServices >= 5) {
        return alert("Vous pouvez ajouter un maximum de 5 services")
    }
    if (event.target.matches(".addPresta")) {
        parentList = event.target.parentElement.classList[3]
        textToAppend = `<div class="presta">
        <div class="row justify-content-center">
            <div class="col-10 text-center mt-4 innerExampleCol">
            <button type="button" class="redCrossButton btn btn-outline-light deletePresta my-4">x</button>
                <input type="text" name="serviceName[]" class="mt-2" placeholder="Nom du service">
                <label for="serviceStartingHour">Heure de début</label>
                <input type="time" name="serviceStartingHour[]" class="mt-2" placeholder="heure de début">
                <input type="number" name="servicePrice[]" class="mt-2" placeholder="tarifs">
                <label for="serviceEndingHour">Heure de fin</label>
                <input type="time" name="serviceEndingHour[]" class="mt-2" placeholder="heure de fin">
                <p class="mt-2 radioQuestion">Souhaitez-vous ajouter un bouton ?</p>
                <input class="my-2 showInput" type="radio" name="buttonQuestion${numberOfServices}" value="1"><span>Oui</span>
                <input class="my-2 hideInput" type="radio" name="buttonQuestion${numberOfServices}" checked="checked" value="0"><span>Non</span>
                <div class="buttonContainer hiddenInput">
                    <input type="text" name="buttonName[]" placeholder="nom du bouton" class="mt-2">
                    <label>Fichier à télécharger au clic</label>
                    <input type="file" name="buttonFile[]" class="my-2">
                </div>
            </div>
        </div>`
        serviceDiv = event.target.parentElement.querySelector(".services")
        serviceDiv.insertAdjacentHTML('beforeend', textToAppend)
        numberOfServices = event.target.parentElement.querySelectorAll("div[class=presta]").length
        return
    }
    if (event.target.matches(".redCrossButton") && numberOfServices == 1) {
        return alert("Vous ne pouvez pas supprimer le premier service")
    }
    if (event.target.matches(".redCrossButton")) {
        let elementToRemove = event.target.closest("[class=presta]")
        elementToRemove.remove()
        let prestaDivs = document.querySelectorAll("div[class=presta]")
        for (let i = 0; i < prestaDivs.length; i++) {
            let divsRadio = prestaDivs[i].querySelectorAll("input[type=radio]")
            divsRadio.forEach(element => {
                let nameToChange = element.name
                let replacedName = nameToChange.slice(0, -1) + i;
                element.name = replacedName
            })
        }
        numberOfServices = document.querySelectorAll("div[class=presta]").length
        return
    }


})