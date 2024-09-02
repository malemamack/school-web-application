<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM Parents WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();
$parent = $result->fetch_assoc();

if ($parent && password_verify($password, $parent['password'])) {
    $_SESSION['parent_id'] = $parent['parent_id'];
    header("Location: profile.php");
} else {
    echo "Invalid login credentials.";
}

$stmt->close();
$conn->close();
?>
s