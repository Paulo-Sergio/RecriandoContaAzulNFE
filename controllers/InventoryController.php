<?php

class InventoryController extends Controller {

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
        if ($this->user->hasPermission('inventory_view')) {
            $i = new Inventory();
            $offset = 0;
            $data['inventory_list'] = $i->getList($offset, $this->user->getCompany());

            // verifica as permissões para adionar e editar produtos
            $data['add_permission'] = $this->user->hasPermission('inventory_add');
            $data['edit_permission'] = $this->user->hasPermission('inventory_edit');

            $this->loadTemplate('inventory', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function add() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('inventory_add')) {
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

                $i->add($name, $price, $quant, $min_quant, $this->user->getCompany(), $this->user->getId());
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
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('inventory_edit')) {
            $i = new Inventory();
            $data['inventory_info'] = $i->getInfo($id, $this->user->getCompany());

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

                $i->edit($id, $name, $price, $quant, $min_quant, $this->user->getCompany(), $this->user->getId());
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
        if ($this->user->hasPermission('inventory_edit')) {
            $i = new Inventory();
            $i->delete($id, $this->user->getCompany(), $this->user->getId());

            header("Location: " . BASE_URL . "/inventory");
            exit();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
