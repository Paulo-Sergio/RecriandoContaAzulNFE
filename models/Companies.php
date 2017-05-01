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

}
