<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $rationale = htmlspecialchars($_POST['rationale']);
    $objectives = $_POST['objectives']; // Array of objectives
    $startDate = htmlspecialchars($_POST['start_date']);
    $endDate = htmlspecialchars($_POST['end_date']);
    $locationType = $_POST['location_type'];
    $locationDetail = '';

    if ($locationType === 'Government') {
        $locationDetail = htmlspecialchars($_POST['gove_text']);
    } elseif ($locationType === 'Private') {
        $locationDetail = htmlspecialchars($_POST['private_text']);
    }

    // Example: Save data to a text file
    // $file = fopen("../public/project_details.txt", "a");
    // fwrite($file, "Rationale:\n" . $rationale . "\n\n");
    // fwrite($file, "Objectives:\n" . implode("\n", $objectives) . "\n\n");
    // fwrite($file, "Location Type: " . $locationType . "\n");
    // fwrite($file, "Location Detail: " . $locationDetail . "\n");
    // fwrite($file, "----------------------------------------\n");
    // fclose($file);
echo 'หลักการและเหตุผล : ' . $rationale . 'วัตถุประสงค์ : ' . var_dump($objectives) .'ประเภทสถานที่ : ' . $locationType . 'สถานที่ : ' . $locationDetail;
echo '<br/>';
echo 'start : ' . $startDate . 'end : ' . $endDate;

    // Redirect or display success message
    // echo "ข้อมูลได้รับการบันทึกเรียบร้อยแล้ว!";
} else {
    echo "Invalid request method.";
}
