<?php
header("Content-Type: application/json");



// สร้างการเชื่อมต่อ
function connect()
{
    $hostname = "192.168.1.77";
    $port = "1521";
    $sid = "bidb";
    $username = "dwfact";
    $password = "RajaMim21";

    $connection_string = "(DESCRIPTION =
                            (ADDRESS_LIST =
                              (ADDRESS = (PROTOCOL = TCP)(HOST = $hostname)(PORT = $port))
                            )
                            (CONNECT_DATA =
                              (SERVICE_NAME = $sid)
                            )
                          )";
    $conn = oci_connect($username, $password, $connection_string);

    if (!$conn) {
        $e = oci_error();
        echo json_encode(array("error" => "Connection failed: " . $e['message']));
        exit;
    }

    return $conn;
}


function checkLogin($conn, $username, $password)
{

    // Validate and sanitize input data
    $form_username = filter_var($username, FILTER_SANITIZE_STRING);
    $form_password = filter_var($password, FILTER_SANITIZE_STRING);

    // Prepare SQL statement
    $sql = "SELECT * FROM user_pass_progresspath";
    $stid = oci_parse($conn, $sql);

    // Bind variables to the placeholders
    oci_bind_by_name($stid, ':username', $form_username);
    oci_bind_by_name($stid, ':password', $form_password);

    // Execute the SQL statement
    oci_execute($stid);

    // Fetch results and check login
    if ($row = oci_fetch_assoc($stid)) {
        echo json_encode(array("message" => "Login successful"));
    } else {
        echo json_encode(array("error" => "Invalid username or password"));
    }

    // Free resources and close connection
    oci_free_statement($stid);
    oci_close($conn);
}
