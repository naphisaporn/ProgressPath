<?php
function gettoken($url, $body, $header_option = null)
{
  $curl = curl_init();

  if (!is_null($header_option)) {
    $header[] = $header_option;
  }

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'utoken=Admin_BIintra&ptoken=BI%40Rjvt70!!',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/x-www-form-urlencoded'
    ),
  ));

  $response = curl_exec($curl);

  $data1 = json_decode($response);
  curl_close($curl);

  if ($data1->result == true) {
    return $data1->token;
  }
}

$url_login = "https://data.rajavithi.go.th/production/API/Get_Token/get_token_BIIntra";
$tokenmim = gettoken($url_login, $body);


function getdata($url, $token, $body)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $body,
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer ' . $token
    ),
  ));

  $response = curl_exec($curl);
  //  var_dump($response->token);
  $data1 = json_decode($response);
  curl_close($curl);
  if ($data1->result == true) {
    return $data1->jsondata;
  }
}

function API_ALLdata()
{
  global $tokenmim;
  $start = '09/08/2024';
  $end = '09/08/2024';


  $url_requestdata = "https://data.rajavithi.go.th/production/API/research/research";
  $body = array("start" => $start, "end" => $end);
  $rq_data = getdata($url_requestdata, $tokenmim, $body);

  return $rq_data;
}

function API_CHECKLOGIN($username, $password)
{
  // ตรวจสอบ JWT token
  $objPerson = $this->checkJWT();
  if (!$objPerson) {
    $responseArray = array(
      'result' => FALSE,
      'jsondata' => null,
      'message' => 'Invalid JWT token'
    );
    echo json_encode($responseArray, JSON_PRETTY_PRINT);
    return;
  }

  try {
    // เตรียม SQL query
    $sql = "SELECT USER_ID, username, password, ROLETYPE FROM USERPASS_PROGRESSPATH WHERE username = :username";

    // เตรียมและรัน SQL statement
    $sth = $this->oracle_bidb->prepare($sql);
    $sth->bindParam(':username', $username, PDO::PARAM_STR);
    $sth->execute();

    // ดึงข้อมูลผลลัพธ์
    $datasetVariable = $sth->fetchAll(PDO::FETCH_ASSOC);

    // เตรียม response array
    $responseArray = array();

    if (count($datasetVariable) >= 1) {
      $responseArray['result'] = TRUE;
      $responseArray['json_total'] = count($datasetVariable);
      $data = array();
      $userRole = ''; // กำหนดค่า role เป็นค่าเริ่มต้น

      foreach ($datasetVariable as $tempdata) {
        $tempArray = array(
          "USER_ID" => $tempdata['USER_ID'],
          "USERNAME" => $tempdata['USERNAME'],
          "PASSWORD" => $tempdata['PASSWORD'],
          "ROLETYPE" => $tempdata['ROLETYPE']
        );

        // เก็บ role ของผู้ใช้
        $userRole = $tempdata['ROLETYPE'];

        $data[] = $tempArray;
      }

      // กรองข้อมูลตาม role ของผู้ใช้
      if ($userRole === 'admin') {
        $responseArray['jsondata'] = $data;
      } else {
        $limitedData = array();
        foreach ($data as $item) {
          $limitedData[] = array(
            'USER_ID' => $item['USER_ID'],
            'USERNAME' => $item['USERNAME'],
            'NAME' => isset($item['NAME']) ? $item['NAME'] : null,
            'LAST_LOGIN' => isset($item['LAST_LOGIN']) ? $item['LAST_LOGIN'] : null
          );
        }
        $responseArray['jsondata'] = $limitedData;
      }
    } else {
      $responseArray['result'] = FALSE;
      $responseArray['jsondata'] = null;
      $responseArray['message'] = 'No data found for the provided username';
    }
  } catch (Exception $e) {
    $responseArray['result'] = FALSE;
    $responseArray['jsondata'] = null;
    $responseArray['message'] = 'Error: ' . $e->getMessage();
  }

  // ส่งข้อมูลเป็น JSON
  echo json_encode($responseArray, JSON_PRETTY_PRINT);
}
