//Mise en place des éléments de départ
const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = dropArea.querySelector("input");
let file; //Variable globale que nous allons utiliser dans les fonctions
button.onclick = ()=>{
  input.click(); //Si l'utilisateur clique dans la zone alors l'input est également cliqué
}
input.addEventListener("change", function(){
  //Récupération uniquement du premier fichier inséré par l'utilisateur
  file = this.files[0];
  dropArea.classList.add("active");
  //Appel de la fonction
  showFile(); 
});
//Si l'utilisateur glisse le fichier au-dessus de la zone
dropArea.addEventListener("dragover", (event)=>{
  //Prévention de comportement par défaut
  event.preventDefault(); 
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
});
//Si l'utilisateur enlève le fichier de la zone
dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
});
//Si l'utilisateur glisse le fichier dans la zone
dropArea.addEventListener("drop", (event)=>{
  //Prévention de comportement par défaut
  event.preventDefault(); 
  //Si il y a pluiseurs fichiers on séléctionne uniquepment le premier
  file = event.dataTransfer.files[0];
  //Appel de la fonction
  showFile(); 
});
function showFile(){
  //Récupération du type de fichier
  let fileType = file.type; 
  //Tableau d'extensions valide
  let validExtensions = ["image/jpeg", "image/jpg", "image/png", "application/pdf"]; 
  //Condition qui se déclenche uniqueent si le format du fichier est valide
  if(validExtensions.includes(fileType)){ 
    //Création d'un objet FileReader
    let fileReader = new FileReader();
    fileReader.onload = ()=>{
      //Fichier inséré passé dans la variable fileURL
      let fileURL = fileReader.result;
      //Insertion de l'image dans la zone drag&drop
        let imgTag = `<img src="${fileURL}" alt="fichier Téléchargé">`; 
      dropArea.innerHTML = imgTag; 
    }
    fileReader.readAsDataURL(file);
  }else{
    alert("Ce n'est pas un fichier valide, merci de télécharger une image ou un fichier PDF.");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}