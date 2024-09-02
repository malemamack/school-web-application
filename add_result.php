<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$learner_id = $_POST['learner_id'];
$subject_id = $_POST['subject_id'];
$grade = $_POST['grade'];
$term = $_POST['term'];
$year = $_POST['year'];

$sql = "INSERT INTO Progress_Report (learner_id, subject_id, grade, term, year) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss", $learner_id, $subject_id, $grade, $term, $year);
$stmt->execute();

echo "Result added successfully.";

$stmt->close();
$conn->close();
?>
