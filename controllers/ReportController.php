<?php

class ReportController extends Controller {

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

        if ($u->hasPermission('report_view')) {
            $this->loadTemplate('report', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    
    public function sales() {
        $data = array();

        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($u->hasPermission('report_view')) {
            

            $this->loadTemplate('report_sales', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
