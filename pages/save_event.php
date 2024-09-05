<?php
// Database connection
require_once('../public/master_Query/funcondb.php');
header('Content-Type: application/json');

// Initialize your database connection
$oci = new funcondb();

// Get the raw POST data from the request
$input = json_decode(file_get_contents('php://input'), true);

// Extract data from the request
$eventName = $input['eventName'];
$amount = $input['amount'];
$months = $input['months'];
$lastUpdated = date('Y-m-d H:i:s');

// Prepare SQL query to insert or update event
try {
    $oci->beginTransaction();

    // Check if the event already exists
    $sqlCheck = "SELECT * FROM events WHERE event_name = :eventName";
    $statement = $oci->prepare($sqlCheck);
    $statement->bindParam(':eventName', $eventName, PDO::PARAM_STR);
    $statement->execute();
    $existingEvent = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existingEvent) {
        // Update existing event
        $sqlUpdate = "UPDATE events SET amount = :amount, last_updated = :lastUpdated WHERE event_name = :eventName";
        $statement = $oci->prepare($sqlUpdate);
        $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
        $statement->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_STR);
        $statement->bindParam(':eventName', $eventName, PDO::PARAM_STR);
        $statement->execute();
    } else {
        // Insert new event
        $sqlInsert = "INSERT INTO events (event_name, amount, last_updated) VALUES (:eventName, :amount, :lastUpdated)";
        $statement = $oci->prepare($sqlInsert);
        $statement->bindParam(':eventName', $eventName, PDO::PARAM_STR);
        $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
        $statement->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_STR);
        $statement->execute();
    }

    // Save months data
    $sqlDeleteMonths = "DELETE FROM event_months WHERE event_name = :eventName";
    $statement = $oci->prepare($sqlDeleteMonths);
    $statement->bindParam(':eventName', $eventName, PDO::PARAM_STR);
    $statement->execute();

    foreach ($months as $month) {
        $sqlInsertMonth = "INSERT INTO event_months (event_name, month) VALUES (:eventName, :month)";
        $statement = $oci->prepare($sqlInsertMonth);
        $statement->bindParam(':eventName', $eventName, PDO::PARAM_STR);
        $statement->bindParam(':month', $month, PDO::PARAM_STR);
        $statement->execute();
    }

    $oci->commit();

    // Respond with success and updated data
    $response = [
        'success' => true,
        'data' => getEventsData($oci) // Fetch updated data
    ];
    echo json_encode($response);
} catch (Exception $e) {
    $oci->rollBack();
    // Respond with error
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

function getEventsData($oci) {
    $sql = "SELECT event_name AS eventName, amount, last_updated AS lastUpdated, GROUP_CONCAT(month ORDER BY FIELD(month, 'October', 'November', 'December', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September')) AS months
            FROM events
            LEFT JOIN event_months ON events.event_name = event_months.event_name
            GROUP BY event_name, amount, last_updated";
    $statement = $oci->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>
