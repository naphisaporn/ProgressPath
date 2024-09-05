<?php
include('../../include/init.php');

?>

<style scoped>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
        margin: 0;
    }

    .admin-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    h2 {
        margin-bottom: 20px;
    }

    .field {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .error-message {
        color: red;
        font-size: 12px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>


<div class="admin-box">
    <a href="https://data.rajavithi.go.th/app/progresspath/public/" class="btn btn-outline-info">
        กลับหน้าหลัก
    </a>

    <h2>Create New User</h2>
    <form id="create_user_form">
        <p class="field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required />
            <span id="username_error" class="error-message"></span>
        </p>
        <p class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
            <span id="password_error" class="error-message"></span>
        </p>
        <p class="field">
            <label for="department">กลุ่มงาน</label>
            <input type="text" id="department" name="department" required />
            <span id="department_error" class="error-message"></span>
        </p>
        <p class="field">
            <label for="job">งาน</label>
            <input type="text" id="job" name="job" required />
            <span id="job_error" class="error-message"></span>
        </p>
        <p class="field">
            <label for="full_name">ชื่อ - นามสกุล</label>
            <input type="text" id="full_name" name="full_name" required />
            <span id="full_name_error" class="error-message"></span>
        </p>
        <p class="field">
            <label for="usertype">ประเภท user</label>
            <select name="usertype" id="usertype">
                <option value="0">ผู้ดูแลระบบ</option>
                <option value="1">ฝ่ายแผน</option>
                <option value="2">หัวหน้างาน</option>
                <option value="3">หัวหน้ากลุ่มงาน</option>
                <option value="4">บุคลากรทั่วไป</option>
                <option value="5">ผู้อำนวยการโรงพยาบาล</option>
            </select>
        </p>
        <button type="submit" id="create_user_button">Create User</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#create_user_form").on("submit", function(event) {
            event.preventDefault();

            // Clear previous errors
            $(".error-message").text("");

            // Get form data
            var username = $("#username").val().trim();
            var password = $("#password").val().trim();
            var department = $("#department").val().trim();
            var job = $("#job").val().trim();
            var fullName = $("#full_name").val().trim();
            var userType = $("#usertype").val();

            // Simple validation
            var valid = true;
            if (username === "") {
                $("#username_error").text("Username is required.");
                valid = false;
            }
            if (password === "") {
                $("#password_error").text("Password is required.");
                valid = false;
            }
            if (department === "") {
                $("#department_error").text("Department is required.");
                valid = false;
            }
            if (job === "") {
                $("#job_error").text("Job is required.");
                valid = false;
            }
            if (fullName === "") {
                $("#full_name_error").text("Full name is required.");
                valid = false;
            }

            if (valid) {
                $.ajax({
                    url: 'https://data.rajavithi.go.th/app/progresspath/pages/login/class/admin/create-user.php',
                    method: 'POST',
                    contentType: 'application/json; charset=UTF-8', // ใช้ JSON แทนการเข้ารหัสที่แตกต่าง
                    data: JSON.stringify({
                        username: username,
                        password: password,
                        department: department,
                        job: job,
                        full_name: fullName,
                        usertype: userType
                    }),
                    success: function(response) {
                        try {
                            var result = JSON.parse(response);
                            if (result.success) {
                                alert('User created successfully!');
                                $('#create_user_form')[0].reset();
                            } else {
                                alert('Failed to create user: ' + result.error);
                            }
                        } catch (e) {
                            console.error('Failed to parse response:', e);
                            alert('An error occurred while processing your request.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        alert('An error occurred while processing your request.');
                    }
                });
            }
        });
    });
</script>