<?php
// require_once('inc_datatable.php');
?>
<div class="col-md-12">
    <div class="card shadow mb-4" style="height: 80vh;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">โครงการ รพ.ราชวิถี</h6>
        </div>
        <div class="card-body">
            <!-- <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Row 1 Data 1</td>
                        <td>Row 1 Data 2</td>
                    </tr>
                    <tr>
                        <td>Row 2 Data 1</td>
                        <td>Row 2 Data 2</td>
                    </tr>
                </tbody>
            </table> -->
            <!-- <div class="table-responsive">

                <table class="table table-bordered" id="table_correctpt" width="100%" cellspacing="0">
                    <thead>
                        <tr bgcolor=F5F5F5>
                            <th class="text-center" style="vertical-align:middle; width: 18%;">รหัส ERP โครงการ</th>
                            <th class="text-center" style="vertical-align:middle; width: 50%;">ชื่อโครงการ</th>
                            <th class="text-center" style="vertical-align:middle; width: 18%;">การอนุมัติโครงการ</th>
                            <th class="text-center" style="vertical-align:middle; width: 14%;">รอบการจัดสรร</th>
                            <th class="text-center" style="vertical-align:middle; width: 14%;">ผู้รับผิดชอบ</th>
                            <th class="text-center" style="vertical-align:middle; width: 14%;">เบอร์โทรศัพท์</th>
                            <th class="text-center" style="vertical-align:middle; width: 14%;">การปรับแผน</th>
                            <th class="text-center" style="vertical-align:middle; width: 14%;">เหตุผลปรับแผน</th>
                            <th class="text-center" style="vertical-align:middle; width: 14%;">แก้ไข</th>
                            <th class="text-center" style="vertical-align:middle; width: 14%;">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php



                        foreach ($rq_data_researchdetail as $key_directform => $row_directform) {
                            $id = $row_directform->PROJECT_ID;
                        ?>
                            <tr>
                                <td class="text-center"><?= $row_directform->PROJECT_ID; ?></td>
                                <td class="text-left"><?= $row_directform->PROJECTNAME; ?></td>
                                <td class="text-center"><?= $row_directform->CONFIRMSTATUS; ?></td>
                                <td class="text-center"><?= $row_directform->CIRCLE; ?></td>
                                <td class="text-center"><?= $row_directform->FULLNAME; ?></td>
                                <td class="text-center"><?= $row_directform->PHONE; ?></td>
                                <td class="text-center"><?= $row_directform->PLAN; ?></td>
                                <td class="text-center"><?= $row_directform->REASONPLAN; ?></td>
                                <form method="post">
                                    <td class="text-center">
                                        <input type="submit" class="btn btn-outline-warning" name="edit" value="แก้ไข">
                                    </td>
                                    <td class="text-center">
                                        <input type="submit" class="btn btn-outline-info" name="addDetail" value="เพิ่มรายละเอียด">

                                    </td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div> -->
            <div class="">
<table id="example" class="display" width="100%" cellspacing="0">
<thead>
<tr>
<th>Empid</th>
<th>Name</th>
<th>Salary</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Empid</th>
<th>Name</th>
<th>Salary</th>
</tr>
</tfoot>
</table>
</div>
        </div>
    </div>
</div>


</div>
<script>
    $( document ).ready(function() {
      $('#example').dataTable({
         "bProcessing": true,
                 "sAjaxSource": "https://data.rajavithi.go.th/app/progresspath/mvc/views/response.php",
         "aoColumns": [
            { mData: 'Empid' } ,
                        { mData: 'Name' },
                        { mData: 'Salary' }
                ]
        });   
});
</script>