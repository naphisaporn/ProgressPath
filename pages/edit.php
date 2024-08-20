<?php
include('../include/API.php');
include('../include/header.php');
$getdatars = API_ALLdata();

foreach ($getdatars as $dataresult) {
    $bgID = $dataresult->BG_ID;
    $bgrjID = $dataresult->BGRJ_ID;
    $name = $dataresult->BUDGETPLAN_NAME;
    $status = $dataresult->STATUS_PLAN;
    $res = $dataresult->RESPONSIBLE;
    $tel = $dataresult->TELEPHONE_RES;
    $organize_id = $dataresult->ORGANIZE_ID;
    $organize = $dataresult->ORGANIE_NAME;
    $approveBG = $dataresult->APPROVEBUDGET;
    // Add an example value for $id if it's not set elsewhere
    $id = $dataresult->ERP_ID; // Assuming this is a field you have in your data
}
?>

<div class="my-5 mx-3">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label>ลำดับโครงการ : </label>
                        <input type="text" class="form-control" name="researchID" placeholder="ลำดับโครงการ" value="<?= htmlspecialchars($bgrjID); ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label>รหัสโครงการ : </label>
                        <input type="text" class="form-control" name="ERPID" placeholder="รหัส ERP" value="<?= htmlspecialchars($id); ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <label>ชื่อโครงการ : </label>
                        <input type="text" class="form-control" name="nameproject" placeholder="ชื่อโครงการ" value="<?= htmlspecialchars($name); ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>ผู้รับผิดชอบโครงการ : </label>
                        <input type="text" class="form-control" name="fullname" placeholder="ผู้รับผิดชอบโครงการ" value="<?= htmlspecialchars($res); ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label>เบอร์โทรติดต่อ : </label>
                        <input type="text" class="form-control" name="telephone" placeholder="เบอร์โทรติดต่อ" value="<?= htmlspecialchars($tel); ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label>หน่วยงาน / กลุ่มงาน : </label>
                        <input type="text" class="form-control" name="department" placeholder="หน่วยงาน / กลุ่มงาน" value="<?= htmlspecialchars($organize); ?>" readonly>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label>งบประมาณ : </label>
                        <input type="text" class="form-control" name="division" placeholder="งาน" value="<?= htmlspecialchars($approveBG); ?>" readonly>
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
                                    <h4 class="glyphicon glyphicon-credit-card"></h4><br />ประเมินผลโครงการ / ประโยชน์
                                </a>
                            </div>
                        </div>

                        <div class="col-md-9 bhoechie-tab">
                            <div class="bhoechie-tab-content active">
                                <form class="px-5" action="process_form.php" method="post">
                                    <div class="form-group py-3">
                                        <label for="rationale">หลักการ และเหตุผล</label>
                                        <textarea class="form-control" id="rationale" name="rationale" rows="4" required></textarea>
                                    </div>

                                    <div class="form-group py-3">
                                        <label for="objectives">วัตถุประสงค์ของโครงการ</label>
                                        <input type="text" class="form-control" id="objectives" name="objectives[]" placeholder="เพิ่มวัตถุประสงค์" required>
                                        <div id="objectivesList" class="mt-2"></div>
                                        <button type="button" id="addObjective" class="btn btn-outline-info mt-2">เพิ่มวัตถุประสงค์</button>
                                    </div>

                                    <div class="form-group py-3">
                                        <label>สถานที่ดำเนินการ</label><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check" style="text-align: start;">
                                                    <input type="radio" class="form-check-input" id="gove_place" name="location_type" value="Government">
                                                    <label class="form-check-label" for="gove_place">สถานที่ราชการ (ระบุ)</label>
                                                    <input type="text" class="form-control mt-2" id="gove_text" name="gove_text" placeholder="โปรดระบุ" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check" style="text-align: start;">
                                                    <input type="radio" class="form-check-input" id="private_place" name="location_type" value="Private">
                                                    <label class="form-check-label" for="private_place">สถานที่เอกชน (ระบุ)</label>
                                                    <input type="text" class="form-control mt-2" id="private_text" name="private_text" placeholder="โปรดระบุ" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">ระยะเวลาโครงการ</label>
                                        <div class="input-group row" style="justify-content: center;">
                                            <div class="start col-md-6">
                                                <label for="start_date">วันที่เริ่มต้นโครงการ</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" required>
                                            </div>
                                            <div class="end col-md-6">
                                                <label for="end_date">วันที่สิ้นสุดโครงการ</label>
                                                <input type="date" class="form-control ml-2" id="end_date" name="end_date" placeholder="End Date" required>
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
                                <div>
                                    <h4>ประโยชน์</h4>
                                </div>
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
        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });

        $('#addObjective').on('click', function() {
            var newObjective = '<input type="text" class="form-control mt-2" name="objectives[]" placeholder="Enter objective">';
            $('#objectivesList').append(newObjective);
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
</script>

<?php
include('../include/footer.php');
?>