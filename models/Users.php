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
                $this->permissions->setGroup($this->userInfo['id_group'], $this->userInfo['id_company']);
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

    public function getInfo($id, $idCompany) {
        $array = array();
        $sql = "SELECT * FROM users WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam('id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetch();
        }
        return $array;
    }

    public function findUsersInGroup($id) {
        $sql = "SELECT COUNT(*) as c FROM users WHERE id_group = :group";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":group", $id);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row['c'] == '0') {
            return false;
        }

        return true;
    }

    public function getList($idCompany) {
        $array = array();
        $sql = "SELECT u.id, u.email, pg.name 
                FROM users u
                INNER JOIN permission_groups pg
                ON u.id_group = pg.id
                WHERE u.id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetchAll();
        }
        return $array;
    }

    public function add($email, $password, $idGroup, $idCompany) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row['c'] == '0') { //não há usuario cadastrado
            $stmt = $this->db->prepare("INSERT INTO users SET email = :email, password = :password, id_group = :id_group, id_company = :id_company");
            $stmt->bindParam(":email", $email);
            $password = md5($password);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":id_group", $idGroup);
            $stmt->bindParam(":id_company", $idCompany);
            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }

    public function edit($password, $idGroup, $id, $idCompany) {
        $sql = "UPDATE users SET id_group = :id_group WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_group", $idGroup);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        if (!empty($password)) {
            $sql = "UPDATE users SET password = :password WHERE id = :id AND id_company = :id_company";
            $stmt = $this->db->prepare($sql);
            $password = md5($password);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":id_company", $idCompany);
            $stmt->execute();
        }
    }

    public function delete($id, $idCompany) {
        $sql = "DELETE FROM users WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();
    }

}
