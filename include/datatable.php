<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table_correctpt').DataTable({
            "columns": [{
                    "data": null,
                    "defaultContent": "<button class='edit-btn btn btn-warning'>แก้ไข</button>"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='del-btn btn btn-danger'>ลบ</button>"
                },
                {
                    "data": "BG_ID"
                },
                {
                    "data": "BUDGETPLAN_NAME"
                },
                {
                    "data": "STATUS"
                },
                {
                    "data": "RESPONSIBLE"
                },
                {
                    "data": "TELEPHONE_RES"
                }
            ],
            'order': [],
            "processing": true,
            // "serverSide": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "ทั้งหมด"]
            ],
            dom: 'lrfBtip',
            colReorder: true,
            stateSave: true,
            select: true,
            color: '#ed80b3',
            buttons: {
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-primary btn-sm'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-primary btn-sm'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-primary btn-sm',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-primary btn-sm'
                    },
                ]
            },
            "oLanguage": {
                "sLengthMenu": "แสดง _MENU_ รายการ ต่อหน้า",
                "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการ",
                "sSearch": "ค้นหา :",
                "oPaginate": {
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "scrollY": "200px",
                    "paging": false,
                }
            }
        });

        $('#table_correctpt tbody').on('click', '.edit-btn', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data.BG_ID; // ดึงค่า ID จากคอลัมน์ที่สาม
            alert('แก้ไข ลำดับที่: ' + 'ID:' + id);

            // window.location.href = '../pages/edit.php';
            window.location.href = '../pages/edit.php?id=' + id;
            // window.location.href = 'views/edit.php?id=' + id;
        });
        // $('#table_correctpt tbody').on('click', '.edit-btn', function() {
        //     var data = table.row($(this).parents('tr')).data();
        //     var id = data.BG_ID; // ดึงค่า ID จากคอลัมน์ที่สาม
        //     alert('แก้ไข ลำดับที่: ' + 'ID:' + id);

        //     fetch('https://data.rajavithi.go.th/production/API/research/filterID', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'Authorization': 'Bearer YOUR_TOKEN' // ถ้ามีการใช้ Token สำหรับการยืนยันตัวตน
        //             },
        //             body: JSON.stringify({
        //                 id: id
        //             }) // ส่งข้อมูลในรูปแบบ JSON
        //         })
        //         .then(response => response.json()) // แปลงการตอบกลับจาก API เป็น JSON
        //         .then(data => {
        //             console.log('Success:', data);
        //             // ทำอะไรบางอย่างกับข้อมูลที่ได้รับจาก API
        //             // เช่น การเปลี่ยนแปลงหน้าที่มีการแสดงข้อมูล
        //             window.location.href = '../pages/edit.php'; // เปลี่ยน URL ตามต้องการ
        //         })
        //         .catch((error) => {
        //             console.error('Error:', error);
        //         });
        // });

        $('#table_correctpt tbody').on('click', '.del-btn', function() {
            var data = table.row($(this).parents('tr')).data();
            // var qcid = data.QC_id; // ดึงค่า ID จากคอลัมน์ที่สาม
            var id = data.BG_ID; // ดึงค่า ID จากคอลัมน์ที่สาม
            // window.location.href = 'views/delete.php?id=' + qc_id;

            // delete_QCline(id, qc_id);
            // เพิ่มโค้ดสำหรับการลบข้อมูลที่นี่
            // alert('ลบข้อมูล ลำดับที่: '+ qc_id + ' ' + 'ID:' + id);
            alert('ลบข้อมูล ลำดับที่: ' + 'ID:' + id);
            // window.location.href = 'views/delete.php?qcid=' + qcid + '&id=' + id;
        });

    });
    $(document).ready(function() {
        var table = $('#table_confirm').DataTable({
            "columns": [{
                    "data": null,
                    "defaultContent": "<button class='view-btn btn btn-info'>รายละเอียด</button>"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='success-btn btn btn-success'>เสร็จสิ้น</button>"
                },
                {
                    "data": "BG_ID"
                },
                {
                    "data": "BUDGETPLAN_NAME"
                },
                {
                    "data": "STATUS"
                },
                {
                    "data": "RESPONSIBLE"
                },
                {
                    "data": "TELEPHONE_RES"
                }
            ],
            'order': [],
            "processing": true,
            // "serverSide": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "ทั้งหมด"]
            ],
            dom: 'lrfBtip',
            colReorder: true,
            stateSave: true,
            select: true,
            color: '#ed80b3',
            buttons: {
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-primary btn-sm'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-primary btn-sm'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-primary btn-sm',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-primary btn-sm'
                    },
                ]
            },
            "oLanguage": {
                "sLengthMenu": "แสดง _MENU_ รายการ ต่อหน้า",
                "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการ",
                "sSearch": "ค้นหา :",
                "oPaginate": {
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "scrollY": "200px",
                    "paging": false,
                }
            }
        });

        $('#table_confirm tbody').on('click', '.view-btn', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data.BG_ID; // ดึงค่า ID จากคอลัมน์ที่สาม
            alert('แก้ไข ลำดับที่: ' + 'ID:' + id);

            // window.location.href = '../pages/edit.php';
            window.location.href = '../pages/edit.php?id=' + id;
            // window.location.href = 'views/edit.php?id=' + id;
        });
        // $('#table_correctpt tbody').on('click', '.edit-btn', function() {
        //     var data = table.row($(this).parents('tr')).data();
        //     var id = data.BG_ID; // ดึงค่า ID จากคอลัมน์ที่สาม
        //     alert('แก้ไข ลำดับที่: ' + 'ID:' + id);

        //     fetch('https://data.rajavithi.go.th/production/API/research/filterID', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'Authorization': 'Bearer YOUR_TOKEN' // ถ้ามีการใช้ Token สำหรับการยืนยันตัวตน
        //             },
        //             body: JSON.stringify({
        //                 id: id
        //             }) // ส่งข้อมูลในรูปแบบ JSON
        //         })
        //         .then(response => response.json()) // แปลงการตอบกลับจาก API เป็น JSON
        //         .then(data => {
        //             console.log('Success:', data);
        //             // ทำอะไรบางอย่างกับข้อมูลที่ได้รับจาก API
        //             // เช่น การเปลี่ยนแปลงหน้าที่มีการแสดงข้อมูล
        //             window.location.href = '../pages/edit.php'; // เปลี่ยน URL ตามต้องการ
        //         })
        //         .catch((error) => {
        //             console.error('Error:', error);
        //         });
        // });

        $('#table_confirm tbody').on('click', '.success-btn', function() {
            var data = table.row($(this).parents('tr')).data();
            // var qcid = data.QC_id; // ดึงค่า ID จากคอลัมน์ที่สาม
            var id = data.BG_ID; // ดึงค่า ID จากคอลัมน์ที่สาม
            // window.location.href = 'views/delete.php?id=' + qc_id;

            // delete_QCline(id, qc_id);
            // เพิ่มโค้ดสำหรับการลบข้อมูลที่นี่
            // alert('ลบข้อมูล ลำดับที่: '+ qc_id + ' ' + 'ID:' + id);
            alert('Update สถานะโครงการ ลำดับที่: ' + 'ID:' + id);
            // window.location.href = 'views/delete.php?qcid=' + qcid + '&id=' + id;
        });

    });
</script>