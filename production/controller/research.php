<?php

class research extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->render('xxx', 'json');
        echo json_encode(array('title' => "test", 'value' => "10814"));
    }

    function research()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_ALLDATA_FIRST();
    }
    function checklogin()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_CHECKLOGIN($username, $password);
    }
}
