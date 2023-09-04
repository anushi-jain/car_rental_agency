<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'car_rental_sys');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("insert into user(username, email, password) values(?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $execval = $stmt->execute();
        if ($execval) {
            echo "Registration successfully...";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Invalid request method. Please submit the form.";
}
?>