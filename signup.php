<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if (isset($_POST['first_name'], $_POST['last_name'], $_POST['contact_information'], $_POST['address'], $_POST['email'], $_POST['password'])) {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_information = $_POST['contact_information'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $sql = "INSERT INTO Parents (first_name, last_name, contact_information, address, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $first_name, $last_name, $contact_information, $address, $email, $password);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to login page
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: Form data is missing.";
}

// Close the database connection
$conn->close();
?>
