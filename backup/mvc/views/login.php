<?php
session_start();
define('LINE_API', "https://notify-api.line.me/api/notify");

$p = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? 'home';
if ($p === 'mim') {
    $p = 'home';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['txt_user']) && !empty($_POST['txt_pass'])) {
    $url = 'https://hrws.rajavithi.go.th/mvc/human/xhrGetDetailsx';
    $crn_idc = filter_input(INPUT_POST, 'txt_user', FILTER_SANITIZE_STRING);
    $nw_pwd = password_hash(filter_input(INPUT_POST, 'txt_pass', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT);
    $tmptoken = md5(substr($crn_idc, 0, 4) . date("Ymd") . 'rjvt');

    $data = [
        'utoken' => md5($crn_idc),
        'ptoken' => $nw_pwd,
        'tmptoken' => $tmptoken
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $objResult = json_decode($result);

    if ($result !== false && $objResult->json_result === "true") {
        $data_dt = $objResult->json_data;

        $_SESSION['login_log'] = "true";
        $_SESSION['IDNoMIM'] = $data_dt->IDNo;
        $_SESSION['ID'] = $nw_pwd;
        $_SESSION['FullName'] = $data_dt->FullName;
        $_SESSION['Age'] = $data_dt->Age;
        $_SESSION['Position'] = $data_dt->Position;
        $_SESSION['PersonType'] = $data_dt->PersonType;
        $_SESSION['Div_Code'] = $data_dt->Div_Code;
        $_SESSION['Div'] = $data_dt->Div;
        $_SESSION['Sect_Code'] = $data_dt->Sect_Code;
        $_SESSION['Sect'] = $data_dt->Sect;
        $_SESSION['Subsect_Code'] = $data_dt->Subsect_Code;
        $_SESSION['Subsect'] = $data_dt->Subsect;
        $_SESSION['Worksite_Code'] = $data_dt->Worksite_Code;
        $_SESSION['Boss'] = $data_dt->Boss;
        $_SESSION['LevelID'] = $data_dt->LevelID;

        $message = "\nตำแหน่ง: " . $_SESSION['Position'] . "\nงาน: " . $_SESSION['Subsect'] . "\nกลุ่มงาน: " . $_SESSION['Sect'];
        $token = "piAomYpgs6bV03aMZ1k94Gu6YXfe9VuoxJ7cvBDA2lu";
        notify_message($message, $token);

        echo "<script>window.location.href = 'https://data.rajavithi.go.th/app/progresspath?p={$p}';</script>";
    } else {
        echo "<script>alert('เลขบัตรประชาชน/รหัสผ่านไม่ถูกต้อง ตรวจสอบก่อนเข้าสู่ระบบอีกครั้ง');</script>";
    }
}

function notify_message($message, $token) {
    $queryData = http_build_query(['message' => $message], '', '&');
    $headerOptions = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                        "Authorization: Bearer {$token}\r\n" .
                        "Content-Length: " . strlen($queryData) . "\r\n",
            'content' => $queryData
        ],
    ];
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API, false, $context);
    return json_decode($result);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <meta name="author" content="">
    <title>MIM - Login</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Athiti:wght@200&display=swap" rel="stylesheet">

    <style>
        input[type=button], input[type=submit], input[type=reset]  {
            font-size: 14px!important;
            -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
            box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
            -webkit-border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
            background-color: #6610f2;
        }

        input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
            transform: scale(0.95);
        }

        input[type=text], input[type=password] {
            font-size: 14px!important;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px;
        }

        input[type=text]:focus, input[type=password]:focus {
            background-color: #fff;
            border-bottom: 2px solid #5fbae9;
        }

        input[type=text]::placeholder, input[type=password]::placeholder {
            color: #cccccc;
        }

        .fadeIn {
            opacity: 0;
            animation: fadeIn ease-in 2s forwards;
        }

        .fadeIn.first { animation-delay: 0.6s; }
        .fadeIn.second { animation-delay: 0.8s; }
        .fadeIn.third { animation-delay: 1s; }
        .fadeIn.fourth { animation-delay: 1.2s; }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center fadeIn" style="padding-top: 15%; font-family: 'Athiti', sans-serif;">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="mim_logo.png" width="80%"><hr><br>
                                    </div>
                                    <div class="text-center">เข้าระบบโดยใช้รหัสผ่านระบบข้อมูลบุคลากร</div><br>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" name="txt_user" id="txt_user" maxlength="13" autocomplete="off" class="form-control form-control-user" placeholder="เลขบัตรประชาชน" style="text-align: center; font-weight: bold;">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="txt_pass" id="txt_pass" placeholder="รหัสผ่าน" style="text-align: center; font-weight: bold;">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="เข้าสู่ระบบ">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
</body>
</html>
