<?php

class UsersController extends Controller {

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

        if ($u->hasPermission('users_view')) {
            $data['users_list'] = $u->getList($u->getCompany());

            $this->loadTemplate('users', $data);
        } else {
            header("Location: " . BASE_URL);
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

        if ($u->hasPermission('users_view')) {
            $p = new Permissions();
            $data['group_list'] = $p->getGroupList($u->getCompany());

            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = addslashes($_POST['email']);
                $password = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $retorno = $u->add($email, $password, $group, $u->getCompany());
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
        $data = array();

        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('users_view')) {
            $p = new Permissions();
            $data['user_info'] = $u->getInfo($id, $u->getCompany());
            $data['group_list'] = $p->getGroupList($u->getCompany());

            if (isset($_POST['group']) && !empty($_POST['group'])) {
                $password = addslashes($_POST['password']);
                $group = addslashes($_POST['group']);

                $u->edit($password, $group, $id, $u->getCompany());
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
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('users_view')) {
            $p = new Permissions();
            $u->delete($id, $u->getCompany());
            header("Location: " . BASE_URL . "/users");
            exit();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
