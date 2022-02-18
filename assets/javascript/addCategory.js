let j = 1
document.addEventListener("click", event => {
    let textToAppend
    if (event.target.id == "addCategory" && j >= 4) {
        return alert("Vous pouvez ajouter un maximum de 4 catégories")
    }
    if(event.target.id == "addCategory") {
        j++
        textToAppend = `<div class="col-12 col-md-5 text-center categoryCol${j} formCol mt-5 mx-3">
        <input type="text" name="serviceTitle${j}[]" placeholder="Restauration" class="mt-5">
        <div class="drop-zone mt-5">
            <span class="drop-zone__prompt text-black">Photo du service</span>
            <input type="file" name="servicePhoto${j}[]" class="drop-zone__input">
        </div>
        <!-- Div services à laquelle sont append les éléments crées dans le DOM en JS -->
        <div class="services">
            <!-- Div clonée dans le JS -->
            <div class="presta1">
                <div class="row justify-content-center">
                    <div class="col-10 text-center mt-2 innerExampleCol">
                        <input type="text" name="serviceName${j}[]" class="mt-2" placeholder="Nom du service">
                        <input type="text" name="serviceHour${j}[]" class="mt-2" placeholder="horaires">
                        <input type="text" name="servicePrice${j}[]" class="mt-2" placeholder="tarifs">
                        <p class="mt-2 radioQuestion">Souhaitez-vous ajouter un bouton ?</p>
                        <input class="my-2 showInput" type="radio" name="buttonQuestion1-${j}" value="1"><span>Oui</span>
                        <input class="my-2 hideInput" type="radio" name="buttonQuestion1-${j}" value="0"><span>Non</span>
                        <div class="buttonContainer hiddenInput">
                            <input type="text" name="buttonName${j}[]" placeholder="nom du bouton" class="mt-2">
                            <label>Fichier à télécharger au clic</label>
                            <input type="file" name="buttonFile${j}[]" class="my-2">
                        </div>
                    </div>
                </div>
                <!-- Closing the "presta" div for JS use -->
            </div>
            <!-- CLosing services div -->
        </div>
        <button type="button" class="exampleButton btn btn-outline-light addPresta my-4">Ajouter une prestation</button>
        <button type="button" class="deleteButton btn btn-outline-light deletePresta my-4">Supprimer la dernière prestation</button>
    </div>`
        previousCategoryCol = document.querySelector(".categoryCol" + (j - 1))
        previousCategoryCol.insertAdjacentHTML('afterend', textToAppend)
        return
    }
    if (event.target.id == "deleteCategory" && j == 1) {
        return alert("Vous ne pouvez pas supprimer la première catégorie")
    }
    if (event.target.id == "deleteCategory") {
        numberOfCategories = document.querySelectorAll("div[class*=categoryCol]")
        console.log(numberOfCategories)
        ElementToRemove = document.querySelector(".categoryCol" + j)
        ElementToRemove.remove()
         j-- 
         return 
    }
})