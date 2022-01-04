addPresta.addEventListener("click", () => {
    const div = document.querySelector(".presta")
    let createdDiv = div.cloneNode(true)
    div.classList.remove("presta")
    div.append(createdDiv)
})