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
        $sql = "INSERT INTO inventory_history SET id_company = :id_company, "
                . "id_product = :id_product, id_user = :id_user, action = 'add', date_action = NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->bindParam(":id_product", $idProduct);
        $stmt->bindParam(":id_user", $idUser);
        $stmt->execute();
    }

}
