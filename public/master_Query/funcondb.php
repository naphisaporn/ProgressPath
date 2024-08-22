<?php
require_once('config.php');

class funcondb
{
	private $charset = "UTF8";
	private $rs;
	private $_fetch_array = array();
	private $_connOci = null;

	//ฟังชั่นเรียกใช้งานการเชื่อมต่อ rjvt
	public function ConOra($rjvtdb = false)
	{

		return $this->_connOci;
	}

	//ฟังชั่นเช็คค่าว่าสามารถเชื่อมต่อ Oracle ได้ไม
	private function con($user, $pass, $host)
	{
		$conn = oci_connect($user, $pass, $host, 'AL32UTF8');
		if ($conn == true) {
			//	echo 'Connection pass';
			return $conn;
		} else {
			return false;
		}
	}

	//เช็คการเชื่อมต่อ ORacle
	public function ChkConnOra()
	{
		if ($this->con(DB_USER, DB_PASS, DB_HOST) == true) {
			$this->_connOci = $this->con(DB_USER, DB_PASS, DB_HOST);
			//echo "เชื่อมต่อสำเร็จ".DB_USER;
		} else {
			$e = oci_error();   // For oci_connect errors pass no handle
			echo htmlentities($e['message']);
			echo "NO!!";
			return FALSE;
		}

		// if($this->con(DB_USER2, DB_PASS2, DB_HOST2) == true)
		// {
		// 	$this->_connOci2 = $this->con(DB_USER2, DB_PASS2, DB_HOST2);
		// 	//echo "เชื่อมต่อสำเร็จ2".DB_USER2;
		// }
		// else
		// {
		// 	$e = oci_error();   // For oci_connect errors pass no handle
		// 	echo htmlentities($e['message']);
		// 	echo "NO!!";
		// 	return FALSE;
		// }
		// // if($this->con(DB_USER3, DB_PASS3, DB_HOST3) == true)
		// // {
		// // 	$this->_connOci3 = $this->con(DB_USER3, DB_PASS3, DB_HOST3);
		// // }
		// // else
		// // {
		// // 	$e = oci_error();   // For oci_connect errors pass no handle
		// // 	echo htmlentities($e['message']);
		// // 	echo "NO!!";
		// // 	return FALSE;
		// // }
		// if($this->con(DB_USER4, DB_PASS4, DB_HOST4) == true)
		// {
		// 	$this->_connOci4 = $this->con(DB_USER4, DB_PASS4, DB_HOST4);
		// }
		// else
		// {
		// 	$e = oci_error();   // For oci_connect errors pass no handle
		// 	echo htmlentities($e['message']);
		// 	echo "NO!!";
		// 	return FALSE;
		// }
	}

	//คิวรี่ข้อมูล ต้องส่งค่า true == $rjvtdb
	public function queryOci($strsql, $rjvtdb = false)
	{
		if ($this->_connOci != true) {
			$this->ChkConnOra();
		}
		$result = oci_parse($this->ConOra($rjvtdb), $strsql);
		$exec  = oci_execute($result);
		$this->rs = $result;
		if (!$exec) {
			$e = oci_error($result);
			print htmlentities($e['message']);
			print "\n<pre>\n";
			print htmlentities($e['sqltext']);
			printf("\n%" . ($e['offset'] + 1) . "s", "^");
			print  "\n</pre>\n";
		}
		oci_close($this->ConOra($rjvtdb));
		$this->Clear();
	}

	//นำข้อมูลที่คิวรี่ออกมาแปลใส่ลง Array 
	public function fetch_array()
	{
		if (count($this->_fetch_array) > 0) {
			return $this->_fetch_array;
		} else {
			while (($row = oci_fetch_assoc($this->rs)) != FALSE) {
				//array_push($this->_fetch_array,$row);
				$this->_fetch_array[] = $row;
				//print_r($row);
			}
			return $this->_fetch_array;
		}
	}

	//จำนวน ROwS ที่คิวรี่ แต่ต้องใช้ฟังชั่น fetch_array() นี่ก่อน
	public function num_rows()
	{
		return oci_num_rows($this->rs);
	}

