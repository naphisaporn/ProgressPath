<?php

class App {

    private $controller = "Home";
    private $method = "index";
    private $params;

    private function splitURL(){
        $URL = $_GET['url'];
        $URL = explode("/",filter_var(trim($URL, "/")), FILTER_SANITIZE_URL);
        return $URL;
    }

    public function run(){
        $URL = $this->splitURL();

        //controller

        $filename = 'app/controller'
    }
}