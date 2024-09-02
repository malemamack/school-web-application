<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];
$date_posted = date('Y-m-d');
$posted_by = $_POST['posted_by'];

$sql = "INSERT INTO Announcements (title, content, date_posted, posted_by) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $title, $content, $date_posted, $posted_by);
$stmt->execute();

echo "Announcement posted successfully.";

$stmt->close();
$conn->close();
?>
