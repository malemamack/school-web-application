<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$date_of_birth = $_POST['date_of_birth'];
$grade = $_POST['grade'];
$parent_id = $_POST['parent_id'];

$sql = "INSERT INTO Learners (first_name, last_name, date_of_birth, grade, parent_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $first_name, $last_name, $date_of_birth, $grade, $parent_id);
$stmt->execute();

echo "Learner added successfully.";

$stmt->close();
$conn->close();
?>
