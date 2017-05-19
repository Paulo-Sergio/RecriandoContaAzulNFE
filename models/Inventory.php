<?php

class Inventory extends Model {

    public function getList($offset, $idCompany) {
        $sql = "SELECT * FROM inventory WHERE id_company = :id_company LIMIT $offset, 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return null;
    }

    public function getInfo($id, $idCompany) {
        $sql = "SELECT * FROM inventory WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }
        return null;
    }

    public function add($name, $price, $quant, $min_quant, $idCompany, $idUser) {
        $sql = "INSERT INTO inventory SET name = :name, price = :price, quant = :quant, min_quant = :min_quant, id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quant", $quant);
        $stmt->bindParam(":min_quant", $min_quant);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        // pegando o id do produto inserido no inventory
        $idProduct = $this->db->lastInsertId();

        // como se fosse um log de uso
        // já persiste no inventory_history
        $this->setLog($idProduct, $idCompany, $idUser, 'add');
    }

    public function edit($id, $name, $price, $quant, $min_quant, $idCompany, $idUser) {
        $sql = "UPDATE inventory "
                . "SET name = :name, price = :price, quant = :quant, min_quant = :min_quant "
                . "WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quant", $quant);
        $stmt->bindParam(":min_quant", $min_quant);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        // como se fosse um log de uso
        // já persiste no inventory_history
        $this->setLog($id, $idCompany, $idUser, 'edt');
    }

    public function delete($id, $idCompany, $idUser) {
        $sql = "DELETE FROM inventory WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        // como se fosse um log de uso
        // já persiste no inventory_history
        //$this->setLog($id, $idCompany, $idUser, 'del');
    }

    private function setLog($idProduct, $idCompany, $idUser, $action) {
        $sql = "INSERT INTO inventory_history SET id_company = :id_company, "
                . "id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->bindParam(":id_product", $idProduct);
        $stmt->bindParam(":id_user", $idUser);
        $stmt->bindParam(":action", $action);
        $stmt->execute();
    }

}
