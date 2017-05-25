<?php

class PurchasesController extends Controller {

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
            $purchases = new Purchases();
            $offset = 0;

            $data['purchases_list'] = $purchases->getList($offset, $u->getCompany());

            $this->loadTemplate('purchases', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
