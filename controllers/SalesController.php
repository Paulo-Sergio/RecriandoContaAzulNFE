<?php

class SalesController extends Controller {

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

        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('sales_view')) {
            $s = new Sales();
            $offset = 0;
            
            $data['sales_list'] = $s->getList($offset, $u->getCompany());

            $this->loadTemplate('sales', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    
    public function add() {
        $data = array();

        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('sales_view')) {
            $s = new Sales();            

            $this->loadTemplate('sales_add', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
