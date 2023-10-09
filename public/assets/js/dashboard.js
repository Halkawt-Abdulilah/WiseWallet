let withdrawSavingsButton = document.getElementById("withdrawSavingsButton");
let depositSavingsButton = document.getElementById("depositSavingsButton");

let accountSavings = document.getElementById("accountSavings");
let accountBalance = document.getElementById("accountBalance");

withdrawSavingsButton.addEventListener("click", async (evt) => {
    evt.preventDefault();

    let form = document.querySelector("#savingsForm");
    let formData = new FormData(form);
    console.log(formData);
    let withdrawAmount = formData.get('savingAmount');
    try {
        let response = await fetch('http://localhost/iminstance/dashboard/withdraw', {
            method: "POST",
            body: formData,
        });

        let decoded = await response.json();

        if (decoded['status'] == 'success') {
            let newSavings = (accountSavings.innerHTML).replace(" IQD", "");
            newSavings = parseInt(newSavings.replace(/,/g, "")) - withdrawAmount;
            accountSavings.innerHTML = newSavings.toLocaleString() + " IQD";

            let newBalance = (accountBalance.innerHTML).replace(" IQD", "");
            newBalance = parseInt(newBalance.replace(/,/g, "")) + parseInt(withdrawAmount);
            accountBalance.innerHTML = newBalance.toLocaleString() + " IQD";

        }

    } catch (err) {
        console.log("Fetch Error: " + err);
    }
});

depositSavingsButton.addEventListener("click", async (evt) => {
    evt.preventDefault();

    let form = document.querySelector("#savingsForm");
    let formData = new FormData(form);
    console.log(formData);
    let depositAmount = formData.get('savingAmount');
    try {
        let response = await fetch('http://localhost/iminstance/dashboard/deposit', {
            method: "POST",
            body: formData,
        });

        let decoded = await response.json();
        if (decoded['status'] == 'success') {
            let newSavings = (accountSavings.innerHTML).replace(" IQD", "");
            newSavings = parseInt(newSavings.replace(/,/g, "")) + parseInt(depositAmount);
            accountSavings.innerHTML = newSavings.toLocaleString() + " IQD";

            let newBalance = (accountBalance.innerHTML).replace(" IQD", "");
            newBalance = parseInt(newBalance.replace(/,/g, "")) - depositAmount;
            accountBalance.innerHTML = newBalance.toLocaleString() + " IQD";
        }

    } catch (err) {
        console.log("Fetch Error: " + err);
    }
});