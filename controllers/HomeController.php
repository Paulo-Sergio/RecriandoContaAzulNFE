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

        $data['statuses'] = array(
            '0' => 'Aguardando Pgto.',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );
        
        $sales = new Sales();
        $purchases = new Purchases();

        // produtos vendidos nos ultimos 30 dias
        $data['products_sold'] = $sales->getSoldProducts(Utilities::last30Days(), date('Y-m-d'), $this->user->getCompany());
        // receitas de 30 dias atras até data de hoje
        $data['revenue'] = $sales->getTotalRevenue(Utilities::last30Days(), date('Y-m-d'), $this->user->getCompany());
        // despesas de 30 dias atras até data de hoje
        $data['expenses'] = $purchases->getTotalExpenses(Utilities::last30Days(), date('Y-m-d'), $this->user->getCompany());

        // lista dos ultimos 30 dias para o meu grafico
        $data['days_list'] = array();
        for ($q = 30; $q > 0; $q--) {
            $data['days_list'][] = date('d/m', strtotime('-' . $q . 'days'));
        }
        // com base nos ultimos 30 dias, vou pegar o valor de receita de cada dia pra colocar no grafico
        $data['revenue_list'] = $sales->getRevenueList(Utilities::last30Days(), date('Y-m-d'), $this->user->getCompany());
        // com base nos ultimos 30 dias, vou pegar o valor de despesa de cada dia pra colocar no grafico
        $data['expenses_list'] = $purchases->getExpensesList(Utilities::last30Days(), date('Y-m-d'), $this->user->getCompany());
        // pegando os status dos pagamentos nos ultimos 30 dias
        $data['status_list'] = $sales->getQuantStatusList(Utilities::last30Days(), date('Y-m-d'), $this->user->getCompany());
        
        $this->loadTemplate('home', $data);
    }

}
