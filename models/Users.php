<?php

class Users extends Model {

    private $userInfo;
    private $permissions;

    public function isLogged() {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            return true;
        }

        return false;
    }

    public function doLogin($email, $pass) {
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $pass = md5($pass);
        $stmt->bindParam(':password', $pass);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            $_SESSION['ccUser'] = $row['id'];
            return true;
        }
        return false;
    }

    public function setLoggedUser() {
        if ($this->isLogged()) {
            $id = $_SESSION['ccUser'];

            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->userInfo = $stmt->fetch();
                $this->permissions = new Permissions();
                // ao settar info's do usuario, vou settar o grupo que o mesmo pertence
                $this->permissions->setGroup($this->userInfo['group'], $this->userInfo['id_company']);
            }
        }
    }
    
    public function logout() {
        unset($_SESSION['ccUser']);
    }
    
    public function hasPermission($name) {
        return $this->permissions->hasPermission($name);
    }

    public function getCompany() {
        return $this->userInfo['id_company'];
    }
    
    public function getEmail() {
        return $this->userInfo['email'];
    }
}
