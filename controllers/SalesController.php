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
        
        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

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

            if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
                $clientId = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $productsQuant = $_POST['quant'];
                
                $s->add($u->getCompany(), $clientId, $u->getId(), $productsQuant, $status);
                header("Location: " . BASE_URL . "/sales");
                exit();
            }

            $this->loadTemplate('sales_add', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
