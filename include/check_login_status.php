<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['username']) && isset($_SESSION['roletype'])) {
    echo json_encode([
        "status" => "success",
        "username" => $_SESSION['username'],
        "roletype" => $_SESSION['roletype']
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "User not logged in"
    ]);
}
?>
