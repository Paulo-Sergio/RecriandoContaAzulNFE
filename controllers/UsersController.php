<?php

class UsersController extends Controller {

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
        if ($this->user->hasPermission('users_view')) {
            $data['users_list'] = $this->user->getList($this->user->getCompany());

            $this->loadTemplate('users', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function add() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('users_view')) {
            $p = new Permissions();
            $data['group_list'] = $p->getGroupList($this->user->getCompany());

            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = addslashes($_POST['email']);
                $password = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $retorno = $this->user->add($email, $password, $group, $this->user->getCompany());
                if ($retorno) {
                    header("Location: " . BASE_URL . "/users");
                    exit();
                } else {
                    $data['error_msg'] = "Usuário já existe!";
                }
            }

            $this->loadTemplate('users_add', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function edit($id) {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('users_view')) {
            $p = new Permissions();
            $data['user_info'] = $this->user->getInfo($id, $this->user->getCompany());
            $data['group_list'] = $p->getGroupList($this->user->getCompany());

            if (isset($_POST['group']) && !empty($_POST['group'])) {
                $password = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $this->user->edit($password, $group, $id, $this->user->getCompany());
                header("Location: " . BASE_URL . "/users");
                exit();
            }

            $this->loadTemplate('users_edit', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function delete($id) {
        $data = array();
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('users_view')) {
            $p = new Permissions();
            $this->user->delete($id, $this->user->getCompany());
            header("Location: " . BASE_URL . "/users");
            exit();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
