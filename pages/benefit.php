<div class="form-group py-3">

    <input type="text" class="form-control" id="benefit" name="benefit[]" placeholder="เพิ่มประโยชน์" required>
    <div id="benefitList" class="mt-2"></div>
    <!-- <div class="vbenefitrs mt-2">

                                        </div> -->
    <button type="button" id="addBenefit" class="btn btn-outline-info mt-2">เพิ่มประโยชน์</button>
    <button type="button" id="Benefitsucces" class="btn btn-outline-info mt-2">บันทึกข้อมูล</button>
</div>

<script>
    $(document).ready(function() {

        $('#addBenefit').on('click', function() {
            var newBenefit = '<input type="text" class="form-control mt-2" name="benefit[]" placeholder="กรอก ประโยชน์ที่ได้รับ">';
            $('#benefitList').append(newBenefit);
        });
        $('#Benefitsucces').on('click', function() {
            alert('บันทึกข้อมูลสำเร็จ');
        });


    });
</script>