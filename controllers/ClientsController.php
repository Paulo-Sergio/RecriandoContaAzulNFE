<?php

class ClientsController extends Controller {

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

        if ($u->hasPermission('clients_view')) {
            $c = new Clients();
            $offset = 0;
            $data['clients_list'] = $c->getList($offset);
            $data['edit_permission'] = $u->hasPermission('clients_edit');

            $this->loadTemplate('clients', $data);
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

        if ($u->hasPermission('clients_edit')) {
            $c = new Clients();

            $this->loadTemplate('clients_add', $data);
        } else {
            header("Location: " . BASE_URL . "/clients");
            exit();
        }
    }

}
