<?php
date_default_timezone_set('Asia/Bangkok');

class research_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    ///////// TEST API
    function API_ALLDATA_FIRST()
    {

        $objPerson = $this->checkJWT();
        if ($objPerson) {


            $sql = "SELECT * from budgetplandata";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["BG_ID"] = $tempdata['BG_ID'];
                    $tempArray["BRGJ_ID"] = $tempdata['BRGJ_ID'];
                    $tempArray["ERP_ID"] = $tempdata['ERP_ID'];
                    $tempArray["BUDGETPLAN_NAME"] = $tempdata['BUDGETPLAN_NAME'];
                    $tempArray["ORGANIZE_ID"] = $tempdata['ORGANIZE_ID'];
                    $tempArray["STATUS"] = $tempdata['STATUS'];
                    $tempArray["RESPONSIBLE_ID"] = $tempdata['RESPONSIBLE_ID'];
                    $tempArray["RESPONSIBLE"] = $tempdata['RESPONSIBLE'];
                    $tempArray["TELEPHONE_RES"] = $tempdata['TELEPHONE_RES'];
                    $tempArray["DEPARTMENT_ID"] = $tempdata['DEPARTMENT_ID'];
                    $tempArray["DEPARTMENT"] = $tempdata['DEPARTMENT'];
                    $tempArray["DIVISION"] = $tempdata['DIVISION'];
                    $tempArray["COORDINATOR"] = $tempdata['COORDINATOR'];
                    $tempArray["TELEPHONE_CO"] = $tempdata['TELEPHONE_CO'];
                    $tempArray["STATUS_PLAN"] = $tempdata['STATUS_PLAN'];
                    $tempArray["REASONPLAN"] = $tempdata['REASONPLAN'];
                    $tempArray["STARTDATE"] = $tempdata['STARTDATE'];
                    $tempArray["ENDDATE"] = $tempdata['ENDDATE'];
                    $tempArray["NUMDAYS"] = $tempdata['NUMDAYS'];
                    $tempArray["DURATION"] = $tempdata['DURATION'];
                    $tempArray["ALLOCATECYCLE"] = $tempdata['ALLOCATECYCLE'];
                    $tempArray["ALLOCATEBUDGET"] = $tempdata['ALLOCATEBUDGET'];
                    $tempArray["APPROVEBUDGET"] = $tempdata['APPROVEBUDGET'];
                    $tempArray["SPENDINGPLAN"] = $tempdata['SPENDINGPLAN'];
                    $tempArray["PAYOUTRS"] = $tempdata['PAYOUTRS'];
                    $tempArray["PAYOUTPERCENT"] = $tempdata['PAYOUTPERCENT'];



                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    function API_rational()
    {

        $objPerson = $this->checkJWT();
        if ($objPerson) {


            $sql = "SELECT * from budgetplandata_rational";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["BGRJ_ID"] = $tempdata['BGRJ_ID'];
                    $tempArray["BUDGETPLAN_NAME"] = $tempdata['BUDGETPLAN_NAME'];
                    $tempArray["RATIONAL"] = $tempdata['RATIONAL'];
                    $tempArray["BG_ID"] = $tempdata['BG_ID'];
                    $tempArray["CREATEDATE"] = $tempdata['CREATEDATE'];
                    $tempArray["LOCATION"] = $tempdata['LOCATION'];
                    $tempArray["LOCATION_DETAIL"] = $tempdata['LOCATION_DETAIL'];
                    $tempArray["STARTDATE"] = $tempdata['STARTDATE'];
                    $tempArray["ENDDATE"] = $tempdata['ENDDATE'];





                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    function API_maxpurpose()
    {

        $objPerson = $this->checkJWT();
        if ($objPerson) {


            $sql = "SELECT bg_id, maxdate, count(bg_id) as countbg_id
  from (select bg_id, max(createdate) as maxdate
          from budgetplandata_purpose
         group by bg_id)
         where bg_id is not null
         group by bg_id, maxdate";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["BG_ID"] = $tempdata['BG_ID'];
                    $tempArray["MAXDATE"] = $tempdata['MAXDATE'];
                    $tempArray["COUNTBG_ID"] = $tempdata['COUNTBG_ID'];
                  




                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    function API_DEP()
    {

        $objPerson = $this->checkJWT();
        if ($objPerson) {


            $sql = "SELECT * from DEP_BGPLAN where name like 'กลุ่มงาน%'";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["GENID"] = $tempdata['GENID'];
                    $tempArray["MISSIONID"] = $tempdata['MISSIONID'];
                    $tempArray["GROUPCODE"] = $tempdata['GROUPCODE'];
                    $tempArray["JOBCODE"] = $tempdata['JOBCODE'];
                    $tempArray["UNITCODE"] = $tempdata['UNITCODE'];
                    $tempArray["COSTCENTERID"] = $tempdata['COSTCENTERID'];
                    $tempArray["NAME"] = $tempdata['NAME'];
                    
                  




                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    function API_2DEP()
    {

        $objPerson = $this->checkJWT();
        if ($objPerson) {


            $sql = "SELECT * from DEP_BGPLAN where name like 'งาน%'";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["GENID"] = $tempdata['GENID'];
                    $tempArray["MISSIONID"] = $tempdata['MISSIONID'];
                    $tempArray["GROUPCODE"] = $tempdata['GROUPCODE'];
                    $tempArray["JOBCODE"] = $tempdata['JOBCODE'];
                    $tempArray["UNITCODE"] = $tempdata['UNITCODE'];
                    $tempArray["COSTCENTERID"] = $tempdata['COSTCENTERID'];
                    $tempArray["NAME"] = $tempdata['NAME'];
                    
                  




                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    function API_purpose()
    {

        $objPerson = $this->checkJWT();
        if ($objPerson) {


            // $sql = "SELECT * from budgetplandata_purpose";
            $sql = "SELECT bg_id,bgrj_id,budgetplan_name,purpose,createdate, max(createdate) as maxdate from budgetplandata_purpose 
            group by bg_id,bgrj_id,budgetplan_name,purpose,createdate";
            // $sql = "SELECT BGRJ_ID,BUDGETPLAN_NAME,PURPOSE,BG_ID,CREATEDATE,max(createdate) as maxdate from budgetplandata_purpose";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["BGRJ_ID"] = $tempdata['BGRJ_ID'];
                    $tempArray["BUDGETPLAN_NAME"] = $tempdata['BUDGETPLAN_NAME'];
                    $tempArray["PURPOSE"] = $tempdata['PURPOSE'];
                    $tempArray["BG_ID"] = $tempdata['BG_ID'];
                    $tempArray["CREATEDATE"] = $tempdata['CREATEDATE'];
                    $tempArray["MAXDATE"] = $tempdata['MAXDATE'];




                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    function API_maxdate_purpose()
    {

        $objPerson = $this->checkJWT();
        if ($objPerson) {


            // $sql = "SELECT * from budgetplandata_purpose";
            $sql = "SELECT bg_id,max(createdate) as maxdate from budgetplandata_purpose group by bg_id";
            // $sql = "SELECT BGRJ_ID,BUDGETPLAN_NAME,PURPOSE,BG_ID,CREATEDATE,max(createdate) as maxdate from budgetplandata_purpose";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["BG_ID"] = $tempdata['BG_ID'];
                    $tempArray["MAXDATE"] = $tempdata['MAXDATE'];




                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    // function API_filterID($id)
    // {

    //     $objPerson = $this->checkJWT();
    //     if ($objPerson) {


    //         $sql = "SELECT * from budgetplandata where bg_id = :id";

    //         // เตรียมและรัน SQL statement
    //         $sth = $this->oracle_bidb->prepare($sql);
    //         $sth->bindParam(':id', $id, PDO::PARAM_STR);
    //         $sth->execute();

    //         // ดึงข้อมูลผลลัพธ์
    //         $datasetVariable = $sth->fetchAll(PDO::FETCH_ASSOC);

    //         // เตรียม response array
    //         $responseArray = array();

    //         // $sth = $this->oracle_bidb->prepare($sql);

    //         // $sth->setFetchMode(PDO::FETCH_ASSOC);
    //         // $sth->execute(array());
    //         // $datasetVariable = $sth->fetchAll();

    //         if (count($datasetVariable) >= 1) {
    //             $responseArray['result'] = TRUE;
    //             $responseArray['json_total'] =  count($datasetVariable);
    //             $data = array();

    //             foreach ($datasetVariable as $tempdata) {
    //                 $tempArray = array();
    //                 $tempArray["BG_ID"] = $tempdata['BG_ID'];
    //                 $tempArray["BRGJ_ID"] = $tempdata['BRGJ_ID'];
    //                 $tempArray["ERP_ID"] = $tempdata['ERP_ID'];
    //                 $tempArray["BUDGETPLAN_NAME"] = $tempdata['BUDGETPLAN_NAME'];
    //                 $tempArray["ORGANIZE_ID"] = $tempdata['ORGANIZE_ID'];
    //                 $tempArray["STATUS"] = $tempdata['STATUS'];
    //                 $tempArray["RESPONSIBLE_ID"] = $tempdata['RESPONSIBLE_ID'];
    //                 $tempArray["RESPONSIBLE"] = $tempdata['RESPONSIBLE'];
    //                 $tempArray["TELEPHONE_RES"] = $tempdata['TELEPHONE_RES'];
    //                 $tempArray["DEPARTMENT_ID"] = $tempdata['DEPARTMENT_ID'];
    //                 $tempArray["DEPARTMENT"] = $tempdata['DEPARTMENT'];
    //                 $tempArray["DIVISION"] = $tempdata['DIVISION'];
    //                 $tempArray["COORDINATOR"] = $tempdata['COORDINATOR'];
    //                 $tempArray["TELEPHONE_CO"] = $tempdata['TELEPHONE_CO'];
    //                 $tempArray["STATUS_PLAN"] = $tempdata['STATUS_PLAN'];
    //                 $tempArray["REASONPLAN"] = $tempdata['REASONPLAN'];
    //                 $tempArray["STARTDATE"] = $tempdata['STARTDATE'];
    //                 $tempArray["ENDDATE"] = $tempdata['ENDDATE'];
    //                 $tempArray["NUMDAYS"] = $tempdata['NUMDAYS'];
    //                 $tempArray["DURATION"] = $tempdata['DURATION'];
    //                 $tempArray["ALLOCATECYCLE"] = $tempdata['ALLOCATECYCLE'];
    //                 $tempArray["ALLOCATEBUDGET"] = $tempdata['ALLOCATEBUDGET'];
    //                 $tempArray["APPROVEBUDGET"] = $tempdata['APPROVEBUDGET'];
    //                 $tempArray["SPENDINGPLAN"] = $tempdata['SPENDINGPLAN'];
    //                 $tempArray["PAYOUTRS"] = $tempdata['PAYOUTRS'];
    //                 $tempArray["PAYOUTPERCENT"] = $tempdata['PAYOUTPERCENT'];



    //                 array_push($data, $tempArray);
    //             }
    //             $responseArray['jsondata'] = $data;
    //         } else {
    //             $responseArray['result'] = FALSE;
    //             $responseArray['jsondata'] = null;
    //         }
    //         echo json_encode($responseArray, JSON_PRETTY_PRINT);
    //     } else {
    //         $responseArray['json_result'] = FALSE;
    //         $responseArray['json_data'] = null;
    //         echo 'Error... ';
    //     }
    // }
    function API_filterID()
    {
        $objPerson = $this->checkJWT();
        if ($objPerson) {
            // $bg_id = '670000002';
            // $bg_id = $id;
            // $bg_id = addslashes($id);  // ป้องกัน SQL Injection เบื้องต้น

            $sql = "SELECT * FROM budgetplandata";

            $sth = $this->oracle_bidb->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute(array());
            $datasetVariable = $sth->fetchAll();

            if (count($datasetVariable) >= 1) {
                $responseArray['result'] = TRUE;
                $responseArray['json_total'] =  count($datasetVariable);
                $data = array();

                foreach ($datasetVariable as $tempdata) {
                    $tempArray = array();
                    $tempArray["BG_ID"] = $tempdata['BG_ID'];
                    $tempArray["BGRJ_ID"] = $tempdata['BGRJ_ID'];
                    $tempArray["ERP_ID"] = $tempdata['ERP_ID'];
                    $tempArray["BUDGETPLAN_NAME"] = $tempdata['BUDGETPLAN_NAME'];
                    $tempArray["ORGANIZE_ID"] = $tempdata['ORGANIZE_ID'];
                    $tempArray["STATUS"] = $tempdata['STATUS'];
                    $tempArray["RESPONSIBLE_ID"] = $tempdata['RESPONSIBLE_ID'];
                    $tempArray["RESPONSIBLE"] = $tempdata['RESPONSIBLE'];
                    $tempArray["TELEPHONE_RES"] = $tempdata['TELEPHONE_RES'];
                    $tempArray["DEPARTMENT_ID"] = $tempdata['DEPARTMENT_ID'];
                    $tempArray["DEPARTMENT"] = $tempdata['DEPARTMENT'];
                    $tempArray["DIVISION"] = $tempdata['DIVISION'];
                    $tempArray["COORDINATOR"] = $tempdata['COORDINATOR'];
                    $tempArray["TELEPHONE_CO"] = $tempdata['TELEPHONE_CO'];
                    $tempArray["STATUS_PLAN"] = $tempdata['STATUS_PLAN'];
                    $tempArray["REASONPLAN"] = $tempdata['REASONPLAN'];
                    $tempArray["STARTDATE"] = $tempdata['STARTDATE'];
                    $tempArray["ENDDATE"] = $tempdata['ENDDATE'];
                    $tempArray["NUMDAYS"] = $tempdata['NUMDAYS'];
                    $tempArray["DURATION"] = $tempdata['DURATION'];
                    $tempArray["ALLOCATECYCLE"] = $tempdata['ALLOCATECYCLE'];
                    $tempArray["ALLOCATEBUDGET"] = $tempdata['ALLOCATEBUDGET'];
                    $tempArray["APPROVEBUDGET"] = $tempdata['APPROVEBUDGET'];
                    $tempArray["SPENDINGPLAN"] = $tempdata['SPENDINGPLAN'];
                    $tempArray["PAYOUTRS"] = $tempdata['PAYOUTRS'];
                    $tempArray["PAYOUTPERCENT"] = $tempdata['PAYOUTPERCENT'];



                    array_push($data, $tempArray);
                }
                $responseArray['jsondata'] = $data;
            } else {
                $responseArray['result'] = FALSE;
                $responseArray['jsondata'] = null;
            }
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
        } else {
            $responseArray['json_result'] = FALSE;
            $responseArray['json_data'] = null;
            echo 'Error... ';
        }
    }
    // function API_filterID($id)
    // {
    //     $objPerson = $this->checkJWT();
    //     if ($objPerson) {
    //         $bg_id = '670000002';
    //         // เตรียมการ SQL
    //         $sql = "SELECT * FROM budgetplandata WHERE bg_id = :bg_id";

    //         // เตรียม statement
    //         $sth = $this->oracle_bidb->prepare($sql);

    //         // Bind parameter
    //         $sth->bindParam(':bg_id', $bg_id, PDO::PARAM_STR);

    //         // Execute statement
    //         $sth->execute();

    //         // ดึงข้อมูลผลลัพธ์
    //         $datasetVariable = $sth->fetchAll(PDO::FETCH_ASSOC);

    //         // ตรวจสอบว่ามีข้อมูลหรือไม่
    //         if (count($datasetVariable) >= 1) {
    //             $responseArray['result'] = TRUE;
    //             $responseArray['json_total'] = count($datasetVariable);
    //             $responseArray['jsondata'] = $datasetVariable; // ส่งข้อมูลทั้งหมด
    //         } else {
    //             $responseArray['result'] = FALSE;
    //             $responseArray['jsondata'] = null;
    //         }
    //         // ส่งข้อมูลในรูปแบบ JSON
    //         echo json_encode($responseArray, JSON_PRETTY_PRINT);
    //     } else {
    //         $responseArray['json_result'] = FALSE;
    //         $responseArray['json_data'] = null;
    //         echo json_encode($responseArray, JSON_PRETTY_PRINT);
    //     }
    // }



    function API_CHECKLOGIN($username, $password)
    {
        // ตรวจสอบ JWT
        // ตรวจสอบ JWT token
        $objPerson = $this->checkJWT();
        if (!$objPerson) {
            // ถ้า JWT ไม่ถูกต้อง ส่งกลับผลลัพธ์เป็น FALSE
            $responseArray = array(
                'result' => FALSE,
                'jsondata' => null
            );
            echo json_encode($responseArray, JSON_PRETTY_PRINT);
            return;
        }

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

        if (count($datasetVariable) === 0) {
            echo 'No data found for the provided username.';
            exit;
        }

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
                // สำหรับ admin แสดงข้อมูลทั้งหมด
                $responseArray['jsondata'] = $data;
            } else {
                // สำหรับผู้ใช้ทั่วไป แสดงข้อมูลที่จำกัด
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
        }

        // ส่งข้อมูลเป็น JSON
        echo json_encode($responseArray, JSON_PRETTY_PRINT);
    }

    // private function chkToken($hid, $tmpToken) {
    //     if ($tmpToken == $this->genToken($hid)) {
    //         return TRUE;
    //     } else {
    //         return FALSE;
    //     }
    // }

    // private function genToken($hid) {
    //     return md5($hid . date("Ymd") . "rjvt");
    // }

    private function checkToken()
    {
        $responseObj = array();
        $usr_token = filter_input(INPUT_POST, 'utoken', FILTER_SANITIZE_STRING);
        $pwd_token = substr(filter_input(INPUT_POST, 'ptoken', FILTER_SANITIZE_STRING), 0, 32);
        $tmp_token = substr(filter_input(INPUT_POST, 'tmptoken', FILTER_SANITIZE_STRING), 0, 32);
        $token_res = $this->chkLogin($usr_token, $pwd_token);


        if ($token_res->login_res) {

            $responseObj['obj_result'] = TRUE;
            $responseObj['obj_id'] = $token_res->login_id;

            //  $ID = $_POST['id'];

            // $encode_id1 = base64_decode($ID);
            // $encode_id2 = base64_decode($encode_id1);

            // if ($this->chkToken($encode_id2, $tmp_token)) {
            //     $responseObj['obj_result'] = TRUE;
            //     $responseObj['obj_id'] = $token_res->login_id;
            // } else {
            //     $responseObj['obj_result'] = TRUE;
            //     $responseObj['obj_id'] = 'Tmp Token Wrong!!';
            //     echo json_encode($responseObj, JSON_PRETTY_PRINT);
            //     exit();
            // }

        } else {
            $responseObj['obj_result'] = FALSE;
            $responseObj['obj_id'] = 'user or Password Token Wrong!!';
            echo json_encode($responseObj, JSON_PRETTY_PRINT);
        }
        return (object) $responseObj;
    }

    private function chkLogin($usr_md5, $pwd_md5)
    {
        $responseArray = array();
        if (!(is_null($usr_md5)) && !(is_null($pwd_md5))) {
            //$sth = $this->hr_mysql_db->prepare("SELECT * from person_regis WHERE MD5(pr_pid) = :login AND pr_pwd = :password ");
            $sth = $this->oracle_rjvtdb->prepare("SELECT * from webservice_user WHERE ws_user = :login AND ws_password = :password and ws_id = 18");
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sth->execute(array(
                ':login' => $usr_md5,
                ':password' => $pwd_md5

            ));
            $datasetVariable = $sth->fetchAll();
            $personalDataset = (object) $datasetVariable[0];

            if (count($datasetVariable) == 1) {
                $responseArray['login_res'] = TRUE;
                $responseArray['login_id'] = $personalDataset->ws_user;
            } else {
                $responseArray['login_res'] = FALSE;
                $responseArray['login_id'] = null;
            }
        } else {
            $responseArray['login_res'] = FALSE;
            $responseArray['login_id'] = null;
        }
        return (object) $responseArray;
    }
}
