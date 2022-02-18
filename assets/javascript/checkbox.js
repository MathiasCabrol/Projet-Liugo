document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener("click", event => {
        if (event.target.matches(".showInput")) {
            inputName = event.target.name
            selectedInput = document.getElementsByName(inputName)[0]
            closestContainer = selectedInput.closest("div").querySelector(".buttonContainer")
            closestContainer.classList.remove("hiddenInput")
        }
        if (event.target.matches(".hideInput")) {
            inputName = event.target.name
            selectedInput = document.getElementsByName(inputName)[0]
            closestContainer = selectedInput.closest(`div`).querySelector('.buttonContainer')
            closestContainer.classList.add("hiddenInput")
        }
    })
})