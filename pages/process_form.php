<?php
require_once('../public/master_Query/funcondb.php');
// include('../include/init.php');
$oci = new funcondb();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    // $timestamp = date('2024/08/26');
    $timestamp = date('d/m/Y');
    $bgrjID = $_POST['bgrjID'];
    $bg_id = $_POST['bg_id'];
    $name = $_POST['nameresearch'];
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
//     bgrj_id         VARCHAR2(10),
//   budgetplan_name VARCHAR2(50),
//   rational        VARCHAR2(2000),
//   bg_id           VARCHAR2(50),
//   createdate      DATE,
//   location        VARCHAR2(255),
//   location_detail VARCHAR2(255),
//   startdate       DATE,
//   enddate 

    // Insert data into database
    $sql_rational = "INSERT INTO budgetplandata_rational (bgrj_id, budgetplan_name, rational,bg_id,createdate,location,location_detail,startdate,enddate) VALUES ('$bgrjID', '$name', '$rationale', '$bg_id', '$timestamp', '$locationType', '$locationDetail','$startDate','$endDate')";
    $objInsert = $oci->insertRecord($sql_rational);

    foreach ($objectives as $obj_research) {
        $sql_purpose = "INSERT INTO budgetplandata_purpose (bgrj_id, budgetplan_name, purpose,bg_id,createdate) VALUES ('$bgrjID', '$name', '$obj_research','$bg_id', '$timestamp')";
        $objInsert = $oci->insertRecord($sql_purpose);
    }

    // Display success message using SweetAlert2
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: "Success",
                text: "Data has been successfully saved!",
                icon: "success",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect or perform additional actions here
                                        window.location.href = "https://data.rajavithi.go.th/app/progresspath/pages/edit.php?id=' . $bg_id . '" ;

                }
            });
        </script>
    </body>
    </html>';
} else {
    echo "Invalid request method.";
}
