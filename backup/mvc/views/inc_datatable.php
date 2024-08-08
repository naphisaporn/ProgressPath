<script type="text/javascript">
    $(document).ready(function() {
        $('#table_correctpt').DataTable({
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

    });
</script>