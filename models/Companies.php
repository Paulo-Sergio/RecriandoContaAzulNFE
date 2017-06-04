<?php

class Companies extends Model {

    private $companyInfo;

    public function __construct($id) {
        parent::__construct();

        $stmt = $this->db->prepare("SELECT * FROM companies WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $this->companyInfo = $stmt->fetch();
        }
    }
    
    public function getName() {
        return $this->companyInfo['name'];
    }
    
    public function getNextNFE() {
        $nfeNumber = $this->companyInfo['nfe_number'];
        $nfeNumber++;
        
        return $nfeNumber;
    }
    
    public function setNFE($cNF, $id) {
        $stmt = $this->db->prepare("UPDATE companies SET nfe_number = :nfe_number WHERE id = :id");
        $stmt->bindParam(':nfe_number', $cNF);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}
