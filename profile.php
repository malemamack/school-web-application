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

$parent_id = $_SESSION['parent_id'];

$sql = "SELECT * FROM Learners WHERE parent_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $parent_id);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    echo "Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
    echo "Grade: " . $row["grade"] . "<br>";
    echo "Date of Birth: " . $row["date_of_birth"] . "<br><br>";
}

$stmt->close();
$conn->close();
?>
