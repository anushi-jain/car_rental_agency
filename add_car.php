<?php
// Create a connection to the MySQL database
$mysqli = new mysqli('localhost','root','','car_rental_sys');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleModel = $_POST["vehicleModel"];
    $vehicleNumber = $_POST["vehicleNumber"];
    $seatingCapacity = $_POST["seatingCapacity"];
    $rentPerDay = $_POST["rentPerDay"];
    
    // Check if the car already exists in the database (for edit operation)
    if (isset($_POST["carId"])) {
        $carId = $_POST["carId"];
        $sql = "UPDATE cars SET vehicleModel=?, vehicleNumber=?, seatingCapacity=?, rentPerDay=? WHERE id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssiii", $vehicleModel, $vehicleNumber, $seatingCapacity, $rentPerDay, $carId);
    } else { // Insert new car (for add operation)
        $sql = "INSERT INTO cars (vehicleModel, vehicleNumber, seatingCapacity, rentPerDay) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssii", $vehicleModel, $vehicleNumber, $seatingCapacity, $rentPerDay);
    }

    if ($stmt->execute()) {
        $message = "Car operation successful.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Management</title>
</head>
<body>
    <h1>Car Management</h1>
    <a href="add_new_car.html">Go back to add/edit page</a>
    <p><?php echo $message; ?></p>
</body>
</html>
