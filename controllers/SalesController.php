<?php

class SalesController extends Controller {

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

        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($this->user->hasPermission('sales_view')) {
            $s = new Sales();
            $offset = 0;

            $data['sales_list'] = $s->getList($offset, $this->user->getCompany());

            $this->loadTemplate('sales', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function add() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('sales_view')) {
            $s = new Sales();

            if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
                $clientId = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $productsQuant = $_POST['quant'];

                $s->add($this->user->getCompany(), $clientId, $this->user->getId(), $productsQuant, $status);
                header("Location: " . BASE_URL . "/sales");
                exit();
            }

            $this->loadTemplate('sales_add', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function edit($id) {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        
        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($this->user->hasPermission('sales_view')) {
            $s = new Sales();
            $data['sales_info'] = $s->getInfo($id, $this->user->getCompany());
            $data['permission_edit'] = $this->user->hasPermission('sales_edit');

            if (isset($_POST['status']) && $data['permission_edit']) {
                $status = addslashes($_POST['status']);

                $s->changeStatus($id, $status, $this->user->getCompany());
                header("Location: " . BASE_URL . "/sales");
                exit();
            }

            $this->loadTemplate('sales_edit', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    
    public function view_nfe($nfeKey) {
        
    }
    
    public function generate_nfe($idSale) {
        
    }

}
