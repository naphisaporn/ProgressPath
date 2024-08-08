<?php include('../include/datatable.php');
?>

<div class="card py-3 my-3">
    <div class="card-header">
        <h4>ข้อมูลโครงการทั้งหมด</h4>

    </div>
    <div class="card-body">
        <table id="table_correctpt" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>รหัสโครงการ</th>
                    <th>ชื่อโครงการ</th>
                    <th>สถานะโครงการ</th>
                    <th>ผู้รับผิดชอบ</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011-04-25</td>
                    <td><input class="btn btn-warning" name="edit" type="submit" value="แก้ไข"></td>
                    <td><input class="btn btn-danger" name="del" type="submit" value="ลบ"></td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <th>รหัสโครงการ</th>
                    <th>ชื่อโครงการ</th>
                    <th>สถานะโครงการ</th>
                    <th>ผู้รับผิดชอบ</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

<?php
if(isset($_POST['edit'])) {
    echo 'แก้ไขสำเร็จ';
    ?>

    <?php
} elseif(isset($_POST['del'])) {
    echo 'ลบสำเร็จ';

}
?>