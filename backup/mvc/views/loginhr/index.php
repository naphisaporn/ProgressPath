<?php 	
session_start();
require 'connect/class_webservice.php';


if (!isset($_SESSION['IDNo'])) {
	header("Location: https://data.rajavithi.go.th/app/progresspath/mvc/views/loginhr/login/loginHR.php");
	exit;
}




// echo $_SESSION['IDNo'].$_SESSION['Position'].$_SESSION['LevelID'];

?>
<a href="login/logoutHR.php">ออกจากระบบ</a>
