<?php
// Define Oracle database connection constants
define('OCI_DB_TYPE_BIDB', 'oci');
define('OCI_TNS_NAME_BIDB', 'bidb');
define('OCI_DB_USERE_BIDB', 'dwfact');
define('OCI_DB_HOST_BIDB', '192.168.1.77');
define('OCI_DB_PASS_BIDB', 'RajaMim21');

// Function to connect to Oracle database
function connectToOracle()
{
    $connectionString = OCI_TNS_NAME_BIDB;
    $username = OCI_DB_USERE_BIDB;
    $password = OCI_DB_PASS_BIDB;

    // Establish a connection to Oracle database
    $connection = oci_connect($username, $password, $connectionString);

    // Check connection status
    if (!$connection) {
        $error = oci_error();
        echo json_encode([
            'status' => 'error',
            'message' => 'Database connection failed: ' . $error['message']
        ]);
        exit;
    }

    return $connection;
}

// Function to check login credentials
function checkLogin($username, $password)
{
    // Establish connection to Oracle database
    $connection = connectToOracle();
    if (!$connection) {
        error_log('Failed to connect to Oracle database.');
        return null; // Connection failed
    }

    // Prepare SQL query
    $sql = "SELECT USER_ID, username, password, ROLETYPE FROM USERPASS_PROGRESSPATH WHERE username = :username";
    $stmt = oci_parse($connection, $sql);

    // Bind parameters
    oci_bind_by_name($stmt, ':username', $username);

    // Execute SQL query
    $result = oci_execute($stmt);

    if (!$result) {
        $error = oci_error($stmt);
        error_log('Failed to execute query: ' . $error['message']);
        oci_free_statement($stmt);
        oci_close($connection);
        return null; // Query execution failed
    }

    // Fetch user data
    $userData = oci_fetch_assoc($stmt);

    // Clean up
    oci_free_statement($stmt);
    oci_close($connection);

    // Debug output
    if ($userData) {
        error_log('Fetched user data: ' . print_r($userData, true));
    } else {
        error_log('No user data found for username: ' . $username);
    }

    // Verify password and check role type
    if ($userData && password_verify($password, $userData['PASSWORD'])) {
        // Ensure ROLETYPE is valid
        if (isset($userData['ROLETYPE']) && $userData['ROLETYPE'] >= 0) {
            return $userData; // Login successful
        }
    }

    // Login failed
    return null;
}






// // Handle POST request
// header('Content-Type: application/json');
// $response = array();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Get posted data
//     $username = $_POST['username'] ?? '';
//     $password = $_POST['password'] ?? '';

//     // Check login status
//     $userData = checkLogin($username, $password);

//     if ($userData === null) {
//         $response['status'] = 'error';
//         $response['message'] = 'Invalid credentials or failed to retrieve user data';
//     } else {
//         $response['status'] = 'success';
//         $response['message'] = 'Login successful';
//         // Optionally, add user data to response
//         // $response['data'] = $userData;
//     }
// } else {
//     $response['status'] = 'error';
//     $response['message'] = 'Invalid request method';
// }

// // Send JSON response
// echo json_encode($response);
