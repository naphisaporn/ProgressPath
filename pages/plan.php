<style scoped>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
        display: block;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    @media (max-width: 768px) {

        table,
        th,
        td {
            display: block;
            width: 100%;
        }

        th,
        td {
            box-sizing: border-box;
            display: block;
            width: 100%;
        }

        th,
        td {
            display: inline-block;
        }
    }

    .hidden {
        display: none;
    }

    .confirm-button {
        margin: 0;
        padding: 0;
        border: none;
        background: transparent;
        cursor: pointer;
    }

    .confirmed {
        color: green;
        font-weight: bold;
    }

    .select_months {
        width: 80%;
    }

    .eventtext {
        width: 80%;
    }

    .numtext {
        width: 80%;
    }

    .form_plan {
        text-align: -webkit-center;
    }

    .confirmed {
        color: green;
        font-weight: bold;
    }
</style>



<div class="container mt-4">
    <!-- <h1>Track Events and Expenses</h1> -->

    <!-- Form to enter new data -->
    <form id="eventForm">
        <div class="form-group form_plan">
            <div class="row">
                <div class="col-md-6">
                    <label for="year">ปี :</label>
                    <select id="year" name="year" class="form-control select_months" required>
                    </select><br><br>

                    <script>
                        const yearSelect = document.getElementById('year');
                        const currentYear = new Date().getFullYear();
                        for (let i = currentYear - 5; i <= currentYear + 5; i++) {
                            const option = document.createElement('option');
                            option.value = i + 543;
                            option.text = i + 543;
                            if (i === currentYear) {
                                option.selected = true;
                            }
                            yearSelect.appendChild(option);
                        }
                    </script>

                </div>
                <div class="col-md-6">
                    <label for="months">เดือน :</label>
                    <select id="months" name="months" class="form-control select_months" multiple required>
                        <option value="October">ตุลาคม</option>
                        <option value="November">พฤศจิกายน</option>
                        <option value="December">ธันวาคม</option>
                        <option value="January">มกราคม</option>
                        <option value="February">กุมภาพันธ์</option>
                        <option value="March">มีนาคม</option>
                        <option value="April">เมษายน</option>
                        <option value="May">พฤษภาคม</option>
                        <option value="June">มิถุนายน</option>
                        <option value="July">กรกฎาคม</option>
                        <option value="August">สิงหาคม</option>
                        <option value="September">กันยายน</option>
                    </select><br><br>

                </div>
            </div>





            <label for="eventName">ชื่อกิจกรรม :</label>
            <select id="eventName" name="eventName" class="form-control eventtext" style="display: none;">
                Options will be added dynamically
            </select>
            <input class="form-control eventtext" type="text" id="eventNameInput" name="eventNameInput" style="display: block;"><br><br>

            <label for="amount">จำนวนเงิน : </label>
            <input class="form-control numtext" type="number" id="amount" name="amount" required><br><br>

            <input class="btn btn-primary" type="submit" value="Add Event">
        </div>
    </form>

    <!-- Table to display the data -->
    <table id="eventsTable" class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>กิจกรรม</th>
                <th>ต.ค.</th>
                <th>พ.ย.</th>
                <th>ธ.ค.</th>
                <th>ม.ค.</th>
                <th>ก.พ.</th>
                <th>มี.ค.</th>
                <th>เม.ย.</th>
                <th>พ.ค.</th>
                <th>มิ.ย.</th>
                <th>ก.ค.</th>
                <th>ส.ค.</th>
                <th>ก.ย.</th>
                <th>รวม ( บาท )</th>
                <th>วันที่อัพเดตข้อมูลล่าสุด</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be added here -->
        </tbody>
        <tfoot>
            <tr>
                <td>รวมวงเงิน ( บาท ):</td>
                <td colspan="12"></td>
                <td id="totalAmount" colspan="2">0</td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const isAdmin = true; // Set this to false for non-admin users

        // แสดงตารางทันทีที่โหลดหน้าเพจ
        document.getElementById('eventsTable').classList.remove('hidden');

        // Handle form submission
        document.getElementById('eventForm').addEventListener('submit', function(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มตามปกติ

            const selectedOptions = Array.from(document.querySelectorAll('#months option:checked'));
            const selectedMonths = selectedOptions.map(option => option.value);
            const eventNameInput = document.getElementById('eventNameInput');
            const eventName = eventNameInput ? eventNameInput.value.trim() : '';
            const amountInput = document.getElementById('amount');
            const amount = amountInput ? parseFloat(amountInput.value) : NaN;

            // ตรวจสอบว่ามีข้อมูลครบถ้วน
            if (selectedMonths.length === 0) {
                alert("กรุณาเลือกเดือนอย่างน้อยหนึ่งเดือน.");
                return;
            }

            if (!eventName) {
                alert("กรุณากรอกชื่อกิจกรรม.");
                return;
            }

            if (isNaN(amount) || amount <= 0) {
                alert("กรุณากรอกจำนวนเงินที่ถูกต้อง.");
                return;
            }

            // หากข้อมูลครบถ้วน, ดำเนินการเพิ่มหรืออัปเดตข้อมูล
            const tableBody = document.querySelector('#eventsTable tbody');
            let eventRow = Array.from(tableBody.rows).find(row => row.cells[0].textContent === eventName);

            if (eventRow) {
                // อัปเดตแถวที่มีอยู่
                selectedMonths.forEach(month => {
                    const monthIndex = {
                        October: 1,
                        November: 2,
                        December: 3,
                        January: 4,
                        February: 5,
                        March: 6,
                        April: 7,
                        May: 8,
                        June: 9,
                        July: 10,
                        August: 11,
                        September: 12
                    } [month];

                    const cell = eventRow.cells[monthIndex];
                    cell.innerHTML = `* ${isAdmin ? ' <button class="confirm-button">Confirm</button>' : ''}`;

                    // อัปเดตยอดรวม
                    const currentTotal = parseFloat(eventRow.cells[13].textContent);
                    eventRow.cells[13].textContent = (currentTotal + amount).toFixed(2);
                });

                // อัปเดตเวลาที่อัปเดตล่าสุด
                const now = new Date();
                eventRow.cells[14].textContent = now.toLocaleString();
            } else {
                // เพิ่มแถวใหม่หากไม่มีแถวที่ตรงกัน
                const newRow = tableBody.insertRow();
                newRow.insertCell(0).textContent = eventName;
                for (let i = 1; i <= 12; i++) {
                    newRow.insertCell(i).textContent = '';
                }
                newRow.insertCell(13).textContent = amount.toFixed(2);
                newRow.insertCell(14).textContent = new Date().toLocaleString();
                const actionsCell = newRow.insertCell(15);
                actionsCell.innerHTML = `
                <button class="edit-button">Edit</button>
                <button class="delete-button">Delete</button>
            `;

                requestAnimationFrame(() => {
                    updateTotalAmount();
                    updateEventNameDropdown(eventName);
                    document.getElementById('eventForm').reset();
                    document.getElementById('months').selectedIndex = -1;
                });

            }

            setTimeout(() => {
                updateTotalAmount();
                updateEventNameDropdown(eventName);
                document.getElementById('eventForm').reset();
                document.getElementById('months').selectedIndex = -1;
            }, 0)
        });

        // Handle button clicks
        document.querySelector('#eventsTable').addEventListener('click', event => {
            const target = event.target;

            if (target.classList.contains('confirm-button')) {
                const cell = target.parentNode;
                if (cell.innerHTML.includes('*')) {
                    cell.innerHTML = '<span class="confirmed">✔</span>';
                    cell.classList.add('confirmed');
                } else {
                    alert("This month is not marked.");
                }
            } else if (target.classList.contains('edit-button')) {
                const row = target.closest('tr');
                const eventName = row.cells[0].textContent;
                const amount = parseFloat(row.cells[13].textContent);

                // กรอกข้อมูลในฟอร์มด้วยค่าปัจจุบัน
                const eventNameSelect = document.getElementById('eventName');
                eventNameSelect.style.display = 'none'; // ซ่อน dropdown
                const eventNameInput = document.querySelector('.eventtext');
                eventNameInput.style.display = 'block'; // แสดง input
                eventNameInput.value = eventName;

                // ตั้งค่าคุณสมบัติของเดือนที่เลือก
                const selectedMonths = Array.from(row.cells).slice(1, 13).map((cell, index) => cell.textContent.includes('*') ? Object.keys({
                    1: 'October',
                    2: 'November',
                    3: 'December',
                    4: 'January',
                    5: 'February',
                    6: 'March',
                    7: 'April',
                    8: 'May',
                    9: 'June',
                    10: 'July',
                    11: 'August',
                    12: 'September'
                })[index] : null).filter(month => month);

                const monthSelect = document.getElementById('months');
                Array.from(monthSelect.options).forEach(option => {
                    option.selected = selectedMonths.includes(option.value);
                });

            } else if (target.classList.contains('delete-button')) {
                if (confirm("Are you sure you want to delete this event?")) {
                    target.closest('tr').remove();
                    updateTotalAmount();
                }
            }
        });

        function updateTotalAmount() {
            const totalAmount = Array.from(document.querySelectorAll('#eventsTable tbody tr'))
                .reduce((total, row) => total + parseFloat(row.cells[13].textContent || 0), 0);
            document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
        }

        function updateEventNameDropdown(newEventName) {
            const eventNameSelect = document.getElementById('eventName');

            // ตรวจสอบว่า eventNameSelect มีการเลือกค่าอยู่แล้วหรือไม่
            if (!eventNameSelect) {
                console.error("ไม่พบ element สำหรับ 'eventName'");
                return;
            }

            // ตรวจสอบว่ามีตัวเลือกใน dropdown แล้ว
            const existingOptions = Array.from(eventNameSelect.options).map(option => option.value);

            // เพิ่มชื่อกิจกรรมใหม่ในดรอปดาวน์
            if (newEventName && !existingOptions.includes(newEventName)) {
                const newOption = document.createElement('option');
                newOption.value = newEventName;
                newOption.text = newEventName;
                eventNameSelect.appendChild(newOption);
            }

            // เปลี่ยนฟิลด์เป็นดรอปดาวน์
            eventNameSelect.style.display = 'block'; // ให้แสดง
            document.querySelector('.eventtext').style.display = 'none'; // ซ่อน input
        }
    });
</script>