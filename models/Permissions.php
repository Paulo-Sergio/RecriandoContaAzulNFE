<?php

class Permissions extends Model {

    private $group;
    private $permissions;

    public function setGroup($id, $id_company) {
        // consultando quais os params que tem esse grupo
        $this->group = $id;
        $this->permissions = array();

        $sql = "SELECT params FROM permission_groups WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $id_company);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();

            // consultando esses 'params' para saber quais os nomes
            // e no final adicionar cada nome ao array de $this->permissions
            if (empty($row['params'])) {
                $row['params'] = '0';
            }
            $params = $row['params'];

            $sql = "SELECT name FROM permission_params WHERE id IN ($params) AND id_company = :id_company";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_company', $id_company);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $p = $stmt->fetchAll();
                foreach ($p as $item) {
                    $this->permissions[] = $item['name'];
                }
            }
        }
    }

    public function hasPermission($name) {
        if (in_array($name, $this->permissions)) {
            return true;
        }
        return false;
    }

    public function getList($id_company) {
        $array = array();

        $stmt = $this->db->prepare("SELECT * FROM permission_params WHERE id_company = :id_company");
        $stmt->bindParam(':id_company', $id_company);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetchAll();
        }

        return $array;
    }
    
    public function add($name, $id_company) {
        $sql = "INSERT INTO permission_params SET name = :name, id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id_company', $id_company);
        $stmt->execute();
    }
    
    public function delete($id) {
        $sql = "DELETE FROM permission_params WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}
