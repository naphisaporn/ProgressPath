<?php
include('../include/datatable.php');
$getdatars = API_ALLdata();

// var_dump($getdatars);
?>

<div class="card py-3 my-3">
    <div class="card-header">
        <h4>ข้อมูลโครงการทั้งหมด</h4>

    </div>
    <div class="card-body">
        <table id="table_correctpt" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                    <th>รหัสโครงการ</th>
                    <th>ชื่อโครงการ</th>
                    <th>สถานะโครงการ</th>
                    <th>ผู้รับผิดชอบ</th>
                    <th>เบอร์โทรศัพท์</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($getdatars as $dataresult) {
                    $bgID = $dataresult->BG_ID;
                    $name = $dataresult->BUDGETPLAN_NAME;
                    $status = $dataresult->STATUS_PLAN;
                    $res = $dataresult->RESPONSIBLE;
                    $tel = $dataresult->TELEPHONE_RES;
                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?= $bgID;?></td>
                        <td><?= $name;?></td>
                        <td><?= $status;?></td>
                        <td><?= $res;?></td>
                        <td><?= $tel;?></td>
                        

                    </tr>
                <?php
                }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                    <th>รหัสโครงการ</th>
                    <th>ชื่อโครงการ</th>
                    <th>สถานะโครงการ</th>
                    <th>ผู้รับผิดชอบ</th>
                    <th>เบอร์โทรศัพท์</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>