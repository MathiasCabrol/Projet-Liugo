let i = 1
document.querySelector(".addPresta").addEventListener("click", () => {
    const div = document.querySelector(".presta1")
    const serviceDiv = document.querySelector(".services")
    if(i < 5){
    i++
    let createdDiv = div.cloneNode(true)
    createdDiv.classList.remove("presta1")
    createdDiv.classList.add("presta" + i)
    createdDiv.querySelector(".showInput").setAttribute('name', 'buttonQuestion' + i)
    createdDiv.querySelector(".showInput").addEventListener("click", () => {
        const buttonContainer = createdDiv.querySelector(".buttonContainer")
        buttonContainer.classList.remove("hiddenInput")
    })
    createdDiv.querySelector(".hideInput").setAttribute('name', 'buttonQuestion' + i)
    createdDiv.querySelector(".hideInput").addEventListener("click", () => {
        const buttonContainer = createdDiv.querySelector(".buttonContainer")
        buttonContainer.classList.add("hiddenInput")
    })
    serviceDiv.append(createdDiv)
    } else {
        alert("Vous pouvez créer un maximum de 5 services par catégorie.")
    }
})
document.querySelector(".deletePresta").addEventListener("click", () => {
    if(i > 1){
    const lastCreatedDiv = document.querySelector(".presta" + i)
    const serviceDiv = document.querySelector(".services")
    serviceDiv.removeChild(lastCreatedDiv)
    i--
    } else {
        alert("Vous ne pouvez pas supprimer le dernier service.")
    }
})

