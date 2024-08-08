<?php
class Webservice {

    private function callAPI($method, $url, $data = null) {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "GET":
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                break;
            default:
                throw new Exception("Unsupported HTTP method: $method");
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            throw new Exception("Connection Failure: " . curl_error($curl));
        }
        curl_close($curl);

        return json_decode($result, true);
    }

    public function hr_user() {
        $url = 'https://hrws.rajavithi.go.th/mvc/human/xhrGetPersonal/' . $_SESSION['IDNo'];
        $utoken = md5($_SESSION['IDNo']);
        $ptoken = $_SESSION['ID'];
        $IDNo = $_SESSION['IDNo'];
        $tmptoken = md5(substr($IDNo, 0, 4) . date("Ymd") . 'rjvt');

        $data = array(
            'utoken' => $utoken,
            'ptoken' => $ptoken,
            'IDNo' => $IDNo,
            'tmptoken' => $tmptoken
        );

        return $this->callAPI('POST', $url, http_build_query($data));
    }

    public function hr_otheruser() {
        $url = 'https://hrws.rajavithi.go.th/mvc/human/xhrGetPersonal/' . $_GET['IDNo'];
        return $this->callAPI('GET', $url);
    }

    public function hr_hrper($DivCode, $SectCode) {
        $url = 'https://hrws.rajavithi.go.th/mvc/commander/xhrGetDivLst';
        $utoken = md5($_SESSION['IDNo']);
        $ptoken = $_SESSION['ID'];
        $tmptoken = md5(substr($_SESSION['IDNo'], 0, 4) . date("Ymd") . 'rj@va');

        $data = array(
            'utoken' => $utoken,
            'ptoken' => $ptoken,
            'tmptoken' => $tmptoken,
            'prm_div' => $DivCode,
            'prm_sec' => $SectCode,
            'prm_subsec' => '00',
            'prm_worksite' => '00'
        );

        return $this->callAPI('POST', $url, http_build_query($data));
    }

    public function hr_div() {
        $url = 'https://hrws.rajavithi.go.th/injection_service/view_hrper/hr_div';
        $utoken = 'hrperrjvt';
        $ptoken = 'be6c233ba9d0578637772e4657563d53';
        $IDNo = $_SESSION['IDNo'];
        $tmptoken = md5(substr($IDNo, 9, 4) . date("Ymd") . 'rjvt');

        $data = array(
            'utoken' => $utoken,
            'ptoken' => $ptoken,
            'IDNo' => $IDNo,
            'tmptoken' => $tmptoken
        );

        return $this->callAPI('POST', $url, http_build_query($data));
    }

    public function hr_sect() {
        $url = 'https://hrws.rajavithi.go.th/injection_service/view_hrper/hr_sect';
        $utoken = 'hrperrjvt';
        $ptoken = 'be6c233ba9d0578637772e4657563d53';
        $IDNo = $_SESSION['IDNo'];
        $tmptoken = md5(substr($IDNo, 9, 4) . date("Ymd") . 'rjvt');

        $data = array(
            'utoken' => $utoken,
            'ptoken' => $ptoken,
            'tmptoken' => $tmptoken,
            'IDNo' => $IDNo
        );

        return $this->callAPI('POST', $url, http_build_query($data));
    }

    public function hr_subsect() {
        $url = 'https://hrws.rajavithi.go.th/injection_service/view_hrper/hr_subsect';
        $utoken = 'hrperrjvt';
        $ptoken = 'be6c233ba9d0578637772e4657563d53';
        $IDNo = $_SESSION['IDNo'];
        $tmptoken = md5(substr($IDNo, 9, 4) . date("Ymd") . 'rjvt');

        $data = array(
            'utoken' => $utoken,
            'ptoken' => $ptoken,
            'tmptoken' => $tmptoken,
            'IDNo' => $IDNo
        );

        return $this->callAPI('POST', $url, http_build_query($data));
    }
}
?>
