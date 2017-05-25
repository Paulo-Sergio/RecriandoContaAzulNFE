<?php

class PurchasesController extends Controller {

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
        if ($this->user->hasPermission('sales_view')) {
            $purchases = new Purchases();
            $offset = 0;

            $data['purchases_list'] = $purchases->getList($offset, $this->user->getCompany());

            $this->loadTemplate('purchases', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