	/**** function commit record ****/
	private function fncCommit()
	{
		return oci_commit($this->ConOra());
	}

	/**** function rollback record ****/
	private function fncRollBack()
	{
		return oci_rollback($this->ConOra());
	}

	//ฟังชั่น Insert ข้อมูล
	public function insertRecord($sql, $rjvtdb = false)
	{
		$this->ChkConnOra();
		$objParse = oci_parse($this->ConOra($rjvtdb), $sql);
		$objExecute = oci_execute($objParse);
		// print_r($objExecute);
		if ($objExecute) {
			$this->fncCommit();
			// echo "text1";
		} else {
			$e = oci_error($objParse);  // For oci_execute errors pass the statement handle
			echo htmlentities($e['message']);
			$this->fncRollBack();
			//echo "text2";
		}
		oci_close($this->ConOra($rjvtdb));
		return $objExecute;
	}

	//ฟังชั่น  UPDATE ข้อมูล
	public function updateRecord($sql, $rjvtdb = false)
	{
		$this->ChkConnOra();
		$objParse = oci_parse($this->ConOra($rjvtdb), $sql);
		$objExecute = oci_execute($objParse);
		if ($objExecute) {
			$this->fncCommit();
			// echo "text5";
		} else {
			$this->fncRollBack();
		}
		oci_close($this->ConOra($rjvtdb));
		return $objExecute;
	}

	//ฟังชั่น  Delet ข้อมูล
	public function deleteRecord($sql, $rjvtdb = false)
	{
		$this->ChkConnOra();
		$objParse = oci_parse($this->ConOra($rjvtdb), $sql);
		$objExecute = oci_execute($objParse, OCI_DEFAULT);
		if ($objExecute) {
			$this->fncCommit();
		} else {
			$this->fncRollBack();
		}
		oci_close($this->ConOra($rjvtdb));
		return $objExecute;
	}

	/**** function select record ****/
	// public function SelectRecord($sql, $rjvtdb = false)
	// {
	// 	$this->ChkConnOra();
	// 	$objParse = oci_parse($this->ConOra($rjvtdb), $sql);
	// 	oci_execute($objParse, OCI_DEFAULT);
	// 	//return oci_fetch_array($objParse);
	// 	//print_r($objParse);
	// 	$res = array();
	// 	while (($row = oci_fetch_array($objParse)) != FALSE) {
	// 		$res[] = $row;
	// 	}
	// 	oci_close($this->ConOra($rjvtdb));
	// 	return $res;
	// }
	public function SelectRecord($sql, $rjvtdb = false)
	{
		// เช็คการเชื่อมต่อ
		$this->ChkConnOra();

		// เตรียมคำสั่ง SQL
		$conn = $this->ConOra($rjvtdb);
		$objParse = oci_parse($conn, $sql);

		if (!$objParse) {
			$e = oci_error($conn);
			echo "OCI Parse Error: " . htmlentities($e['message']);
			return [];
		}

		// ดำเนินการคำสั่ง SQL
		$exec = oci_execute($objParse, OCI_DEFAULT);

		if (!$exec) {
			$e = oci_error($objParse);
			echo "OCI Execute Error: " . htmlentities($e['message']);
			oci_free_statement($objParse);
			oci_close($conn);
			return [];
		}

		// ดึงข้อมูล
		$res = [];
		while (($row = oci_fetch_assoc($objParse)) !== false) {
			$res[] = $row;
		}

		// ปล่อยทรัพยากร
		oci_free_statement($objParse);
		oci_close($conn);

		return $res;
	}


	//Clear ค่าตัวแปร
	private function Clear()
	{
		$this->_fetch_array = array();
	}

	public function ConvDate($dateX, $type)
	{
		$dateConv = "";
		if (($dateX != "") && ($dateX != null)) {
			if ($type == "th") {
				list($day, $month, $year) = split('[/.-]', $dateX);
				$ye = $year + 543;
				$dateConv = $day . '/' . $month . '/' . $ye;
			} elseif ($type == "en") {
				list($day, $month, $year) = split('[/.-]', $dateX);
				$ye = $year - 543;
				$dateConv = $day . '/' . $month . '/' . $ye;
			}
		}
		return $dateConv;
	}
}
