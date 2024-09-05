<?php
include('../include/API.php');
include('../include/header.php');
require_once('../public/master_Query/funcondb.php');
// include('../include/init.php');
$oci = new funcondb();


$url_login = "https://data.rajavithi.go.th/production/API/Get_Token/get_token_BIIntra";
$tokenmim = gettoken($url_login, $body);

// $bg_id = $id;

$url_requestdata = "https://data.rajavithi.go.th/production/API/research/dep";
$body = array("id" => $id);
$rq_data = getdata($url_requestdata, $tokenmim, $body);

$url_2dep = "https://data.rajavithi.go.th/production/API/research/seconddep";
$body_2dep = array("id" => $id);
$rq_2dep = getdata($url_2dep, $tokenmim, $body_2dep);

// var_dump($rq_data);

?>

<style scoped>
    /* Adjust Select2 to integrate well with form-control */
    .select2-container {
        width: 100% !important;
        /* Ensure the Select2 dropdown is as wide as the container */
    }

    .select2-selection {
        border-radius: 0.375rem;
        /* Match Bootstrap form-control border radius */
        border: 1px solid #ced4da;
        /* Match Bootstrap form-control border */
    }

    .select2-selection__placeholder {
        color: #6c757d;
        /* Set placeholder color to match Bootstrap form-control placeholder */
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* Hide spinner in Firefox */
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        /* Hide spinner in Chrome, Safari, Edge */
        margin: 0;
        /* Remove default margin */
    }
</style>


