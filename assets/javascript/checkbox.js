document.querySelector(".showInput").addEventListener("click", () => {
    const buttonContainer = document.querySelector(".buttonContainer")
    buttonContainer.classList.remove("hiddenInput")
})
document.querySelector(".hideInput").addEventListener("click", () => {
    const buttonContainer = document.querySelector(".buttonContainer")
    buttonContainer.classList.add("hiddenInput")
})