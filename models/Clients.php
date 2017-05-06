<?php

class Clients extends Model {

    public function getList($offset) {
        $stmt = $this->db->prepare("SELECT * FROM clients LIMIT :offset, 10");
        $stmt->bindParam(':offset', $offset);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }
    }

}
