<?php

class Sales extends Model {

    public function getList($offset, $idCompany) {
        $sql = "SELECT s.id, s.date_sale, s.total_price, s.status, c.name "
                . "FROM sales s "
                . "LEFT JOIN clients c ON s.id_client = c.id "
                . "WHERE s.id_company = :id_company "
                . "ORDER BY s.date_sale DESC LIMIT $offset, 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }

        return null;
    }

}
