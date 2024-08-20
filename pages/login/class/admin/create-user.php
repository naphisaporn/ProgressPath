<?php

require '../db_connection.php'; // เปลี่ยนเป็นไฟล์ที่เชื่อมต่อฐานข้อมูลของคุณ

putenv('NLS_LANG=AMERICAN_AMERICA.AL32UTF8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();
    // if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    //     header('HTTP/1.1 403 Forbidden');
    //     echo json_encode(array("success" => false, "error" => "Access denied."));
    //     exit;
    // }

    function maxid()
    {
        // เชื่อมต่อกับฐานข้อมูล
        $conn = connect();

        // สร้างคำสั่ง SQL
        $sql = "SELECT MAX(user_id) AS max_user_id FROM USERPASS_PROGRESSPATH";
        $stid = oci_parse($conn, $sql);

        // ดำเนินการคำสั่ง SQL
        oci_execute($stid);

        // ดึงข้อมูลที่ได้
        $row = oci_fetch_assoc($stid);

        // ตรวจสอบว่ามีผลลัพธ์หรือไม่
        $max_id = $row ? $row['MAX_USER_ID'] : 0; // เริ่มจาก 0 หากไม่พบข้อมูล

        // ปล่อยทรัพยากร
        oci_free_statement($stid);
        oci_close($conn);

        return $max_id + 1; // เพิ่ม 1 เพื่อให้เป็น ID ใหม่
    }

    // รับข้อมูลจากฟอร์ม
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $division_name = isset($_POST['department']) ? $_POST['department'] : '';
    $subdivision_name = isset($_POST['job']) ? $_POST['job'] : '';
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $roletype = isset($_POST['usertype']) ? $_POST['usertype'] : '';

    // default variable
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;
    $user_id = maxid();
    $division_id = '';
    $subdivision_id = '';

    $last_login = '';
    $failed_login_attempts = 0;
    $account_locked = 0;
    $reset_token = '';
    $reset_token_expiry = '';

    // เชื่อมต่อฐานข้อมูล
    $conn = connect();

    // ตรวจสอบว่าชื่อผู้ใช้มีอยู่แล้วหรือไม่
    $sql = "SELECT * FROM USERPASS_PROGRESSPATH WHERE username = :username";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':username', $username);
    oci_execute($stid);

    // ตรวจสอบข้อผิดพลาด
    $e = oci_error($stid);
    if ($e) {
        echo json_encode(array("success" => false, "error" => $e['message']));
        exit;
    }

    if (oci_fetch_assoc($stid)) {
        echo json_encode(array("success" => false, "error" => "Username already exists."));
    } else {
        // เพิ่มผู้ใช้ใหม่
        $sql = "INSERT INTO USERPASS_PROGRESSPATH (
        user_id,
        username,
        password,
        division_id,
        division_name,
        subdivision_id,
        subdivision_name,
        name,
        created_at,
        updated_at,
        last_login,
        failed_login_attempts,
        account_locked,
        reset_token,
        reset_token_expiry,
        roletype
    ) VALUES (
        :user_id,
        :username,
        :password,
        :division_id,
        :division_name,
        :subdivision_id,
        :subdivision_name,
        :full_name,
        TO_DATE(:created_at, 'YYYY-MM-DD HH24:MI:SS'),
        TO_DATE(:updated_at, 'YYYY-MM-DD HH24:MI:SS'),
        :last_login,
        :failed_login_attempts,
        :account_locked,
        :reset_token,
        :reset_token_expiry,
        :roletype
    )";

        $stid = oci_parse($conn, $sql);

        oci_bind_by_name($stid, ':user_id', $user_id);
        oci_bind_by_name($stid, ':username', $username);
        oci_bind_by_name($stid, ':password', password_hash($password, PASSWORD_DEFAULT));
        oci_bind_by_name($stid, ':division_id', $division_id);
        oci_bind_by_name($stid, ':division_name', $division_name);
        oci_bind_by_name($stid, ':subdivision_id', $subdivision_id);
        oci_bind_by_name($stid, ':subdivision_name', $subdivision_name);
        oci_bind_by_name($stid, ':full_name', $full_name);
        oci_bind_by_name($stid, ':created_at', $created_at);
        oci_bind_by_name($stid, ':updated_at', $updated_at);
        oci_bind_by_name($stid, ':last_login', $last_login);
        oci_bind_by_name($stid, ':failed_login_attempts', $failed_login_attempts);
        oci_bind_by_name($stid, ':account_locked', $account_locked);
        oci_bind_by_name($stid, ':reset_token', $reset_token);
        oci_bind_by_name($stid, ':reset_token_expiry', $reset_token_expiry);
        oci_bind_by_name($stid, ':roletype', $roletype);

        $result = oci_execute($stid);

        if ($result) {
            echo json_encode(array("success" => true));
        } else {
            $e = oci_error($stid);
            echo json_encode(array("success" => false, "error" => $e['message']));
        }
    }

    // ปล่อยทรัพยากร
    oci_free_statement($stid);
    oci_close($conn);
}
