<style scoped>
    .container {
        margin-top: 20px;
    }

    .save-button,
    .add-button {
        margin-top: 10px;
    }

    .edit-button,
    .delete-button {
        margin: 0 5px;
    }
</style>

<div class="container">
    <table class="table table-striped table-bordered" id="goalTable">
        <thead>
            <tr>
                <th scope="col">เป้าหมาย</th>
                <th scope="col">ตัวชี้วัดความสำเร็จ</th>
                <th scope="col">ค่าเป้าหมาย</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Initial rows will be here -->
        </tbody>
    </table>
    <button class="btn btn-primary add-button" id="addBt">เพิ่มข้อ</button>
    <button class="btn btn-primary save-button" id="saveBt">บันทึก</button>

    <!-- Form to add or edit goal -->
    <div id="newGoalForm" style="display: none; margin-top: 20px;">
        <h3 id="formTitle">เพิ่มเป้าหมาย</h3>
        <form id="goalForm">
            <div class="form-group">
                <label for="goalCategory">เลือกเป้าหมาย:</label>
                <select class="form-control" id="goalCategory" required>
                    <option value="">เลือก...</option>
                    <option value="เป้าหมายเชิงผลผลิต ( Output )">เป้าหมายเชิงผลผลิต ( Output )</option>
                    <option value="เป้าหมายเชิงผลลัพธ์ ( Outcome )">เป้าหมายเชิงผลลัพธ์ ( Outcome )</option>
                    <option value="เป้าหมายเชิงผลกระทบ ( Impact )">เป้าหมายเชิงผลกระทบ ( Impact )</option>
                </select>
            </div>
            <div class="form-group" id="quantitativeGroup">
                <label for="quantitative">เชิงปริมาณ :</label>
                <input type="text" class="form-control" id="quantitative" />
            </div>
            <div class="form-group" id="qualitativeGroup">
                <label for="qualitative">เชิงคุณภาพ :</label>
                <input type="text" class="form-control" id="qualitative" />
            </div>
            <div class="form-group" id="impactGroup" style="display: none;">
                <label for="impactDetails">รายละเอียด (เชิงผลกระทบ) :</label>
                <textarea class="form-control" id="impactDetails" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="goalPercentage">ค่าเป้าหมาย (%) :</label>
                <input type="number" class="form-control" id="goalPercentage" step="0.1" min="0" max="100" />
            </div>
            <input type="hidden" id="editIndex" />
            <button type="button" class="btn btn-primary" id="submitGoal">เพิ่ม</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addButton = document.getElementById('addBt');
        const saveButton = document.getElementById('saveBt');
        const goalTable = document.getElementById('goalTable').getElementsByTagName('tbody')[0];
        const newGoalForm = document.getElementById('newGoalForm');
        const goalForm = document.getElementById('goalForm');
        const submitGoal = document.getElementById('submitGoal');
        const goalCategory = document.getElementById('goalCategory');
        const quantitative = document.getElementById('quantitative');
        const qualitative = document.getElementById('qualitative');
        const impactDetails = document.getElementById('impactDetails');
        const goalPercentage = document.getElementById('goalPercentage');
        const editIndex = document.getElementById('editIndex');

        // Toggle new goal form visibility
        addButton.addEventListener('click', () => {
            resetForm();
            newGoalForm.style.display = 'block';
        });

        // Show or hide input fields based on goal type selection
        goalCategory.addEventListener('change', () => {
            const selectedGoal = goalCategory.value;
            if (selectedGoal === 'เป้าหมายเชิงผลกระทบ ( Impact )') {
                document.getElementById('quantitativeGroup').style.display = 'none';
                document.getElementById('qualitativeGroup').style.display = 'none';
                document.getElementById('impactGroup').style.display = 'block';
            } else {
                document.getElementById('quantitativeGroup').style.display = 'block';
                document.getElementById('qualitativeGroup').style.display = 'block';
                document.getElementById('impactGroup').style.display = 'none';
            }
        });

        // Add new goal row to the table
        submitGoal.addEventListener('click', () => {
            const selectedGoal = goalCategory.value.trim();
            const quant = quantitative.value.trim();
            const qual = qualitative.value.trim();
            const impact = impactDetails.value.trim();
            const percentage = goalPercentage.value.trim();

            if (selectedGoal) {
                let valueToInsert = selectedGoal;
                if (selectedGoal === 'เป้าหมายเชิงผลกระทบ ( Impact )') {
                    if (!impact) {
                        alert("กรุณากรอกรายละเอียดเชิงผลกระทบ");
                        return;
                    }
                    valueToInsert += ` - รายละเอียด: ${impact}`;
                } else {
                    if (!quant || !qual) {
                        alert("กรุณากรอกข้อมูลให้ครบถ้วน");
                        return;
                    }
                    valueToInsert += ` - เชิงปริมาณ: ${quant} - เชิงคุณภาพ: ${qual}`;
                }

                if (percentage === '' || isNaN(percentage) || percentage < 0 || percentage > 100) {
                    alert("กรุณากรอกค่าเป้าหมายเป็นเปอร์เซ็นต์ (0-100)");
                    return;
                }

                if (editIndex.value) { // Editing existing row
                    const row = goalTable.rows[editIndex.value];
                    row.cells[0].textContent = selectedGoal;
                    row.cells[1].textContent = valueToInsert;
                    row.cells[2].textContent = `${percentage}%`;
                    resetForm();
                } else {
                    const newRow = goalTable.insertRow();
                    newRow.insertCell(0).textContent = selectedGoal;
                    newRow.insertCell(1).textContent = valueToInsert;
                    newRow.insertCell(2).textContent = `${percentage}%`;
                    const actionsCell = newRow.insertCell(3);

                    // Edit and Delete buttons
                    const editButton = document.createElement('button');
                    editButton.className = 'btn btn-warning edit-button';
                    editButton.textContent = 'แก้ไข';
                    editButton.onclick = () => editRow(newRow.rowIndex);
                    actionsCell.appendChild(editButton);

                    const deleteButton = document.createElement('button');
                    deleteButton.className = 'btn btn-danger delete-button';
                    deleteButton.textContent = 'ลบ';
                    deleteButton.onclick = () => deleteRow(newRow.rowIndex);
                    actionsCell.appendChild(deleteButton);
                }

                resetForm();
            } else {
                alert("กรุณากรอกข้อมูลให้ครบถ้วน");
            }
        });

        // Save button event handler
        saveButton.addEventListener('click', () => {
            const rows = goalTable.getElementsByTagName('tr');
            let valid = true;
            const categoryCount = {};

            for (const row of rows) {
                const goalCategory = row.getElementsByTagName('td')[0].textContent.trim();
                const indicator = row.getElementsByTagName('td')[1].textContent.trim();
                const targetValue = row.getElementsByTagName('td')[2].textContent.trim();

                if (!goalCategory || !indicator || !targetValue) {
                    valid = false;
                    break;
                }

                categoryCount[goalCategory] = (categoryCount[goalCategory] || 0) + 1;
                if (categoryCount[goalCategory] > 5) {
                    valid = false;
                    break;
                }
            }

            if (valid) {
                const data = Array.from(rows).map(row => ({
                    goalCategory: row.getElementsByTagName('td')[0].textContent.trim(),
                    indicator: row.getElementsByTagName('td')[1].textContent.trim(),
                    targetValue: row.getElementsByTagName('td')[2].textContent.trim()
                }));
                console.log("Data to save:", data);
                alert("ข้อมูลถูกบันทึกเรียบร้อยแล้ว!");
            } else {
                alert("กรุณากรอกข้อมูลในทุกช่อง และตรวจสอบให้แน่ใจว่าไม่มีมากกว่า 5 ข้อในแต่ละประเภท");
            }
        });

        function editRow(rowIndex) {
            const row = goalTable.rows[rowIndex - 1]; // Adjust for zero-based index
            goalCategory.value = row.cells[0].textContent.trim();
            const details = row.cells[1].textContent.trim().split(' - ');
            if (details.length > 1) {
                if (details[1].startsWith('เชิงปริมาณ:')) {
                    quantitative.value = details[1].replace('เชิงปริมาณ: ', '');
                    qualitative.value = details[2].replace('เชิงคุณภาพ: ', '');
                    document.getElementById('impactGroup').style.display = 'none';
                } else if (details[1].startsWith('รายละเอียด:')) {
                    impactDetails.value = details[1].replace('รายละเอียด: ', '');
                    document.getElementById('quantitativeGroup').style.display = 'none';
                    document.getElementById('qualitativeGroup').style.display = 'none';
                    document.getElementById('impactGroup').style.display = 'block';
                }
            }
            goalPercentage.value = row.cells[2].textContent.trim().replace('%', '');
            editIndex.value = rowIndex - 1; // Adjust for zero-based index
            newGoalForm.style.display = 'block';
            document.getElementById('formTitle').textContent = 'แก้ไขเป้าหมาย';
        }

        function deleteRow(rowIndex) {
            if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?')) {
                goalTable.deleteRow(rowIndex - 1); // Adjust for zero-based index
            }
        }

        function resetForm() {
            goalForm.reset();
            goalCategory.value = '';
            quantitative.value = '';
            qualitative.value = '';
            impactDetails.value = '';
            goalPercentage.value = '';
            editIndex.value = '';
            document.getElementById('formTitle').textContent = 'เพิ่มเป้าหมาย';
            document.getElementById('quantitativeGroup').style.display = 'block';
            document.getElementById('qualitativeGroup').style.display = 'block';
            document.getElementById('impactGroup').style.display = 'none';
        }
    });
</script>