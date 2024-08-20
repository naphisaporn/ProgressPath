<style scoped>
    .container {
        margin-top: 20px;
    }

    .save-button {
        margin-top: 10px;
    }

    .add-button {
        margin-top: 10px;
    }
</style>

<div class="container">
    <table class="table table-striped table-bordered" id="riskTable">
        <thead>
            <tr>
                <th scope="col">ประเด็นความเสี่ยง</th>
                <th scope="col">ความเสี่ยงที่อาจเกิดขึ้น</th>
                <th scope="col">มาตรการควบคุมความเสี่ยง</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Initial rows will be here -->
        </tbody>
    </table>
    <button class="btn btn-primary add-button" id="addButton">เพิ่มข้อ</button>
    <button class="btn btn-primary save-button" id="saveButton">บันทึก</button>

    <!-- Form to add or edit risk -->
    <div id="newRiskForm" style="display: none; margin-top: 20px;">
        <h3 id="formTitle">เพิ่มข้อมูลความเสี่ยง</h3>
        <form id="riskForm">
            <div class="form-group">
                <label for="riskCategory">เลือกประเด็นความเสี่ยง:</label>
                <select class="form-control" id="riskCategory" required>
                    <option value="">เลือก...</option>
                    <option value="1. ความเสี่ยงด้านกลยุทธ์ ( Strategic Risk )">1. ความเสี่ยงด้านกลยุทธ์ ( Strategic Risk )</option>
                    <option value="2. ความเสี่ยงด้านการเงิน ( Financial Risk )">2. ความเสี่ยงด้านการเงิน ( Financial Risk )</option>
                    <option value="3. ความเสี่ยงด้านการดำเนินงาน ( Operational Risk )">3. ความเสี่ยงด้านการดำเนินงาน ( Operational Risk )</option>
                    <option value="4. ความเสี่ยงด้านกฎหมาย หรือการปฏิบัติตามกฎระเบียบ ( Compliance Risk )">4. ความเสี่ยงด้านกฎหมาย หรือการปฏิบัติตามกฎระเบียบ ( Compliance Risk )</option>
                </select>
            </div>
            <div class="form-group">
                <label for="riskDescription">ความเสี่ยงที่อาจเกิดขึ้น:</label>
                <input type="text" class="form-control" id="riskDescription" required />
            </div>
            <div class="form-group">
                <label for="controlMeasure">มาตรการควบคุมความเสี่ยง:</label>
                <input type="text" class="form-control" id="controlMeasure" required />
            </div>
            <input type="hidden" id="editIndex" />
            <button type="button" class="btn btn-primary" id="submitRisk">เพิ่ม</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addButton = document.getElementById('addButton');
        const saveButton = document.getElementById('saveButton');
        const riskTable = document.getElementById('riskTable').getElementsByTagName('tbody')[0];
        const newRiskForm = document.getElementById('newRiskForm');
        const riskForm = document.getElementById('riskForm');
        const submitRisk = document.getElementById('submitRisk');
        const riskCategory = document.getElementById('riskCategory');
        const riskDescription = document.getElementById('riskDescription');
        const controlMeasure = document.getElementById('controlMeasure');
        const editIndex = document.getElementById('editIndex');
        let riskCount = {}; // To track the number of added rows by risk category

        // Initialize riskCount with empty values
        const initializeRiskCount = () => {
            riskCount['1. ความเสี่ยงด้านกลยุทธ์ ( Strategic Risk )'] = 0;
            riskCount['2. ความเสี่ยงด้านการเงิน ( Financial Risk )'] = 0;
            riskCount['3. ความเสี่ยงด้านการดำเนินงาน ( Operational Risk )'] = 0;
            riskCount['4. ความเสี่ยงด้านกฎหมาย หรือการปฏิบัติตามกฎระเบียบ ( Compliance Risk )'] = 0;
        };
        initializeRiskCount();

        // Toggle new risk form visibility
        addButton.addEventListener('click', () => {
            resetForm();
            newRiskForm.style.display = newRiskForm.style.display === 'none' ? 'block' : 'none';
        });

        // Add new risk row to the table
        submitRisk.addEventListener('click', () => {
            const selectedRisk = riskCategory.value.trim();
            const riskDesc = riskDescription.value.trim();
            const control = controlMeasure.value.trim();

            if (selectedRisk && riskDesc && control) {
                if (editIndex.value) { // Editing existing row
                    const row = riskTable.rows[editIndex.value];
                    row.cells[0].textContent = selectedRisk;
                    row.cells[1].textContent = riskDesc;
                    row.cells[2].textContent = control;
                    resetForm();
                } else if (riskCount[selectedRisk] < 5) { // Adding new row
                    riskCount[selectedRisk]++;
                    const newRow = riskTable.insertRow();
                    newRow.insertCell(0).textContent = selectedRisk;
                    newRow.insertCell(1).textContent = riskDesc;
                    newRow.insertCell(2).textContent = control;
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

                    resetForm();
                } else {
                    alert("ไม่สามารถเพิ่มข้อความเสี่ยงในประเภทนี้ได้เกิน 5 ข้อ");
                }
            } else {
                alert("กรุณากรอกข้อมูลให้ครบถ้วน");
            }
        });

        // Save button event handler
        saveButton.addEventListener('click', () => {
            const rows = riskTable.getElementsByTagName('tr');
            let valid = true;
            let count = {};

            for (const row of rows) {
                const riskCategory = row.getElementsByTagName('td')[0].textContent.trim();
                const riskDescription = row.getElementsByTagName('td')[1].textContent.trim();
                const controlMeasure = row.getElementsByTagName('td')[2].textContent.trim();

                if (!riskCategory || !riskDescription || !controlMeasure) {
                    valid = false;
                    break;
                }

                // Count risks per category
                count[riskCategory] = (count[riskCategory] || 0) + 1;
                if (count[riskCategory] > 5) {
                    valid = false;
                    break;
                }
            }

            if (valid) {
                const data = Array.from(rows).map(row => ({
                    riskCategory: row.getElementsByTagName('td')[0].textContent.trim(),
                    riskDescription: row.getElementsByTagName('td')[1].textContent.trim(),
                    controlMeasure: row.getElementsByTagName('td')[2].textContent.trim()
                }));
                console.log("Data to save:", data);
                alert("ข้อมูลถูกบันทึกเรียบร้อยแล้ว!");
            } else {
                alert("กรุณากรอกข้อมูลในทุกช่อง และตรวจสอบให้แน่ใจว่าไม่มีมากกว่า 5 ข้อในแต่ละประเภท");
            }
        });

        function editRow(rowIndex) {
            const row = riskTable.rows[rowIndex - 1]; // Adjust for zero-based index
            riskCategory.value = row.cells[0].textContent.trim();
            riskDescription.value = row.cells[1].textContent.trim();
            controlMeasure.value = row.cells[2].textContent.trim();
            editIndex.value = rowIndex - 1; // Adjust for zero-based index
            newRiskForm.style.display = 'block';
            document.getElementById('formTitle').textContent = 'แก้ไขข้อมูลความเสี่ยง';
        }

        function deleteRow(rowIndex) {
            if (confirm("คุณแน่ใจว่าต้องการลบข้อมูลนี้?")) {
                const row = riskTable.rows[rowIndex - 1]; // Adjust for zero-based index
                const riskType = row.cells[0].textContent.trim();
                riskTable.deleteRow(rowIndex - 1); // Adjust for zero-based index
                riskCount[riskType]--;
            }
        }

        function resetForm() {
            riskForm.reset();
            riskCategory.value = '';
            riskDescription.value = '';
            controlMeasure.value = '';
            editIndex.value = '';
            document.getElementById('formTitle').textContent = 'เพิ่มข้อมูลความเสี่ยง';
        }
    });
</script>