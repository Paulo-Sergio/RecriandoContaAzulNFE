<?php

class Purchases extends Model {

    public function getList($offset, $idCompany) {
        $sql = "SELECT * FROM purchases WHERE id_company = :id_company ORDER BY date_purchase DESC LIMIT $offset, 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return null;
    }

    public function getTotalExpenses($period1, $period2, $idCompany) {
        $sql = "SELECT SUM(total_price) AS total "
                . "FROM purchases "
                . "WHERE id_company = :id_company "
                . "AND date_purchase BETWEEN :period1 AND :period2";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':period1', $period1);
        $stmt->bindParam(':period2', $period2);
        $stmt->execute();

        $row = $stmt->fetch();
        $result = $row['total'];

        return floatval($result);
    }

}
