<?php
require('../../include/db_connect.php');

header('Content-Type: application/json');
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $userData = checkLogin($username, $password);

    if ($userData) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $userData['ROLETYPE']; // Store role type in session

        $response['status'] = 'success';
        $response['message'] = 'Login successful';
        $response['data'] = $userData;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid username or password';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>
