<?php

namespace Source\App;

use League\Plates\Engine;

class Admin
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/adm", "php");
    }

    public function home()
    {

        echo $this->view->render("home", []);
    }

    public function login()
    {
        echo $this->view->render("login", []);
    }
    public function edit_product()
    {
        echo $this->view->render("edit_product", []);
    }
    public function edit_user()
    {
        echo $this->view->render("edit_user", []);
    }
    public function remove_user()
    {
        echo $this->view->render("remove_user", []);
    }
}
