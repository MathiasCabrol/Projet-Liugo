document.addEventListener("click", event => {
    // Si l'utilisateur clique sur le bouton non, cacher les informations du bouton
    if(event.target.matches("#buttonNo")){
        buttonInfos.style.display = "none";
    }
    // Si l'utilisateur clique sur le bouton oui, afficher les informations du bouton
    if(event.target.matches("#buttonYes")){
        buttonInfos.style.display = "block";
    }
})

//Lors du rechargement de la page, cocher par défaut la case oui
window.addEventListener('load', () => {
    buttonYes.checked = true;
  });