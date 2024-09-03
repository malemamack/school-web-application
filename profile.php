<?php
// session_start();
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



$parent_id = $_SESSION['parent_id'];
if (isset($_SESSION['parent_id'])) {
    $parent_id = $_SESSION['parent_id'];
    echo "Parent ID: " . htmlspecialchars($parent_id); // Output parent_id safely
} else {
    // Handle case where session variable is not set
    echo "Parent ID not found.";
}

// Prepare and execute the SQL statement
$sql = "SELECT * FROM learners WHERE parent_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Failed to prepare the SQL statement: " . $conn->error);
}

$stmt->bind_param("i", $parent_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Failed to execute the SQL statement: " . $stmt->error);
}

// Check if there are results and fetch data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) . "<br>";
        echo "Grade: " . htmlspecialchars($row["grade"]) . "<br>";
        echo "Date of Birth: " . htmlspecialchars($row["date_of_birth"]) . "<br><br>";
    }
} else {
    echo "No learners found for this parent.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
