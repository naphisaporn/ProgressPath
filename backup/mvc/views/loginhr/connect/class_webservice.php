<?php

class Webservice {

//// บุคคลากร
	public function hr_user()
		{	
		$url = 'https://hrws.rajavithi.go.th/mvc/human/xhrGetPersonal/'.$_SESSION['IDNo'];
	    $utoken = md5($_SESSION['IDNo']);
	    $ptoken = $_SESSION['ID'];
		$IDNo = $_SESSION['IDNo'];
		$tmptoken = md5(substr($IDNo, 0, 4) . date("Ymd") . 'rjvt');



	    $data = array('utoken' => $utoken,
	         'ptoken' => $ptoken,
			 'IDNo' => $IDNo,
	         'tmptoken' => $tmptoken	 
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
	    $objResult = (array) json_decode($result);
	    return   $objResult;
			
	}

//// บุคคลากรอื่น
	public function hr_otheruser()
		{	
		$url = 'https://hrws.rajavithi.go.th/mvc/human/xhrGetPersonal/'.$_GET['IDNo'];
		
	    $options = array(
	        'http' => array(
	            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
	            'method' => 'GET'
	        )
	    );
	    $context = stream_context_create($options);
	    $result = file_get_contents($url, false, $context);
	    $objResult = (array) json_decode($result);
	    return   $objResult;
			
	}
	
//// งาน
	public function hr_hrper($DivCode,$SectCode)
		{	
		$url = 'https://hrws.rajavithi.go.th/mvc/commander/xhrGetDivLst';
	    $utoken = md5($_SESSION['IDNo']);
	    $ptoken = $_SESSION['ID'];
		$tmptoken = md5(substr($_SESSION['IDNo'], 0, 4) . date("Ymd") . 'rj@va');		
		$prm_div = $DivCode;
		$prm_sec = $SectCode;
		
		 //echo $_SESSION['ID'] ."<br>";
		 //echo md5($_SESSION['IDNo']) ."<br>";
		 //echo $tmptoken ."<br>";


	    $data = array('utoken' => $utoken,
	         'ptoken' => $ptoken,
	         'tmptoken' => $tmptoken,
			 'prm_div' => $DivCode,
			 'prm_sec' => $SectCode,
			 'prm_subsec' => '00',
			 'prm_worksite' => '00'
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
	    return   $objResult;
		
	 //echo $result;
	 //echo $objResult->IDNo;
	 //print_r($objResult);
	 //exit();		
	}

//// กลุ่มภารกิจ
	public function hr_div()
		{	
		$url = 'https://hrws.rajavithi.go.th/injection_service/view_hrper/hr_div';
	    $utoken = 'hrperrjvt';
	    $ptoken = 'be6c233ba9d0578637772e4657563d53';
		$IDNo = $_SESSION['IDNo'];
		$tmptoken = md5(substr($IDNo, 9, 4) . date("Ymd") . 'rjvt');

		
		 //echo $IDNo ."<br>";
		 //echo $tmptoken ."<br>";


	    $data = array('utoken' => $utoken,
	         'ptoken' => $ptoken,
			 'IDNo' => $IDNo,
	         'tmptoken' => $tmptoken	 
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
	    $objResult = (array) json_decode($result);
	    return   $objResult;


 	 //print_r($data);
	 //echo $result;
	 //echo $objResult->IDNo;
	 //print_r($objResult);
	 //exit();

	}


////กลุ่มงาน/ฝ่าย
	public function hr_sect()//$iddiv
		{	
		$url = 'https://hrws.rajavithi.go.th/injection_service/view_hrper/hr_sect';
	    $utoken = 'hrperrjvt';
	    $ptoken = 'be6c233ba9d0578637772e4657563d53';
		$IDNo = $_SESSION['IDNo'];
		$tmptoken = md5(substr($IDNo, 9, 4) . date("Ymd") . 'rjvt');

		
		 //echo $IDNo ."<br>";
		 //echo $tmptoken ."<br>";


	    $data = array('utoken' => $utoken,
	         'ptoken' => $ptoken,
	         'tmptoken' => $tmptoken,
			 'IDNo' => $IDNo/* ,
			 'iddiv' => $iddiv */
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
	    return   $objResult;
	}

////กลุ่มงาน/ฝ่าย
	public function hr_subsect()//$iddiv,$idsubsect
		{	
		$url = 'https://hrws.rajavithi.go.th/injection_service/view_hrper/hr_subsect';
	    $utoken = 'hrperrjvt';
	    $ptoken = 'be6c233ba9d0578637772e4657563d53';
		$IDNo = $_SESSION['IDNo'];
		$tmptoken = md5(substr($IDNo, 9, 4) . date("Ymd") . 'rjvt');

		
		 //echo $IDNo ."<br>";
		 //echo $tmptoken ."<br>";


	    $data = array('utoken' => $utoken,
	         'ptoken' => $ptoken,
	         'tmptoken' => $tmptoken,
			 'IDNo' => $IDNo/* ,
			 'iddiv' => $iddiv,
			 'idsubsect' => $idsubsect */
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
	    return   $objResult;
	}


	
}

?>