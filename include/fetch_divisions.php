<?php
header('Content-Type: application/json');

// Fetch department_id from GET request
$department_id = $_GET['department_id'];

// Database connection (use your own connection details)
$mysqli = new mysqli('localhost', 'username', 'password', 'database');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Query to fetch divisions based on department_id
$query = $mysqli->prepare("SELECT ID, NAME FROM divisions WHERE department_id = ?");
$query->bind_param('i', $department_id);
$query->execute();
$result = $query->get_result();

$divisions = [];
while ($row = $result->fetch_assoc()) {
    $divisions[] = $row;
}

echo json_encode($divisions);

// Close the database connection
$query->close();
$mysqli->close();
?>
