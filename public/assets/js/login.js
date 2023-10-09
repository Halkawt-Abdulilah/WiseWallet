let signupButton = document.getElementById("login-button");

signupButton.addEventListener("click", async (evt) => {
    evt.preventDefault();

    let form = document.querySelector("#login-form");
    let formData = new FormData(form);
    try {
        let response = await fetch('http://localhost/iminstance/login', {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        let errorData = await response.json();
        console.log(errorData);
        if (errorData.length === 0) {
            displaySuccessMessage();
            window.location.href = 'http://localhost/iminstance/';
        } else {
            console.log(errorData);
            // Clear all previous errors
            let errorSpans = form.querySelectorAll("span[id$='-error-msg']");
            errorSpans.forEach((span) => {
                span.textContent = "";
            });
            // Iterate over each error in the response and update the corresponding <span> element
            Object.keys(errorData).forEach((key) => {
                let errorSpan = form.querySelector(`#login-${key}-error-msg`);
                if (errorSpan) {
                    errorSpan.textContent = errorData[key];
                }
            });
        }
    } catch (err) {
        console.log("Fetch Error: " + err);
    }
})

function displaySuccessMessage() {
    const successMessage = document.querySelector('.success-message');
    successMessage.style.display = 'block';
    successMessage.style.animation = 'fade-in 0.5s ease-out forwards';

    // Hide the success message after 3 seconds
    setTimeout(() => {
        successMessage.style.animation = 'fade-out 0.5s ease-out forwards';
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 500);
    }, 3000);
}