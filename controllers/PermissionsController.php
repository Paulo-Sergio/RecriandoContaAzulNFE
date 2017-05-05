<?php

class PermissionsController extends Controller {

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

        if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $data['permission_list'] = $permissions->getList($u->getCompany());
            $data['permission_groups_list'] = $permissions->getGroupList($u->getCompany());

            $this->loadTemplate('permissions', $data);
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

        if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $permissions->add($pname, $u->getCompany());
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }

            $this->loadTemplate('permissions_add', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function add_group() {
        $data = array();

        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $permissions->add($pname, $u->getCompany());
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }
            
            $data['permissions_list'] = $permissions->getList($u->getCompany());

            $this->loadTemplate('permissions_addgroup', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function delete($id) {
        // informações para o template
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $permissions->delete($id);
            header("Location: " . BASE_URL . "/permissions");
        } else {
            header("Location: " . BASE_URL);
        }
    }

}
