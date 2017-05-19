<?php

class InventoryController extends Controller {

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

        if ($u->hasPermission('inventory_view')) {
            $i = new Inventory();
            $offset = 0;
            $data['inventory_list'] = $i->getList($offset, $u->getCompany());

            // verifica as permissões para adionar e editar produtos
            $data['add_permission'] = $u->hasPermission('inventory_add');
            $data['edit_permission'] = $u->hasPermission('inventory_edit');

            $this->loadTemplate('inventory', $data);
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

        if ($u->hasPermission('inventory_add')) {
            // quanto usuario enviar os dados do formulario add
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $i = new Inventory();
                $name = addslashes($_POST['name']);
                $price = addslashes($_POST['price']);
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);

                // deixar no padrão americano para persistir no banco
                // 1.500,00 -> 1500,00 -> 1500.00
                $price = str_replace('.', '', $price);
                $price = str_replace(',', '.', $price);

                $i->add($name, $price, $quant, $min_quant, $u->getCompany(), $u->getId());
                header("Location: " . BASE_URL . "/inventory");
                exit();
            }

            $this->loadTemplate('inventory_add', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function edit($id) {
        $data = array();

        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('inventory_edit')) {
            $i = new Inventory();
            $data['inventory_info'] = $i->getInfo($id, $u->getCompany());

            // quanto usuario enviar os dados do formulario edit
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $price = addslashes($_POST['price']);
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);

                // deixar no padrão americano para persistir no banco
                // 1.500,00 -> 1500,00 -> 1500.00
                $price = str_replace('.', '', $price);
                $price = str_replace(',', '.', $price);

                $i->edit($id, $name, $price, $quant, $min_quant, $u->getCompany(), $u->getId());
                header("Location: " . BASE_URL . "/inventory");
                exit();
            }

            $this->loadTemplate('inventory_edit', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function delete($id) {
        $u = new Users();
        $u->setLoggedUser();

        if ($u->hasPermission('inventory_edit')) {
            $i = new Inventory();
            $i->delete($id, $u->getCompany(), $u->getId());

            header("Location: " . BASE_URL . "/inventory");
            exit();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
