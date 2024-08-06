<?php

namespace Source\App;

use League\Plates\Engine;

class App
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/app", "php");
    }

    public function profile()
    {

        echo $this->view->render("profile", []);
    }

}
