const searchRegex = /^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'!._\s-]{2,50}$/

searchButton.addEventListener("click", () => {
    if (searchRegex.test(search.value)) {
        const formData = new FormData()
        formData.append('search', search.value)
        // autre façon de faire de l'ajax
        fetch("./controller/searchController.php", { method: 'POST', body: formData })
            .then(response => response.json()) // si je recois du json je met .json() a la place
            .then(response => {
                noSearchRow.remove()
                if(response.length > 0){
                response.forEach(element => {
                    console.log(element.title)
                    newHtml = `<div class="row justify-content-center" id="noSearchRow">
                        <div class="col-8 searchCol">
                            <div class="searchResult">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="../espaceClient/partners/${element.partnerEmail}/category/categoryPhoto${element.id}" alt="Photo du service ${element.title}">
                                    </div>
                                    <div class="col-6 serviceDescriptionCol">
                                        <h3>${element.partnerName}</h3>
                                        <p>${element.title}</p>
                                        <p>A partir de ${element.serviceLowestPrice}€</p>
                                        <p>Situé à ${element.cityName}</p>
                                        <a class="btn btn-outline-light customerAccountButton" href="servicePage.php?serviceId=${element.id}">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>`
                headerRow.insertAdjacentHTML('afterend', newHtml)
                })
            } else {
                newHtml = `<div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>Oups, aucun résultat ne correspond à votre recherche ! veuillez revenir au menu précédent :</p>
                        <a class="btn customerAccountButton btn-outline-light" href="activities.php">Retour</a>
                    </div>
                </div>
            </div>`
            headerRow.insertAdjacentHTML('afterend', newHtml)
            }
            })
    }
})