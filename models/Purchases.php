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
                . "AND date_purchase BETWEEN :period1 AND NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':period1', $period1);
        //$stmt->bindParam(':period2', $period2);
        $stmt->execute();

        $row = $stmt->fetch();
        $result = $row['total'];

        return floatval($result);
    }

    public function getExpensesList($period1, $period2, $idCompany) {
        $array = array();

        $currentDay = $period1;
        while ($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(date_purchase, '%Y-%m-%d') as date_purchase, SUM(total_price) as total_price "
                . "FROM purchases "
                . "WHERE id_company = :id_company "
                . "AND date_purchase BETWEEN :period1 AND :period2 "
                . "GROUP BY DATE_FORMAT(date_purchase, '%Y-%m-%d')";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':period1', $period1);
        $stmt->bindParam(':period2', $period2);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $rows = $stmt->fetchAll();
            //var_dump($rows);exit;
            foreach ($rows as $sale_item) {
                $array[$sale_item['date_purchase']] = $sale_item['total_price'];
            }
        }

        return $array;
    }

}
