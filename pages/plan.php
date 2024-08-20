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

            <label for="eventName">ชื่อกิจกรรม :</label>
            <input class="form-control eventtext" type="text" id="eventName" name="eventName" required><br><br>

            <label for="amount">จำนวนเงิน : </label>
            <input class="form-control numtext" type="number" id="amount" name="amount" required><br><br>

            <input class="btn btn-primary" type="submit" value="Add Event">
        </div>
    </form>

    <!-- Table to display the data -->
    <table id="eventsTable" class="table table-striped table-bordered mt-4 hidden">
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
    // Simulate user role
    document.addEventListener('DOMContentLoaded', () => {
        const isAdmin = true; // Set this to false for non-admin users

        // Handle form submission
        document.getElementById('eventForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting normally

            const selectedOptions = Array.from(document.querySelectorAll('#months option:checked'));
            const selectedMonths = selectedOptions.map(option => option.value);
            const eventName = document.getElementById('eventName').value;
            const amount = parseFloat(document.getElementById('amount').value);

            if (selectedMonths.length > 0 && eventName && !isNaN(amount)) {
                const tableBody = document.querySelector('#eventsTable tbody');
                let eventRow = Array.from(tableBody.rows).find(row => row.cells[0].textContent === eventName);

                if (eventRow) {
                    // Update existing row
                    eventRow.cells[0].textContent = eventName;

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
                        cell.innerHTML = `*${isAdmin ? ' <button class="confirm-button">Confirm</button>' : ''}`;

                        // Update total amount
                        const currentTotal = parseFloat(eventRow.cells[13].textContent);
                        eventRow.cells[13].textContent = (currentTotal + amount).toFixed(2);
                    });

                    // Update last updated timestamp
                    const now = new Date();
                    eventRow.cells[14].textContent = now.toLocaleString();
                } else {
                    // Add new row if it doesn't exist
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
                }

                updateTotalAmount();
                document.getElementById('eventForm').reset();
                document.getElementById('months').selectedIndex = -1;
                document.getElementById('eventsTable').classList.remove('hidden');
            } else {
                alert("Please fill out all fields.");
            }
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

                // Populate the form with the current values
                document.getElementById('eventName').value = eventName;
                document.getElementById('amount').value = amount;

                // Set the selected months
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
    });
</script>