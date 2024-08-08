
	<?php
	include('api.php');

	$url_requestdata_researchdetail = "https://data.rajavithi.go.th/production/API/research_detail/researchdetail";
	$body_researchdetail = array("start" => $start, "end" => $end);
	$rq_data_researchdetail = getdata($url_requestdata_researchdetail, $login2, $body_researchdetail);

	// $data = array(
	// 						array('Name'=>'parvez', 'Empid'=>11, 'Salary'=>101),
	// 						array('Name'=>'alam', 'Empid'=>1, 'Salary'=>102),
	// 						array('Name'=>'phpflow', 'Empid'=>21, 'Salary'=>103)							);
	$data = $rq_data_researchdetail;
             

	$results = array(
			"sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
          "aaData"=>$data);
/*while($row = $result->fetch_array(MYSQLI_ASSOC)){
  $results["data"][] = $row ;
}*/

echo json_encode($results , JSON_UNESCAPED_UNICODE);
	?>
	