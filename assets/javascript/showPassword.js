showPassword.addEventListener("click", () => {
    if(passwordInput.type == "password"){
        passwordInput.type = "text"
        showPassword.className = "fa-solid fa-eye-slash"
    } else {
        passwordInput.type = "password"
        showPassword.className = "fa-solid fa-eye"
    }
})

