<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute the SQL statement
$sql = "SELECT * FROM Parents WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows were returned
if ($row = $result->fetch_assoc()) {
    $user_pass = $row['password'];
    
    // Debugging: Output hashed password for verification (Remove this in production)
    // echo "Hashed Password from DB: " . htmlspecialchars($user_pass) . "<br>";
    
    // Verify the password
    if ($password && $user_pass) {
        // Log in the user
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['parent_id'] = $row['id']; // Ensure this key is used consistently
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['email'];
        
        // Redirect to profile page
        header("Location:profile.php?parent_id=" . urlencode($_SESSION['parent_id']));
        exit();
    } else {
        // Incorrect password
        echo "Invalid credentialsxxxx.";
    }
} else {
    // No user found
    echo "Invalid credentials.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
