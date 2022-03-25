let numberOfServices = 1
document.addEventListener("click", event => {
    let textToAppend
    //Si le client souhaite ajouter une prestation mais qu'elles sont déja au nombre de 5
    if (event.target.matches(".addPresta") && numberOfServices >= 5) {
        //renvoyer un message d'erreur
        //TODO Créer un message toast
        return alert("Vous pouvez ajouter un maximum de 5 services")
    }
    //Si le client souhaite ajouter une prestation
    if (event.target.matches(".addPresta")) {
        //Nouvelle prestation à insérer
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
        //Récupération du noeud de la div des services
        serviceDiv = event.target.parentElement.querySelector(".services")
        //Insertiond e la nouvelle prestation avant la fermeture de la balise
        serviceDiv.insertAdjacentHTML('beforeend', textToAppend)
        //Mise à jour du nombre de services
        numberOfServices = event.target.parentElement.querySelectorAll("div[class=presta]").length
        //Sortie de la fonction
        return
    }

    //Si l'utilisateur souhaite supprimer un service et qu'il en existe un
    if (event.target.matches(".redCrossButton") && numberOfServices == 1) {
        //Le client ne peux pas supprimer le denrier service
        return alert("Vous ne pouvez pas supprimer le premier service")
    }
    //Si les services sont plus nombreux que un
    if (event.target.matches(".redCrossButton")) {
        //Récupération de la div à supprimer
        let elementToRemove = event.target.closest("[class=presta]")
        //Suppresion de l'élément
        elementToRemove.remove()
        //Récupération de toutes les divs portant le même nom de classe
        let prestaDivs = document.querySelectorAll("div[class=presta]")
        for (let i = 0; i < prestaDivs.length; i++) {
            //Modification du nom des boutons radio pour qu'ils correspondent au nombre de la div
            let divsRadio = prestaDivs[i].querySelectorAll("input[type=radio]")
            divsRadio.forEach(element => {
                let nameToChange = element.name
                let replacedName = nameToChange.slice(0, -1) + i;
                element.name = replacedName
            })
        }
        //Mise à jour du nombre de services
        numberOfServices = document.querySelectorAll("div[class=presta]").length
        return
    }


})