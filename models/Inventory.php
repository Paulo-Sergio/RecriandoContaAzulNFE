<?php

class Inventory extends Model {

    public function getList($offset, $idCompany) {
        $sql = "SELECT * FROM inventory WHERE id_company = :id_company LIMIT $offset, 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_company", $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $sql->fetchAll();
        }
        return null;
    }

}
