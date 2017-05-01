<?php

class HomeController extends Controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
    }

    public function index() {
        $data = array();

        $this->loadView('home', $data);
    }

}
