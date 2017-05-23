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
    
    public function sales_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($u->hasPermission('report_view')) {
            $client_name = addslashes($_GET['client_name']);
            $period1 = addslashes($_GET['period1']);
            $period2 = addslashes($_GET['period2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);
            
            $s = new Sales();
            $data['sales_list'] = $s->getSalesFiltered($client_name, $period1, $period2, $status, $order, $u->getCompany());
            
            $data['filters'] = $_GET;

            $this->loadView('report_sales_pdf', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
