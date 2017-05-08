<?php

class Clients extends Model {

    public function getList($offset) {
        $stmt = $this->db->prepare("SELECT * FROM clients LIMIT $offset, 10");
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }
    }
    
    public function add($idCompany, $name, $email, $phone, $stars, $internal_obs, 
                        $address_zipcode, $address, $address_number, $address2, $address_neighb, 
                        $address_city, $address_state, $address_country) {
        $sql = "INSERT INTO clients SET id_company = :id_company, name = :name, email = :email,
            phone = :phone, stars = :stars, internal_obs = :internal_obs, address_zipcode = :address_zipcode,
            address = :address, address_number = :address_number, address2 = :address2,
            address_neighb = :address_neighb, address_city = :address_city, address_state = :address_state, address_country = :address_country";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':stars', $stars);
        $stmt->bindParam(':internal_obs', $internal_obs);
        $stmt->bindParam(':address_zipcode', $address_zipcode);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':address_number', $address_number);
        $stmt->bindParam(':address2', $address2);
        $stmt->bindParam(':address_neighb', $address_neighb);
        $stmt->bindParam(':address_city', $address_city); 
        $stmt->bindParam(':address_state', $address_state); 
        $stmt->bindParam(':address_country', $address_country);
        $stmt->execute();
    }

}