<div class="card-body my-5">
    <div class="container text-center">
        <h4 class="card-title">เพิ่มโครงการ</h4>
        <hr>
        <form class="" id="formdetail" name="formdetail" method="post" novalidate>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>ปีงบประมาณ</label>
                                <select id="yearbudget" name="yearbudget" class="form-control select_months" required>
                                </select>

                                <!-- <select type="text" class="form-control" id="yearbudget" name="yearbudget" placeholder="ปีงบประมาณ" value=""> -->
                                <script>
                                    const yearSelect = document.getElementById('yearbudget');
                                    const currentYear = new Date().getFullYear();
                                    for (let i = currentYear; i <= currentYear + 5; i++) {
                                        const option = document.createElement('option');
                                        option.value = i + 543;
                                        option.text = i + 543;
                                        if (i === currentYear) {
                                            option.selected = true;
                                        }
                                        yearSelect.appendChild(option);
                                    }
                                </script>
                            </div>
                            <div class="col-md-4">
                                <label>ลำดับ</label>
                                <input type="text" class="inputMaxlenght form-control" name="bg_id" placeholder="ลำดับ" value="<?= $ฺBG_ID; ?>" maxlength="6">
                            </div>
                            <div class="col-md-4">
                                <label>เลข ERP</label>
                                <input type="text" class="inputMaxlenght form-control" name="erp_id" placeholder="เลข ERP" value="<?= $ฺerp_id; ?>" maxlength="20">
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <label>ชื่อโครงการ</label>

                                <input type="text" class="form-control" name="nameproject" placeholder="ชื่อโครงการ" value="<?= $name; ?>">
                            </div>
                            <div class="col-md-3">
                                <label>งบประมาณ : </label>
                                <input type="number" class="form-control" name="budgetall" placeholder="งบประมาณ" value="<?= $budgetall; ?>">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label>ผู้รับผิดชอบโครงการ</label>
                                <input type="text" class="form-control" name="organize" placeholder="ผู้รับผิดชอบโครงการ" value="<?= $organize; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>เบอร์โทรศัพท์</label>

                                <input type="text" class="form-control" name="tel" placeholder="เบอร์โทรศัพท์" value="<?= $tel; ?>">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="department">กลุ่มงาน:</label>
                                <select id="department" name="department" class="form-control select2" style="width: 100%;">
                                    <!-- ตัวอย่างค่าใน dropdown -->
                                    <option></option>
                                    <?php
                                    foreach ($rq_data as $key => $rs) {

                                    ?>
                                        <option value="<?= $rs->NAME; ?>"><?= $rs->NAME; ?></option>

                                        <!-- เพิ่มรายการที่ต้องการ -->
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>งาน : </label>
                                <input type="text" name="division" id="division" class="form-control" value="<?= $division; ?>">
                                <!-- <select id="division" name="division" class="form-control select2" style="width: 100%;"> -->
                                <!-- ตัวอย่างค่าใน dropdown -->
                                <!-- <option></option> -->


                            </div>

                        </div>



                    </div>

                    <script>
                        $(document).ready(function() {
                            $('input.inputMaxlenght').maxlength({
                                alwaysShow: true,
                                threshold: 2,
                                warningClass: "small form-text text-muted",
                                limitReachedClass: "small form-text text-danger",
                                placement: 'bottom-right-inside',
                                message: '%charsTyped% / %charsTotal%'
                            });
                            // $('input[maxlength]').maxlength({
                            //     alwaysShow: true,
                            //     warningClass: "form-text text-muted mt-1",
                            //     limitReachedClass: "form-text text-muted mt-1",
                            //     placement: 'bottom-right-inside'
                            // });
                            // console.log(typeof $.fn.maxlength); // ตรวจสอบว่ามีฟังก์ชันนี้อยู่หรือไม่
                        });
                    </script>



                    <!-- <div class="row">
                            <div class="col-md-6">
                                <label>การปรับแผน (ถ้ามี)</label>

                                <input type="text" class="form-control" name="plan" placeholder="การปรับแผน">
                            </div>
                            <div class="col-md-">
                                <label>เหตุผลปรับแผน</label>

                                <input type="text" class="form-control" name="reasonplan" placeholder="เหตุผลปรับแผน">
                            </div>

                        </div> -->
                    <div class="row my-2" style="justify-content: center;">
                        <div class="form-group col-md-6">
                            <input type="submit" class="form-control btn btn-outline-info" name="save" value="บันทึกข้อมูล">

                            <!-- <input type="submit" class="btn btn-primary" name="save" value="บันทึกข้อมูล"> -->
                        </div>

                    </div>
                </div>

            </div>
    </div>
    </form>

</div>




</div>
<script>
    $(document).ready(function() {
        $('#department').select2({
            placeholder: 'เลือกหน่วยงาน / กลุ่มงาน',
            allowClear: true
        });
        // $('#division').select2({
        //     placeholder: 'เลือกงาน',
        //     allowClear: true
        // });
    });
</script>
<!-- 
<script>
    function validateNumber(input) {
        // Remove any non-numeric characters
        input.value = input.value.replace(/[^0-9]/g, '');
    }
</script> -->


<?php
if (isset($_POST['save'])) {
    require('insertdata.php');
    // status : 1 -- approve
    // 0 -- end 
//     $status = '1';
//     $responsible_id = '';
//     $responsible = '';
//     // echo 'บันทึกสำเร็จ';
//     $y_bg = $_POST['yearbudget'];
//     $bgid = $_POST['bg_id'];
//     $bgrj_id = '';
//     $erp_id = $_POST['erp_id'];
//     $organize_id = '';
//     $nameproject = $_POST['nameproject'];
//     $organize = $_POST['organize'];
//     $tel = $_POST['tel'];
//     $department_id = '';
//     $coordinator = '';
//     $telephone_co = '';
//     $status_plan = '';
//     $dep = $_POST['department'];
//     $division = $_POST['division'];
//     $budgetall = $_POST['budgetall'];
//     $reasonplan = '';
//     $startdate = '';
//     $enddate = '';
//     $numdays = '';
//     $duration = '';
//     $allocatecycle = '';
//     $allocatebudget = '';
//     // $approvebudget = '';
//     $spendingplan = '';
//     $payoutrs = '';
//     $payoutpercent = '';

//     // echo  $bgid . ' ' . $bgrj_id . ' ' . $erp_id . ' ' . $nameproject . ' ' . $organize . ' ' . $y_bg;


//     $sql_rational = "INSERT INTO budgetplandata (
//         bg_id,
//         bgrj_id,
//         erp_id,
//         budgetplan_name,
//         organize_id,
//         organize_name,
//         status,
//         responsible_id,
//         responsible,
//         telephone_res,
//         department_id,
//         department,
//         division,
//         coordinator,
//         telephone_co,
//         status_plan,
//         reasonplan,
//         startdate,
//         enddate,
//         numdays,
//         duration,
//         allocatecycle,
//         allocatebudget,
//         approvebudget,
//         spendingplan,
//         payoutrs,
//         payoutpercent,
//         yearbudget
//     ) VALUES (
//         '$bgid',
//         '$bgrj_id',
//         '$erp_id',
//         '$nameproject',
//         'organize_id',
//         'division',
//         'status',
//         'responsible_id',
//         'organize',
//         'tel',
//         'department_id',
//         'dep',
//         'division',
//         'coordinator' ,
//         'telephone_co',
//         'status_plan',
//         'reasonplan',
//         'startdate',
//         'enddate',
//         'numdays',
//         'duration',
//         'allocatecycle',
//         'allocatebudget',
//         'budgetall',
//         'spendingplan',
//         'payoutrs',
//         'payoutpercent',
//         'y_bg'
//     )";
//     $objInsert = $oci->insertRecord($sql_rational);

//     if ($objInsert) {
//         echo 'success';
//     } else {
//         echo 'error';
//     }
}
?>

