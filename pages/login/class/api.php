<?php
include 'db_connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        echo json_encode(array("loggedIn" => true));
    } else {
        echo json_encode(array("loggedIn" => false));
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user'] ?? '';
    $password = $_POST['pass'] ?? '';

    $conn = connect();

    $form_username = filter_var($username, FILTER_SANITIZE_STRING);
    $form_password = filter_var($password, FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stid = oci_parse($conn, $sql);

    oci_bind_by_name($stid, ':username', $form_username);
    oci_bind_by_name($stid, ':password', $form_password);

    oci_execute($stid);

    if ($row = oci_fetch_assoc($stid)) {
        session_start();
        $_SESSION['logged_in'] = true;
        echo json_encode(array("message" => "Login successful"));
    } else {
        echo json_encode(array("message" => "Invalid username or password"));
    }

    oci_free_statement($stid);
    oci_close($conn);
    exit;
}

echo json_encode(array("error" => "Invalid request method."));
