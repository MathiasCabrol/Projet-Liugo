const searchRegex = /^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'!._\s-]{2,50}$/

searchButton.addEventListener("click", () => {
    if (searchRegex.test(search.value)) {
        const formData = new FormData()
        formData.append('search', search.value)
        // autre façon de faire de l'ajax
        fetch("./controller/searchController.php", { method: 'POST', body: formData })
            .then(response => response.text()) // si je recois du json je met .json() a la place
            .then(response => {
                console.log(response)
            })
    }
})