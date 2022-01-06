let j = 1
addCategory.addEventListener("click", () => {
    const category = document.querySelector(".categoryCol1")
    const mainRow = document.querySelector(".formRow")
    let createdCategory = category.cloneNode(true)
    createdCategory.classList.remove("categoryCol1")
    j++
    createdCategory.classList.add("categoryCol" + j)
    const div = createdCategory.querySelector(".presta1")
    let numberOfCreatedDiv = createdCategory.querySelectorAll("[class*=presta]")
    let createdi = numberOfCreatedDiv.length
    div.querySelector(".showInput").addEventListener("click", () => {
        const buttonContainer = div.querySelector(".buttonContainer")
        buttonContainer.classList.remove("hiddenInput")
    })
    div.querySelector(".hideInput").addEventListener("click", () => {
        const buttonContainer = div.querySelector(".buttonContainer")
        buttonContainer.classList.add("hiddenInput")
    })
createdCategory.querySelector(".addPresta").addEventListener("click", () => {
    const serviceDiv = createdCategory.querySelector(".services")
    if(createdi < 5){
    createdi++
    let createdDiv = div.cloneNode(true)
    createdDiv.classList.remove("presta1")
    createdDiv.classList.add("presta" + createdi)
    createdDiv.querySelector(".showInput").addEventListener("click", () => {
        const buttonContainer = createdDiv.querySelector(".buttonContainer")
        buttonContainer.classList.remove("hiddenInput")
    })
    createdDiv.querySelector(".hideInput").addEventListener("click", () => {
        const buttonContainer = createdDiv.querySelector(".buttonContainer")
        buttonContainer.classList.add("hiddenInput")
    })
    serviceDiv.append(createdDiv)
    } else {
        alert("Vous pouvez créer un maximum de 5 services par catégorie.")
    }
})
createdCategory.querySelector(".deletePresta").addEventListener("click", () => {
    if(createdi > 1){
    const lastCreatedDiv = createdCategory.querySelector(".presta" + createdi)
    const serviceDiv = createdCategory.querySelector(".services")
    serviceDiv.removeChild(lastCreatedDiv)
    createdi--
    } else {
        alert("Vous ne pouvez pas supprimer le dernier service.")
    }
})
    mainRow.append(createdCategory)
})

deleteCategory.addEventListener("click", () => {
    if(j > 1){
        const lastCreatedCategory = document.querySelector(".categoryCol" + j)
        const mainRow = document.querySelector(".formRow")
        mainRow.removeChild(lastCreatedCategory)
        j--
    } else {
        alert("Vous ne pouvez pas supprimer la première catégorie.")
    }
})