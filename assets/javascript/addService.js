//Création de l'incrément
let i = 1
//Se déclenche au clic sur le bouton "ajouter prestation"
document.querySelector(".addPresta").addEventListener("click", () => {
    const div = document.querySelector(".presta1")
    const serviceDiv = document.querySelector(".services")
    //Limite de 5 prestations par catégorie
    if(i < 5){
    i++
    //Si la limite n'est pas dépassée, cloner la div
    let createdDiv = div.cloneNode(true)
    //Changement de la classe pour qu'elle corresponde à la nouvelle catégorie
    createdDiv.classList.remove("presta1")
    createdDiv.classList.add("presta" + i)
    //Modification de l'attribut name pour qu'il corresponde à la prestation
    createdDiv.querySelector(".showInput").setAttribute('name', 'buttonQuestion' + i)
    //Affiche le formulaire l'input du bouton au clic sur "oui"
    createdDiv.querySelector(".showInput").addEventListener("click", () => {
        const buttonContainer = createdDiv.querySelector(".buttonContainer")
        buttonContainer.classList.remove("hiddenInput")
    })
    //Cache l'input du bouton au clic sur "non"
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
//Suprime la dernière prestation ajoutée
document.querySelector(".deletePresta").addEventListener("click", () => {
    //Minimum de une prestation par catégorie
    if(i > 1){
    const lastCreatedDiv = document.querySelector(".presta" + i)
    const serviceDiv = document.querySelector(".services")
    serviceDiv.removeChild(lastCreatedDiv)
    i--
    } else {
        alert("Vous ne pouvez pas supprimer le dernier service.")
    }
})

