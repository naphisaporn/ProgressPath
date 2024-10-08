<?php

include('../include/API.php');
include('../include/header.php');
// require_once ('master_Query/funcondb.php'); 
require_once('../public/master_Query/funcondb.php');


$oci = new funcondb();


// if (isset($_POST['id'])) {
//     $id = $_POST['id'];

//     // เช็คและประมวลผล ID ที่ได้รับ
//     // ตัวอย่างการใช้ ID ในการดึงข้อมูล
//     $data = API_filterID($id);
//     echo $data; // ส่งข้อมูลที่ต้องการกลับไปยัง JavaScript
// } else {
//     echo 'ID parameter is missing';
// }


$number_of_questions = 5; // คุณสามารถเปลี่ยนค่าได้ตามต้องการ
// ตรวจสอบและรับค่า 'id' จาก URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $bg_id = $_GET['id'];
    $bg_id_mockup = '670000002';

    // echo "ID ที่ได้รับ: " . htmlspecialchars($id);
    // echo $bg_id;

    $url_login = "https://data.rajavithi.go.th/production/API/Get_Token/get_token_BIIntra";
    $tokenmim = gettoken($url_login, $body);

    // $bg_id = $id;

    $url_requestdata = "https://data.rajavithi.go.th/production/API/research/filterID";
    $body = array("id" => $id);
    $rq_data = getdata($url_requestdata, $tokenmim, $body);



    // var_dump($rq_data);
    // $getdatars as $dataresult

    foreach ($rq_data as $key => $datars) {
        $bgid = $datars->BG_ID;

        if ($bgid == $bg_id) {
            // $bgid = $datars->BG_ID;
            $bgrjID = $datars->BGRJ_ID;
            $erpID = $datars->ERP_ID;
            $namebudget = $datars->BUDGETPLAN_NAME;
            $orgID = $datars->ORGANIZE_ID;
            $status = $datars->STATUS;
            $responID = $datars->RESPONSIBLE_ID;
            $response = $datars->RESPONSIBLE;
            $phone = $datars->TELEPHONE_RES;
            $depID = $datars->DEPARTMENT_ID;
            $dep = $datars->DEPARTMENT;
            $division = $datars->DIVISION;
            $coor = $datars->COORDINATOR;
            $phone_co = $datars->TELEPHONE_CO;
            $planstatus = $datars->STATUS_PLAN;
            $reasonplan = $datars->REASONPLAN;
            $startdateplan = $datars->STARTDATE;
            $enddateplan = $datars->ENDDATE;
            $numdays = $datars->NUMDAYS;
            $duration = $datars->DURATION;
            $cycle = $datars->ALLOCATECYCLE;
            $budget = $datars->ALLOCATEBUDGET;
            $budgetapprove = $datars->APPROVEBUDGET;
            $spending = $datars->SPENDINGPLAN;
            $payout = $datars->PAYOUTRS;
            $percent = $datars->PAYOUTPERCENT;
        } else {
            // echo 'I can not find this ID : ' . $bg_id;
        }
    }
}
?>

