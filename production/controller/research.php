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
    function filterID()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_filterID();
    }
    function first()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_rational();
    }
    function purpose()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_purpose();
    }
    function purpose_maxdate()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_maxdate_purpose();
    }
    function maxpurpose()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_maxpurpose();
    }
    function dep()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_DEP();
    }
    function seconddep()
    {
        $this->view->render('xxx', 'json');
        $this->model->API_2DEP();
    }
    

}
