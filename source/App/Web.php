<?php

namespace Source\App;

use League\Plates\Engine;

class Web
{
    private $view;

public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/web","php");
    }

    public function home ()
    {
       
        echo $this->view->render("home",[]);
    }

    public function login ()
    {
        echo $this->view->render("login",[]);
        
    }

    public function about ()
    {
        echo $this->view->render("about",[]);
    }

    public function register ()
    {
        echo $this->view->render("register",[]);
        
    }

    public function shop ()
    {
        echo $this->view->render("shop",[]);
    }
   

    public function error (array $data)
    {
        var_dump($data);
    }

}