<?php

class PermissionsController extends Controller {

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
        if ($this->user->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $data['permission_list'] = $permissions->getList($this->user->getCompany());
            $data['permission_groups_list'] = $permissions->getGroupList($this->user->getCompany());

            $this->loadTemplate('permissions', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function add() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $permissions->add($pname, $this->user->getCompany());
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }

            $this->loadTemplate('permissions_add', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function add_group() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];
                $permissions->addGroup($pname, $plist, $this->user->getCompany());
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }

            $data['permissions_list'] = $permissions->getList($this->user->getCompany());

            $this->loadTemplate('permissions_addgroup', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function delete($id) {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $permissions->delete($id);
            header("Location: " . BASE_URL . "/permissions");
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function delete_group($id) {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            $permissions->deleteGroup($id);
            header("Location: " . BASE_URL . "/permissions");
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function edit_group($id) {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('permissions_view')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $plist = $_POST['permissions'];
                $permissions->editGroup($pname, $plist, $id, $this->user->getCompany());
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }

            $data['permissions_list'] = $permissions->getList($this->user->getCompany());
            $data['group_info'] = $permissions->getGroup($id, $this->user->getCompany());

            $this->loadTemplate('permissions_editgroup', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

}
