<?php

class HomeController extends Controller {

    private $user;

    public function __construct() {
        parent::__construct();

        $this->user = new Users();
        if (!$this->user->isLogged()) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        
        $this->user->setLoggedUser();
    }

    public function index() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        
        $sales = new Sales();
        $purchases = new Purchases();

        // produtos vendidos
        $data['products_sold'] = $sales->getSoldProducts(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $this->user->getCompany());
        // receitas de 30 dias atras até data de hoje
        $data['revenue'] = $sales->getTotalRevenue(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $this->user->getCompany());
        // despesas de 30 dias atras até data de hoje
        $data['expenses'] = $purchases->getTotalExpenses(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $this->user->getCompany());;

        $this->loadTemplate('home', $data);
    }

}
