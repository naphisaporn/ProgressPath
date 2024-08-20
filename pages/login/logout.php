<?php
session_start();
session_unset(); // ล้างข้อมูลเซสชัน
session_destroy(); // ทำลายเซสชัน

header('Location: https://data.rajavithi.go.th/app/progresspath/pages/login/login.html'); // เปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
exit();
