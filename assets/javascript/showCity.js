postCodeInput.addEventListener("input", () => {

    console.log(postCodeInput.value.length)

    if (postCodeInput.value.length == 5) {

        if (postCodeRegex.test(postCodeInput.value)) {
            const formData = new FormData();
            formData.append("postCode", postCodeInput.value);
            // formData.append("name","value");

            // autre façon de faire de l'ajax
            fetch("./controller/FinalSubscriptionVerif.php", { method: 'POST', body: formData })
                .then(response => response.text()) // si je recois du json je met .json() a la place
                .then(response => console.log(response))
            
        }
    }
})