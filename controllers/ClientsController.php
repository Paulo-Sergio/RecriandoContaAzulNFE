<?php

class ClientsController extends Controller {

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
        if ($this->user->hasPermission('clients_view')) {
            $c = new Clients();
            $offset = 0;

            //questão com paginação
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = (10 * ($data['p'] - 1));

            $data['clients_list'] = $c->getList($offset, $this->user->getCompany());
            $data['clients_count'] = $c->getCount($this->user->getCompany());
            $data['p_count'] = ceil($data['clients_count'] / 10); //sempre arredonda pra cima
            // verificando permissão
            $data['edit_permission'] = $this->user->hasPermission('clients_edit');

            $this->loadTemplate('clients', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function add() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('clients_edit')) {
            $c = new Clients();
            $cidade = new Cidade();

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_citycode = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                $address_city = $cidade->getCity($address_citycode);
                                
                
                $c->add($this->user->getCompany(), $name, $email, $phone, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country, $address_citycode);
                header("Location: " . BASE_URL . "/clients");
            }

            $data['states'] = $cidade->getStates();
            
            $this->loadTemplate('clients_add', $data);
        } else {
            header("Location: " . BASE_URL . "/clients");
            exit();
        }
    }

    public function edit($id) {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('clients_edit')) {
            $c = new Clients();
            $cidade = new Cidade();

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address = addslashes($_POST['address']);
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_citycode = addslashes($_POST['address_city']);
                $address_state = addslashes($_POST['address_state']);
                $address_country = addslashes($_POST['address_country']);
                $address_city = $cidade->getCity($address_citycode);

                $c->edit($id, $this->user->getCompany(), $name, $email, $phone, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country, $address_citycode);
                header("Location: " . BASE_URL . "/clients");
                exit();
            }

            $data['client_info'] = $c->getInfo($id, $this->user->getCompany());
            $data['states'] = $cidade->getStates();
            $data['cities'] = $cidade->getCityList($data['client_info']['address_state']);

            $this->loadTemplate('clients_edit', $data);
        } else {
            header("Location: " . BASE_URL . "/clients");
            exit();
        }
    }

}
