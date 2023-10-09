let addExpenseButton = document.getElementById("addExpenseButton");
let updateExpenseButton = document.getElementById("updateExpenseButton");
let deleteExpenseConfirmButton = document.getElementById("deleteExpenseConfirmButton");
let expenseTableBody = document.getElementById("expenseTableBody");

addExpenseButton.addEventListener("click", async (evt) => {
    evt.preventDefault();

    let form = document.querySelector("#addExpenseForm");
    let formData = new FormData(form);
    console.log(formData);
    try {
        let response = await fetch('http://localhost/iminstance/expense/add', {
            method: "POST",
            body: formData,
        });

        let data = await response.json();

        console.log(data);
        let newRow = expenseTableBody.insertRow();
        newRow.innerHTML = `<tr>
                <td class="hid">${data.id}</td>
                <td>${data.name}</td>
                <td>${data.amount} IQD</td>
                <td>${data.date}</td>
                <td>${data.note}</td>
                <td>
                <button type="button" class="btn btn-primary updateExpenseButton" data-bs-toggle="modal" data-bs-target="#updateExpenseModal">Update</button>
                <button class="btn btn-danger deleteExpenseButton"><a class="text-light text-decoration-none" data-bs-toggle="modal" data-bs-target="#deleteExpenseModal">Delete</a></button>
                </td>
                </tr>
            `;

        attachDeleteButtonHandlers();
        attachUpdateButtonHandlers();


    } catch (err) {
        console.log("Fetch Error: " + err);
    }
});

updateExpenseButton.addEventListener("click", async (evt) => {
    evt.preventDefault();
    let form = document.querySelector("#updateExpenseForm");
    let formData = new FormData(form);
    console.log(formData);
    try {
        let response = await fetch('http://localhost/iminstance/expense/update', {
            method: "POST",
            body: formData,
        });

        let data = await response.json();
        if (data['status'] == "success") {
            console.log("removed successfully");
        }

    } catch (err) {
        console.log("Fetch Error: " + err);
    }
});


function attachDeleteButtonHandlers() {
    const deleteButtons = document.querySelectorAll(".deleteExpenseButton");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", async (event) => {
            try {
                const rowElement = event.target.closest("tr");
                const cells = rowElement.querySelectorAll("td");
                const rowData = Array.from(cells).map((cell) =>
                    cell.textContent.trim()
                );
                console.log(rowData);

                let form = new FormData();
                form.append("id", rowData[0]);

                try {
                    let response = await fetch(
                        "http://localhost/iminstance/expense/delete",
                        {
                            method: "POST",
                            body: form,
                        }
                    );

                    let data = await response.json();
                    if (data["status"] == "success") {
                        console.log("removed successfully");
                        rowElement.parentNode.removeChild(rowElement); // Remove the table row from the DOM
                    }
                } catch (err) {
                    console.log("Fetch Error: " + err);
                }
            } catch (error) {
                console.error(error);
            }
        });
    });
}

attachDeleteButtonHandlers();

// Get a reference to the update modal
const updateModal = document.querySelector('#updateExpenseModal');

function attachUpdateButtonHandlers() {
    const updateButtons = document.querySelectorAll(".updateExpenseButton");

    updateButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Get the values from the table row
            const row = this.closest("tr");
            const id = row.querySelector(".hid").textContent;
            const name = row.querySelectorAll("td")[1].textContent;
            const amount = row.querySelectorAll("td")[2].textContent;
            const date = row.querySelectorAll("td")[3].textContent;
            const notes = row.querySelectorAll("td")[4].textContent;

            // Set the values of the input fields in the update modal
            updateModal.querySelector("#expenseIdInput").value = id;
            updateModal.querySelector("#expenseNameInput").value = name;
            updateModal.querySelector("#expenseAmountInput").value = amount;
            updateModal.querySelector("#expenseDateInput").value = date;
            updateModal.querySelector("#expenseNoteInput").value = notes;

            // Save the ID of the expense to update in a data attribute on the Update button in the modal
            const updateButtonInModal = updateModal.querySelector(
                "#updateExpenseButton"
            );
            updateButtonInModal.setAttribute("data-expense-id", id);
        });
    });
}

attachDeleteButtonHandlers();
attachUpdateButtonHandlers();
