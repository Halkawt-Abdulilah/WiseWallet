let addIncomeButton = document.getElementById("addIncomeButton");
let updateIncomeButton = document.getElementById("updateIncomeButton");
let deleteIncomeConfirmButton = document.getElementById("deleteIncomeConfirmButton");
let incomeTableBody = document.getElementById("incomeTableBody");

addIncomeButton.addEventListener("click", async (evt) => {
    evt.preventDefault();

    let form = document.querySelector("#addIncomeForm");
    let formData = new FormData(form);
    console.log(formData);
    try {
        let response = await fetch('http://localhost/iminstance/income/add', {
            method: "POST",
            body: formData,
        });

        let data = await response.json();

        console.log(data);
        let newRow = incomeTableBody.insertRow();
        newRow.innerHTML = `<tr>
                <td class="hid">${data.id}</td>
                <td>${data.name}</td>
                <td>${data.amount} IQD</td>
                <td>${data.date}</td>
                <td>${data.note}</td>
                <td>
                <button type="button" class="btn btn-primary updateIncomeButton" data-bs-toggle="modal" data-bs-target="#updateIncomeModal">Update</button>
                <button class="btn btn-danger deleteIncomeButton"><a class="text-light text-decoration-none" data-bs-toggle="modal" data-bs-target="#deleteIncomeModal">Delete</a></button>
                </td>
                </tr>
            `;

        attachDeleteButtonHandlers();
        attachUpdateButtonHandlers();


    } catch (err) {
        console.log("Fetch Error: " + err);
    }
});

updateIncomeButton.addEventListener("click", async (evt) => {
    evt.preventDefault();
    let form = document.querySelector("#updateIncomeForm");
    let formData = new FormData(form);
    console.log(formData);
    try {
        let response = await fetch('http://localhost/iminstance/income/update', {
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
    const deleteButtons = document.querySelectorAll(".deleteIncomeButton");

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
                        "http://localhost/iminstance/income/delete",
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
const updateModal = document.querySelector('#updateIncomeModal');

function attachUpdateButtonHandlers() {
    const updateButtons = document.querySelectorAll(".updateIncomeButton");

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
            updateModal.querySelector("#incomeIdInput").value = id;
            updateModal.querySelector("#incomeNameInput").value = name;
            updateModal.querySelector("#incomeAmountInput").value = amount;
            updateModal.querySelector("#incomeDateInput").value = date;
            updateModal.querySelector("#incomeNoteInput").value = notes;

            // Save the ID of the income to update in a data attribute on the Update button in the modal
            const updateButtonInModal = updateModal.querySelector(
                "#updateIncomeButton"
            );
            updateButtonInModal.setAttribute("data-income-id", id);
        });
    });
}

attachDeleteButtonHandlers();
attachUpdateButtonHandlers();
