<?php

class Cidade extends Model {

    public function getStates() {
        $sql = "SELECT Uf FROM cidade GROUP BY Uf";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return null;
    }
    
    public function getCityList($state) {
        $sql = "SELECT Nome, CodigoMunicipio FROM cidade WHERE Uf = :uf";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':uf', $state);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return null;
    }
    
    public function getCity($idCity) {
        $sql = "SELECT Nome FROM cidade WHERE CodigoMunicipio = :codMunicipio";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':codMunicipio', $idCity);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch()['Nome'];
        }
        return null;
    }

}
