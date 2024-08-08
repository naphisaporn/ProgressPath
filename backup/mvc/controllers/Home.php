<?php

// http://localhost/live/Home/Show/1/2

class Home extends Controller{

    // Must have SayHi()
    function SayHi(){
        $teo = $this->model("SinhVienModel");
        echo $teo->GetSV();

    }

    function Show(){        
        // Call Models
        // $teo = $this->model("SinhVienModel");
        // $tong = $teo->Tong(); // 3

        // Call Views
        $this->view("home", [
            "Page"=>"news",
            // "Number"=>$tong,
            "Mau"=>"red",
            "SoThich"=>["A", "B", "C"]
            // "SV" => $teo->SinhVien()
        ]);
    }
}
?>