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

        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $sales = new Sales();
        $purchases = new Purchases();

        // produtos vendidos
        $data['products_sold'] = $sales->getSoldProducts(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
        // receitas de 30 dias atras até data de hoje
        $data['revenue'] = $sales->getTotalRevenue(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
        // despesas de 30 dias atras até data de hoje
        $data['expenses'] = $purchases->getTotalExpenses(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());;

        $this->loadTemplate('home', $data);
    }

}
