showExample.addEventListener("click", () => {
    const col = document.querySelector(".exampleCol")
    if(col.classList.contains('hiddenCol') == true){
        col.classList.remove('hiddenCol')
    } else {
        col.classList.add('hiddenCol')
    }
})