<?php

class Users extends Model {

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

}
