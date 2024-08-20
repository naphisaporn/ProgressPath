<?php
// example_page.php
session_start();

// Check if the user is logged in and retrieve their role
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
} else {
    $username = 'Guest';
    $role = 'None';
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
        <p>Role: <?php echo htmlspecialchars($role); ?></p>
        <!-- Other content -->
    </div>
</body>
</html>
