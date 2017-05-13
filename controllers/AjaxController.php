<?php

class AjaxController extends Controller {

    public function __construct() {
        parent::__construct();

        $u = new Users();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
    }

    public function index() {
        
    }

    public function search_clients() {
        // informações para definir o USER logado
        $u = new Users();
        $u->setLoggedUser();

        $c = new Clients();
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $name = addslashes($_GET['query']);
            $clients = $c->searchClientsByName($name, $u->getCompany());

            foreach ($clients as $citem) {
                $data[] = array(
                    'name' => $citem['name'],
                    'link' => BASE_URL . '/clients/edit/' . $citem['id']
                );
            }
        }

        echo json_encode($data);
    }

}