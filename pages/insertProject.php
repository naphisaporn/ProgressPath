<?php
include('../include/API.php');
include('../include/header.php');
?>


<div class="card-body my-5">
    <div class="container text-center">
        <h4 class="card-title">เพิ่มโครงการ</h4>
        <hr>
        <form class="" id="formdetail" name="formdetail" method="post" novalidate>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                                <label>ชื่อโครงการ</label>

                                <input type="text" class="form-control" name="nameproject" placeholder="ชื่อโครงการ" value="<?= $name; ?>">
                            </div>
                            <div class="col-md-3">
                                <label>สถานะโครงการ</label>
                                <select class="form-control select animated--grow-in select2" name="confirm" id="confirm">
                                    <option value="">เลือกสถานะ</option>


                                    <option value="1" <?= $c_status == '1' ? 'selected="selected"' : ''; ?>>ระหว่างดำเนินโครงการ</option>
                                    <option value="2" <?= $c_status == '2' ? 'selected="selected"' : ''; ?>>ยกเลิก</option>

                                    <?php ?>
                                </select>
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
                                <label>หน่วยงาน / กลุ่มงาน : </label>
                                <input type="text" class="form-control" name="department" placeholder="หน่วยงาน / กลุ่มงาน" value="<?= $department; ?>">
                            </div>
                            <div class="col-md-6">
                                <label>งาน : </label>
                                <input type="text" class="form-control" name="division" placeholder="งาน" value="<?= $division; ?>">
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <label>การปรับแผน (ถ้ามี)</label>

                                <input type="text" class="form-control" name="plan" placeholder="การปรับแผน">
                            </div>
                            <div class="col-md-">
                                <label>เหตุผลปรับแผน</label>

                                <input type="text" class="form-control" name="reasonplan" placeholder="เหตุผลปรับแผน">
                            </div>

                        </div>
                        <div class="row mt-1" style="justify-content: center;">
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