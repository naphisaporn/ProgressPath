<?php
session_start();
$p = $_GET['p'];
if($p == ''){
  $p = 'home';
} 


/* S-เปลี่ยนรหัสผ่าน */
if (strlen($_POST['txt_user']) > 0) {
	$url = 'https://hrws.rajavithi.go.th/mvc/human/xhrGetDetailsx';
    //$url = 'https://hrws.rajavithi.go.th/mvc/human/xhrGetPersonal/'.$_POST['txt_user'];
  $crn_idc = filter_input(INPUT_POST, 'txt_user', FILTER_SANITIZE_STRING);
  $nw_pwd = md5((filter_input(INPUT_POST, 'txt_pass', FILTER_SANITIZE_STRING)));
  $tmptoken = md5(substr($crn_idc, 0, 4) . date("Ymd") . 'rjvt');

	// echo md5($crn_idc) ."<br>";
	// echo $nw_pwd ."<br>";
	// echo $tmptoken ."<br>";

  $data = array('utoken' => md5($crn_idc)
    , 'ptoken' => $nw_pwd
    , 'tmptoken' => $tmptoken
  );

// use key 'http' even if you send the request to https://...
  $options = array(
    'http' => array(
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $objResult = (object) json_decode($result);


	 //echo $result;
	 //echo $objResult->IDNo;
	 //print_r($objResult);
	 //exit();


  if ($result === FALSE) { /* Handle error */
  } else {
    ?>
    <script type="text/javascript">
      <?php
      if ($objResult->json_result == "true") {

       $data_dt = $objResult->json_data;

       $_SESSION['login_log'] = "true";
			$_SESSION['IDNoMIM'] = $data_dt->IDNo; // รหัสบัตรประชาชน
            $_SESSION['ID'] = $nw_pwd; // รหัสบัตรประชาชน
			$_SESSION['FullName'] = $data_dt->FullName; //ชื่อ-สกุล
			$_SESSION['Age'] = $data_dt->Age; //อายุ
			
			
			$_SESSION['Position'] = $data_dt->Position; //ตำแหน่ง
			$_SESSION['PersonType'] = $data_dt->PersonType;//สังกัด
			
			$_SESSION['Div_Code'] = $data_dt->Div_Code;//รหัสกลุ่มภารกิจ
			$_SESSION['Div'] = $data_dt->Div;//ชื่อกลุ่มภารกิจ
			
			$_SESSION['Sect_Code'] = $data_dt->Sect_Code;//รหัสกลุ่มงาน
			$_SESSION['Sect'] = $data_dt->Sect;//ชื่อกลุ่มงาน
			
			$_SESSION['Subsect_Code'] = $data_dt->Subsect_Code;////รหัสหน่วยงาน
			$_SESSION['Subsect'] = $data_dt->Subsect;//ชื่อหน่วยงาน
			
			$_SESSION['Worksite_Code'] = $data_dt->Worksite_Code;//หอผู้ป่วย ศู่นย์
			
			$_SESSION['Boss'] = $data_dt->Boss;//ชื่อหัวหน้า
			$_SESSION['LevelID'] = $data_dt->LevelID;//ระดับผู้ใช้งาน

			
/*         if ($objResult->IDNo == $_POST['txt_user']) {
			
			
			$_SESSION['login_log'] = "true";
			$_SESSION['IDNo'] = $objResult->IDNo; // รหัสบัตรประชาชน
            $_SESSION['ID'] = $nw_pwd; // รหัสบัตรประชาชน
			$_SESSION['FullName'] = $objResult->FullName; //ชื่อ-สกุล
			$_SESSION['Age'] = $objResult->Age; //อายุ
			$_SESSION['Telephone'] = $objResult->Telephone; //เบอร์ติดต่อ
			$_SESSION['Gender'] = $objResult->Gender; //เพศ
			
			
			
			$_SESSION['Position'] = $objResult->Position; //ตำแหน่ง
			$_SESSION['PersonType'] = $objResult->PersonType;//สังกัด
			
			$_SESSION['Div_Code'] = $objResult->Div_Code;//รหัสกลุ่มภารกิจ
			$_SESSION['Div'] = $objResult->Div;//ชื่อกลุ่มภารกิจ
			
			$_SESSION['Sect_Code'] = $objResult->Sect_Code;//รหัสกลุ่มงาน
			$_SESSION['Sect'] = $objResult->Sect;//ชื่อกลุ่มงาน
			
			$_SESSION['Subsect_Code'] = $objResult->Subsect_Code;////รหัสหน่วยงาน
			$_SESSION['Subsect'] = $objResult->Subsect;//ชื่อหน่วยงาน
			
			$_SESSION['Worksite_Code'] = $objResult->Worksite_Code;//หอผู้ป่วย ศู่นย์
			
			$_SESSION['Boss'] = $objResult->Boss;//ชื่อหัวหน้า
			$_SESSION['LevelID'] = $objResult->LevelID;//ระดับผู้ใช้งาน */
      ?>
      window.location.href = 'https://api.rajavithi.go.th/APP/MIM/index.php?p=<?= $p; ?>';
      <?php
    } else {
      ?>
      alert('เข้าสู่ระบบล้มเหลว ตรวจสอบก่อนเข้าสู่ระบบอีกครั้ง');
      <?php
    }
    ?>
  </script>
  <?php
}
}
/* E-เปลี่ยนรหัสผ่าน */

?>


<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  <meta name="author" content="">
  <title>Login</title>

  <!-- Bootstrap Core CSS -->
  <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->
            <style type="text/css">


            /* BASIC */

            html {
              background-color: #56baed;
              min-width: 480px;
            }

            body {
             background-color: #56baed;

             font-family: "Poppins", sans-serif;
             height: 100vh;
           }

           a {
            color: #92badd;
            display:inline-block;
            text-decoration: none;
            font-weight: 400;
          }

          h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            display:inline-block;
            margin: 40px 8px 10px 8px; 
            color: #cccccc;
          }



          /* STRUCTURE */

          .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column; 
            justify-content: center;
            width: 100%;
            min-height: 100%;
            padding-top: 12%;
          }

          #formContent {
            -webkit-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            background: #fff;
            padding: 30px;
            width: 90%;
            max-width: 550px;
            position: relative;
            padding: 0px;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
            box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
            text-align: center;
          }


          #formFooter {
            background-color: #f6f6f6;
            border-top: 1px solid #dce8f1;
            padding: 25px;
            text-align: center;
            -webkit-border-radius: 0 0 10px 10px;
            border-radius: 0 0 10px 10px;
          }



          /* TABS */

          h2.inactive {
            color: #cccccc;
          }

          h2.active {
            color: #0d0d0d;
            border-bottom: 2px solid #5fbae9;
          }



          /* FORM TYPOGRAPHY*/

          input[type=button], input[type=submit], input[type=reset]  {
            background-color: #56baed;
            border: none;
            color: white;
            padding: 15px 80px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 13px;
            -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
            box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
            margin: 5px 20px 40px 20px;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
          }

          input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
            background-color: #39ace7;
          }

          input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
            -moz-transform: scale(0.95);
            -webkit-transform: scale(0.95);
            -o-transform: scale(0.95);
            -ms-transform: scale(0.95);
            transform: scale(0.95);
          }

          input[type=text] {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            width: 85%;
            border: 2px solid #f6f6f6;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
          }

          input[type=password] {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            width: 85%;
            border: 2px solid #f6f6f6;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
          }

          input[type=text]:focus {
            background-color: #fff;
            border-bottom: 2px solid #5fbae9;
          }

          input[type=password]:focus {
            background-color: #fff;
            border-bottom: 2px solid #5fbae9;
          }

          input[type=text]:placeholder {
            color: #cccccc;
          }



          /* ANIMATIONS */

          /* Simple CSS3 Fade-in-down Animation */
          .fadeInDown {
            -webkit-animation-name: fadeInDown;
            animation-name: fadeInDown;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
          }

          @-webkit-keyframes fadeInDown {
            0% {
              opacity: 0;
              -webkit-transform: translate3d(0, -100%, 0);
              transform: translate3d(0, -100%, 0);
            }
            100% {
              opacity: 1;
              -webkit-transform: none;
              transform: none;
            }
          }

          @keyframes fadeInDown {
            0% {
              opacity: 0;
              -webkit-transform: translate3d(0, -100%, 0);
              transform: translate3d(0, -100%, 0);
            }
            100% {
              opacity: 1;
              -webkit-transform: none;
              transform: none;
            }
          }

          /* Simple CSS3 Fade-in Animation */
          @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
          @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
          @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

          .fadeIn {
            opacity:0;
            -webkit-animation:fadeIn ease-in 1;
            -moz-animation:fadeIn ease-in 1;
            animation:fadeIn ease-in 1;

            -webkit-animation-fill-mode:forwards;
            -moz-animation-fill-mode:forwards;
            animation-fill-mode:forwards;

            -webkit-animation-duration:1s;
            -moz-animation-duration:1s;
            animation-duration:1s;
          }

          .fadeIn.first {
            -webkit-animation-delay: 0.4s;
            -moz-animation-delay: 0.4s;
            animation-delay: 0.4s;
          }

          .fadeIn.second {
            -webkit-animation-delay: 0.6s;
            -moz-animation-delay: 0.6s;
            animation-delay: 0.6s;
          }

          .fadeIn.third {
            -webkit-animation-delay: 0.8s;
            -moz-animation-delay: 0.8s;
            animation-delay: 0.8s;
          }

          .fadeIn.fourth {
            -webkit-animation-delay: 1s;
            -moz-animation-delay: 1s;
            animation-delay: 1s;
          }

          /* Simple CSS3 Fade-in Animation */
          .underlineHover:after {
            display: block;
            left: 0;
            bottom: -10px;
            width: 0;
            height: 2px;
            background-color: #56baed;
            content: "";
            transition: width 0.2s;
          }

          .underlineHover:hover {
            color: #0d0d0d;
          }

          .underlineHover:hover:after{
            width: 100%;
          }



          /* OTHERS */

          *:focus {
            outline: none;
          } 

          #icon {
            width:60%;
          }

          * {
            box-sizing: border-box;
          }


        </style>

      </head>
      <body>
        <div class="container">
          <div class="row">
            <div class="wrapper fadeInDown">
              <div id="formContent"><br>
                <img style="padding:5px;" src="mim_logo.png" width="350">
                <!-- Tabs Titles -->
                <!-- <h2 class="active"> กรุณาเข้าระบบโดยใช้รหัสผ่าน ระบบฐานข้อมูลบุคลากร</h2> -->
                <br><br><br>
                <!-- Login Form -->
                <form method="post">
                  <input  type="text" name="txt_user" id="txt_user" maxlength="13"  autocomplete="off" class="fadeIn second" placeholder="เลขบัตรประชาชน" OnKeyPress="return chkNumber(this)">
                  <input type="password" name="txt_pass" id="txt_pass" class="fadeIn third"  placeholder="รหัสผ่าน">

                  <input type="submit" class="fadeIn fourth" value="Log In">
                </form>

                <!-- Remind Passowrd -->
   <!--  <div id="formFooter">
      <a class="underlineHover" href="recover.php">ลืมรหัสผ่าน ?</a>
    </div> -->

  </div>
