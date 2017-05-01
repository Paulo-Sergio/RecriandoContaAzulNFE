<?php

class LoginController extends Controller {

    public function index() {
        $data = array();

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $pass = addslashes($_POST['password']);

            $u = new Users();

            if ($u->doLogin($email, $pass)) {
                header("Location: " . BASE_URL);
                exit();
            } else {
                $data['error'] = 'E-mail e/ou senha incorreto!';
            }
        }

        $this->loadTemplate('login', $data);
    }

}
