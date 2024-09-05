<?php
//header.php
include('init.php');
session_start();
// echo 'Current session username: ' . (isset($_SESSION['username']) ? $_SESSION['username'] : 'No user');

// var_dump($_SESSION);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบข้อมูลล็อกอิน (ตัวอย่าง)
    if ($username === 'admin' && $password === 'password') { // ตัวอย่างการตรวจสอบ
        $_SESSION['username'] = $username;
        header('Location: https://data.rajavithi.go.th/app/progresspath/public/');
        exit();
    } else {
        $error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบติดตามโครงการ | ProgressPath</title>
    <link rel="shortcut icon" href="https://data.rajavithi.go.th/app/progresspath/mvc/assets/img/favicon.ico" type="image/x-icon">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            top: 100%;
            right: 0;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown.show .dropdown-content {
            display: block;
        }

        .dropdown .btn-login {
            background-color: #00bcd4;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropdown .btn-login:hover {
            background-color: #0097a7;
        }
    </style>
</head>

<body class="content">
    <div class="header">
        <div class="inner-header">
            <nav id="navbar" class="navbar navbar-expand-md navbar-dark">
                <div class="container justify-content-end">
                    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navLinks">
                        <div class="row" style="width: 100%;">
                            <div class="col-6">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="https://data.rajavithi.go.th/app/progresspath/public/" class="nav-link impactFont">หน้าหลัก</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/insertProject.php" class="nav-link impactFont">เพิ่มโครงการ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../pages/login/createUser.php" class="nav-link impactFont">สร้าง Account</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <div id="loginButton" class="dropdown">
                                    <button class="btn-login">
                                        <i class="fa-solid fa-person"></i> เข้าสู่ระบบ
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="https://data.rajavithi.go.th/app/progresspath/pages/login/logout.php" id="logoutLink">ออกจากระบบ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="title_head">
                <h1>ระบบติดตามโครงการ</h1>
                <h2>ProgressPath</h2>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getLoginStatus() {
                return new Promise((resolve) => {
                    resolve('<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : null; ?>');
                });
            }

            getLoginStatus().then(username => {
                const loginButton = document.getElementById('loginButton');
                const logoutLink = document.getElementById('logoutLink');
                if (loginButton) {
                    if (username) {
                        loginButton.querySelector('.btn-login').innerHTML = `<i class="fa-solid fa-person"></i> ${username}`;
                        loginButton.classList.add('logged-in');
                        loginButton.querySelector('.dropdown-content').style.display = 'block';
                        logoutLink.href = 'https://data.rajavithi.go.th/app/progresspath/pages/login/logout.php'; // Link to logout page
                    } else {
                        loginButton.querySelector('.btn-login').innerHTML = '<i class="fa-solid fa-person"></i> เข้าสู่ระบบ';
                        loginButton.classList.remove('logged-in');
                        loginButton.querySelector('.dropdown-content').style.display = 'none';
                    }
                } else {
                    console.error('ไม่พบปุ่มล็อกอิน');
                }
            }).catch(error => {
                console.error('ข้อผิดพลาดในการดึงสถานะการล็อกอิน:', error);
            });

            // Toggle dropdown on button click
            document.addEventListener('click', function(event) {
                const dropdown = document.querySelector('.dropdown');
                if (dropdown && event.target.closest('.btn-login')) {
                    dropdown.classList.toggle('show');
                } else {
                    dropdown.classList.remove('show');
                }
            });
        });
    </script>

</body>

</html>