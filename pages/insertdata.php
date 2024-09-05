<?php

$status = '1';
$responsible_id = '';
$responsible = '';
// echo 'บันทึกสำเร็จ';
$y_bg = $_POST['yearbudget'];
$bgid = $_POST['bg_id'];
$bgrj_id = '';
$erp_id = $_POST['erp_id'];
$organize_id = '';
$nameproject = $_POST['nameproject'];
$organize = $_POST['organize'];
$tel = $_POST['tel'];
$department_id = '';
$coordinator = '';
$telephone_co = '';
$status_plan = '';
$dep = $_POST['department'];
$division = $_POST['division'];
$budgetall = $_POST['budgetall'];
$reasonplan = '';
$startdate = '';
$enddate = '';
$numdays = '';
$duration = '';
$allocatecycle = '';
$allocatebudget = '';
// $approvebudget = '';
$spendingplan = '';
$payoutrs = '';
$payoutpercent = '';

// echo  $bgid . ' ' . $bgrj_id . ' ' . $erp_id . ' ' . $nameproject . ' ' . $organize . ' ' . $y_bg;


$sql_rational = "INSERT INTO budgetplandata (
     bg_id,
     bgrj_id,
     erp_id,
     budgetplan_name,
     organize_id,
     organize_name,
     status,
     responsible_id,
     responsible,
     telephone_res,
     department_id,
     department,
     division,
     coordinator,
     telephone_co,
     status_plan,
     reasonplan,
     startdate,
     enddate,
     numdays,
     duration,
     allocatecycle,
     allocatebudget,
     approvebudget,
     spendingplan,
     payoutrs,
     payoutpercent,
     yearbudget
 ) VALUES (
     '$bgid',
     '$bgrj_id',
     '$erp_id',
     '$nameproject',
     '$organize_id',
     '$division',
     '$status',
     '$responsible_id',
     '$organize',
     '$tel',
     '$department_id',
     '$dep',
     '$division',
     '$coordinator' ,
     '$telephone_co',
     '$status_plan',
     '$reasonplan',
     '$startdate',
     '$enddate',
     '$numdays',
     '$duration',
     '$allocatecycle',
     '$allocatebudget',
     '$budgetall',
     '$spendingplan',
     '$payoutrs',
     '$payoutpercent',
     '$y_bg'
 )";
$objInsert = $oci->insertRecord($sql_rational);

if ($objInsert) {
    echo 'success';
} else {
    echo 'error';
}

?>

<script>
    $(document).ready(function() {
        $('#formdetail').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                type: 'POST',
                url: '', // URL ของไฟล์ PHP ที่จัดการการบันทึกข้อมูล
                data: formData,
                success: function(response) {
                    // แสดง SweetAlert2 เมื่อบันทึกข้อมูลสำเร็จ
                    Swal.fire({
                        title: 'สำเร็จ!',
                        text: 'บันทึกข้อมูลสำเร็จ',
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        // Check if the confirm button was clicked
                        if (result.isConfirmed) {
                            // Redirect to the new URL
                            window.location.href = 'https://data.rajavithi.go.th/app/progresspath/pages/insertProject.php';
                        }
                    });

                },
                error: function() {
                    // แสดง SweetAlert2 เมื่อเกิดข้อผิดพลาด
                    Swal.fire({
                        title: 'ผิดพลาด!',
                        text: 'ไม่สามารถบันทึกข้อมูลได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
            });
        });
    });
</script>