</div>
				<!-- <div class="container" style="margin: auto auto;">
					<div class="panel panel-default">
						<div class="panel-body">
							<div style="margin-top:30px;" class="col-xs-12 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
								<form class="form-signin" role="form" action="" method="post" >
									<h2 class="form-signin-heading text-center">ระบบข้อมูลบุคลากร โรงพยาบาลราชวิถี</h2>
									<h2 class="form-signin-heading text-center"><font color="red"></font></h2>
									<div class="form-group">
										<label>ชื่อผู้ใช้งาน : รหัสบัตรประชาชน</label> <font color="#9B9B9B"><b>ตัวอย่างเช่น</b>  3470200028652</font>
										<input type="text" name="txt_user" id="txt_user" maxlength="13" class="form-control col-lg-2" autocomplete="off" placeholder="รหัสบัตรประชาชน" value="1469900130400" required="" autofocus="">
									</div>
									<label>รหัสผ่าน </label> <font style="color:red;"><b>หากเข้าระบบเป็นครั้งแรก รหัสผ่านจะ default เป็นวันเกิด เช่น </b> 07112526</font>
									<input type="password" name="txt_pass" id="txt_pass" class="form-control" placeholder="รหัสผ่าน" value="11082534" required="">
									<br>
									<button class="btn btn-lg btn-primary btn-block" id="btn_login" type="submit">Sign in</button>
									<div>
										<a href="recover.php" id="login_lost_btn" type="button" class="btn btn-link">ลืมรหัสผ่าน? คลิกที่นี่</a>
										<a href="recover2.pdf" target="_blank" id="login_lost_btn" type="button" class="btn btn-link">คู่มือวิธีการกู้คืนรหัสผ่านด้วยตัวเอง</a>
									</div>
								</form>
							</div> -->
							<br>
							<br>
							<br>
						</div>
					</div>
				</div>

      </div>
    </div>

    <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
  </body>
  </html>
