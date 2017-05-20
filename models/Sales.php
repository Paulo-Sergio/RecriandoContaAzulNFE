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

    public function add($idCompany, $clientId, $userId, $totalPrice, $status) {
        $sql = "INSERT INTO sales SET id_company = :id_company, id_client = :id_client, "
                . "id_user = :id_user, date_sale = NOW(), total_price = :total_price, "
                . "status = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':id_client', $clientId);
        $stmt->bindParam(':id_user', $userId);
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }

}
