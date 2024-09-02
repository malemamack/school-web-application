<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$report_id = $_POST['report_id'];
$teacher_id = $_POST['teacher_id'];
$comment_text = $_POST['comment_text'];
$date = date('Y-m-d');

$sql = "INSERT INTO Comments (report_id, teacher_id, comment_text, date) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $report_id, $teacher_id, $comment_text, $date);
$stmt->execute();

echo "Comment added successfully.";

$stmt->close();
$conn->close();
?>
