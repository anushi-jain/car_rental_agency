document.addEventListener("DOMContentLoaded", function () {
    const addCarForm = document.getElementById("addCarForm");
    const editCarForm = document.getElementById("editCarForm");
    const feedback = document.getElementById("feedback");

    addCarForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get values from form fields
        const vehicleModel = document.getElementById("vehicleModel").value;
        const vehicleNumber = document.getElementById("vehicleNumber").value;
        const seatingCapacity = document.getElementById("seatingCapacity").value;
        const rentPerDay = document.getElementById("rentPerDay").value;

        // You can perform validation checks here

        // Assuming you have an API endpoint for adding cars, make an AJAX request here to add the car to the database

        // Display a success message
        feedback.innerHTML = "Car added successfully!";
        feedback.style.color = "green";

        // Clear the form
        addCarForm.reset();
    });
});