<div class="my-5 mx-3">
    <div class="carddetail card">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label>ลำดับโครงการ : </label>
                        <input type="text" class="form-control" name="researchID" placeholder="ลำดับโครงการ" value="<?= $bgrjID; ?>" disabled>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label>รหัสโครงการ : </label>
                        <input type="text" class="form-control" name="ERPID" placeholder="รหัส ERP" value="<?= $bg_id; ?>" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label>ชื่อโครงการ : </label>
                        <input type="text" class="form-control" name="nameproject" placeholder="ชื่อโครงการ" value="<?= $namebudget; ?>" disabled>
                    </div>
                </div>
                <!-- <div class="row">
                    
                </div> -->
                <div class="row">
                    <div class="col-md-6">
                        <label>ผู้รับผิดชอบโครงการ : </label>
                        <input type="text" class="form-control" name="fullname" placeholder="ผู้รับผิดชอบโครงการ" value="<?= $response; ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label>เบอร์โทรติดต่อ : </label>
                        <input type="text" class="form-control" name="telephone" placeholder="เบอร์โทรติดต่อ" value="<?= $phone; ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label>หน่วยงาน / กลุ่มงาน : </label>
                        <input type="text" class="form-control" name="department" placeholder="หน่วยงาน / กลุ่มงาน" value="<?= $dep; ?>" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label>งบประมาณ : </label>
                        <input type="text" class="form-control" name="division" placeholder="งบประมาณ" value="<?= $budgetapprove; ?>" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="cardDetail card my-5">
        <div class="cardDetailHeader card-header">
            <h4>ข้อมูลโครงการ</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 bhoechie-tab-container">
                    <div class="row">
                        <div class="col-md-3 bhoechie-tab-menu">
                            <div class="list-group">
                                <a href="#" class="list-group-item active text-center">
                                    <i class="fa-solid fa-book-medical"></i><br />บทที่ 1
                                </a>
                                <a href="#" class="list-group-item text-center">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                    <h4 class="glyphicon glyphicon-home"></h4><br />บทที่ 2
                                </a>
                                <a href="#" class="list-group-item text-center">
                                    <!-- <img src="../public/assets/image/risk.png" alt=""> -->
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <h4 class="glyphicon glyphicon-cutlery"></h4><br />ความเสี่ยง
                                </a>
                                <a href="#" class="list-group-item text-center">
                                    <i class="fa-solid fa-users"></i>
                                    <h4 class="glyphicon glyphicon-credit-card"></h4><br />ประเมินผลโครงการ
                                </a>
                                <a href="#" class="list-group-item text-center">
                                    <i class="fa-solid fa-users"></i>
                                    <h4 class="glyphicon glyphicon-benefit"></h4><br />ประโยชน์ที่ได้รับ
                                </a>
                            </div>
                        </div>
                        <?php
                        $url_retopnal = "https://data.rajavithi.go.th/production/API/research/first";
                        $body_retopnal = array("id" => $id);
                        $rq_retopnal = getdata($url_retopnal, $tokenmim, $body_retopnal);

                        // var_dump($rq_retopnal);

                        foreach ($rq_retopnal as $key => $datars) {
                            // $bg_id = 1;
                            $bgid = $datars->BG_ID;
                            if ($bgid == $bg_id) {
                                $bgid = $datars->BG_ID;
                                $namebudget = $datars->BUDGETPLAN_NAME;
                                $rational = htmlspecialchars($datars->RATIONAL);
                            }
                        }

                        ?>

                        <div class="col-md-9 bhoechie-tab">
                            <div class="bhoechie-tab-content active">
                                <form class="px-5" action="process_form.php" method="post">
                                    <div class="form-group py-3">
                                        <!-- <label for="rationale">หลักการ และเหตุผล</label> -->
                                        <input type="hidden" name="bgrjID" value="<?= $bgrjID; ?>" hidden>
                                        <input type="hidden" name="bg_id" value="<?= $bg_id; ?>" hidden>
                                        <input type="hidden" name="nameresearch" value="<?= $namebudget; ?>" hidden>
                                    </div>
                                    <div class="form-group py-3">
                                        <label for="rationale">หลักการ และเหตุผล</label>
                                        <textarea class="form-control" id="rationale" name="rationale" rows="4" value="<?= $rational != NULL ? $rational : ""; ?>" required><?= $rational != NULL ? $rational : ""; ?></textarea>
                                    </div>
                                    <?php
                                    $url_purpose = "https://data.rajavithi.go.th/production/API/research/purpose";
                                    $body_purpose = array("id" => $id);
                                    $rq_purpose = getdata($url_purpose, $tokenmim, $body_purpose);


                                    // var_dump($rq_purpose);
                                    foreach ($rq_purpose as $key => $datars) {

                                        // $bg_id = 1;
                                        $bgid = $datars->BG_ID;
                                        if ($bgid == $bg_id) {
                                            $bgid = $datars->BGRJ_ID;
                                            $namebudget = $datars->BUDGETPLAN_NAME;
                                            $purpose = $datars->PURPOSE;
                                            $datecreate = $datars->CREATEDATE;
                                            $maxdate = $datars->MAXDATE;
                                        }
                                    }

                                    ?>

                                    <div class="form-group py-3">
                                        <label for="objectives">วัตถุประสงค์ของโครงการ</label>
                                        <input type="text" class="form-control" id="objectives" name="objectives[]" placeholder="เพิ่มวัตถุประสงค์" required>
                                        <div id="objectivesList" class="mt-2"></div>
                                        <div class="purposers mt-2">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>

                                                        <tr>
                                                            <th>ลำดับที่</th>
                                                            <th>วัตถุประสงค์</th>

                                                            <!-- <th>ลำดีบที่</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $url_maxdate = "https://data.rajavithi.go.th/production/API/research/purpose_maxdate";
                                                        $body_maxdate = array("id" => $id);
                                                        $rq_maxdate = getdata($url_maxdate, $tokenmim, $body_maxdate);
                                                        $url_maxp = "https://data.rajavithi.go.th/production/API/research/maxpurpose";
                                                        $body_maxp = array("id" => $id);
                                                        $rq_maxp = getdata($url_maxp, $tokenmim, $body_maxp);


                                                        // var_dump($rq_maxdate);

                                                        foreach ($rq_maxdate as $keymax => $max) {
                                                            foreach ($rq_purpose as $key => $rs) {
                                                                foreach ($rq_maxp as $key => $maxp) {
                                                                    $datecreate = $rs->CREATEDATE;
                                                                    $max_bgID = $max->BG_ID;
                                                                    $max_date = $max->MAXDATE;
                                                                    $maxp = $maxp->COUNTBG_ID;
                                                                    $maxp_ID = $maxp->BG_ID;
                                                                    // var_dump($rq_maxp);
                                                                    if ($bg_id == $max_bgID && $datecreate == $max_date) {

                                                                        $number_of_questions = $maxp;

                                                                        if ($number_of_questions > 0):
                                                                            for ($i = 1; $i <= $number_of_questions; $i++):
                                                                                $p = $rs->PURPOSE; // ดึงค่า PURPOSE
                                                                                // var_dump($p);






                                                        ?>
                                                                                <tr>


                                                                                    <td><?= $i; ?></td>
                                                                                    <td><?= htmlspecialchars($p); ?></td>

                                                                                </tr>

                                                        <?php
                                                                            endfor;
                                                                        endif;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <button type="button" id="addObjective" class="btn btn-outline-info mt-2">เพิ่มวัตถุประสงค์</button>
                                    </div>
                                    <?php
                                    foreach ($rq_retopnal as $key => $datars) {
                                        $bgid = $datars->BG_ID;
                                        if ($bgid == $bg_id) {
                                            $bgid = $datars->BG_ID;
                                            $namebudget = $datars->BUDGETPLAN_NAME;
                                            $location = $datars->LOCATION;
                                            $locationdetail = $datars->LOCATION_DETAIL;
                                            $startdate = $datars->STARTDATE;
                                            $enddate = $datars->ENDDATE;

                                            switch ($location) {
                                                case 'Government':
                                                    $check = 'checked';
                                                    $loca = 1;
                                                    $detail = $datars->LOCATION_DETAIL;
                                                    break;
                                                case 'Private':
                                                    $check = 'checked';
                                                    $loca = 2;
                                                    // $detail = $datars->LOCATION_DETAIL;
                                                    $detail = 'ห้องประชุม';
                                                    break;
                                            }
                                        }
                                    }




                                    ?>

                                    <div class="form-group py-3">
                                        <label>สถานที่ดำเนินการ</label><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check" style="text-align: start;">
                                                    <input type="radio" class="form-check-input" id="gove_place" name="location_type" value="Government" <?= ($loca == 1) ? $check : ''; ?> required>
                                                    <label class="form-check-label" for="gove_place">สถานที่ราชการ (ระบุ)</label>
                                                    <input type="text" class="form-control mt-2" id="gove_text" name="gove_text" placeholder="โปรดระบุ" value="<?php echo ($loca == 1) ? $detail : ''; ?>" <?php echo ($loca == 1) ? $detail : 'disabled'; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check" style="text-align: start;">
                                                    <input type="radio" class="form-check-input" id="private_place" name="location_type" value="Private" <?= ($loca == 2) ? $check : ''; ?>>
                                                    <label class="form-check-label" for="private_place">สถานที่เอกชน (ระบุ)</label>
                                                    <input type="text" class="form-control mt-2" id="private_text" name="private_text" placeholder="โปรดระบุ" value="<?php echo ($loca == 2) ? $detail : ''; ?>" <?php echo ($loca == 2) ? $detail : 'disabled'; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <?php
                                    $startdate = (new DateTime())->format('Y-m-d');
                                    $enddate = (new DateTime())->format('Y-m-d');
                                    ?>



                                    <div class="form-group">
                                        <label for="start_date">ระยะเวลาโครงการ</label>
                                        <div class="input-group row" style="justify-content: center;">
                                            <div class="start col-md-6">
                                                <label for="start_date">วันที่เริ่มต้นโครงการ</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" value="<?= $startdate; ?>" required>
                                            </div>
                                            <div class="end col-md-6">
                                                <label for="end_date">วันที่สิ้นสุดโครงการ</label>
                                                <input type="date" class="form-control ml-2" id="end_date" name="end_date" placeholder="End Date" value="<?= $enddate; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary my-3">บันทึกข้อมูล</button>
                                </form>
                            </div>

                            <div class="bhoechie-tab-content">
                                <div>
                                    <h4>แผนการดำเนินงาน</h4>
                                    <?php include('plan.php'); ?>
                                </div>
                            </div>
                            <div class="bhoechie-tab-content">
                                <div>
                                    <h4>ความเสี่ยง</h4>
                                    <?php include('risk.php'); ?>
                                </div>
                            </div>
                            <div class="bhoechie-tab-content">
                                <div>
                                    <h4>การติดตาม</h4>
                                    <?php include('follow_benefit.php'); ?>
                                </div>

                            </div>
                            <div class="bhoechie-tab-content">


                                <h4>ประโยชน์ที่ได้รับ</h4>

                                <?php include('benefit.php'); ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var counter = 0; // ตัวแปรเพื่อเก็บลำดับข้อ
        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });

        function updateCounter() {
            $('#objectivesList .form-group').each(function(index) {
                $(this).find('label').text('ข้อที่ ' + (index + 1));
            });
        }

        function loadObjectives() {
            // ดึงข้อมูลจากฐานข้อมูล (จำลองด้วยตัวอย่างข้อมูล)
            var data = [];

            $('#objectivesList').empty(); // เคลียร์รายการเก่า
            counter = data.length;

            data.forEach(function(item) {
                var newObjective = '<div class="form-group">' +
                    '<label>ข้อที่ ' + item.sequence + '</label>' +
                    '<input type="hidden" name="objectives[' + item.id + '][id]" value="' + item.id + '">' +
                    '<input type="hidden" name="objectives[' + item.id + '][sequence]" value="' + item.sequence + '">' +
                    '<input type="text" class="form-control mt-2" name="objectives[' + item.id + '][purpose]" value="' + item.purpose + '">' +
                    '<button type="button" class="btn btn-danger btn-sm removeObjective mt-2">ลบ</button>' +
                    '</div>';
                $('#objectivesList').append(newObjective);
            });
        }

        loadObjectives(); // โหลดข้อมูลเมื่อเริ่มต้น

        $('#addObjective').on('click', function() {
            counter++; // เพิ่มลำดับข้อทุกครั้งที่คลิก

            var newObjective = '<div class="form-group">' +
                '<label>ข้อที่ ' + counter + '</label>' +
                '<input type="hidden" name="objectives[new][' + counter + '][sequence]" value="' + counter + '">' +
                '<input type="text" class="form-control mt-2" name="objectives[new][' + counter + '][purpose]" placeholder="กรอก วัตถุประสงค์">' +
                '<button type="button" class="btn btn-danger btn-sm removeObjective mt-2">ลบ</button>' +
                '</div>';

            $('#objectivesList').append(newObjective);
        });
        $('#addBenefit').on('click', function() {
            var newBenefit = '<input type="text" class="form-control mt-2" name="benefit[]" placeholder="กรอก ประโยชน์ที่ได้รับ">';
            $('#benefitList').append(newBenefit);
        });

        $('input[name="location_type"]').on('change', function() {
            if ($(this).val() === 'Government') {
                $('#gove_text').prop('disabled', false);
                $('#private_text').prop('disabled', true).val('');
            } else if ($(this).val() === 'Private') {
                $('#private_text').prop('disabled', false);
                $('#gove_text').prop('disabled', true).val('');
            }
        });
    });

    $(document).on('click', '.removeObjective', function() {
        $(this).closest('.form-group').remove();
        updateCounter(); // ปรับปรุงเลขข้อหลังจากลบรายการ
    });

    function updateCounter() {
        $('#objectivesList .form-group').each(function(index) {
            $(this).find('label').text('ข้อที่ ' + (index + 1));
            $(this).find('input[name$="[sequence]"]').val(index + 1);
        });
    }
</script>

<?php
include('../include/footer.php');
?>