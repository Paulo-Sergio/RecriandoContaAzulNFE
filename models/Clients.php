<?php

class Clients extends Model {

    public function getList($offset, $idCompany) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE id_company = :id_company LIMIT $offset, 10");
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
    }

    public function getInfo($id, $idCompany) {
        $array = array();

        $sql = "SELECT * FROM clients WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetch();
        }

        return $array;
    }

    public function getCount($idCompany) {
        $sql = "SELECT COUNT(*) as c FROM clients WHERE id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        $row = $stmt->fetch();
        return $row['c'];
    }

    public function add($idCompany, $name, $email = '', $phone = '', $stars = 3, $internal_obs = '', $address_zipcode = '', $address = '', $address_number = '', $address2 = '', $address_neighb = '', $address_city = '', $address_state = '', $address_country = '', $address_citycode = '', $address_countrycode = 1058) {
        $sql = "INSERT INTO clients SET id_company = :id_company, name = :name, email = :email,
            phone = :phone, stars = :stars, internal_obs = :internal_obs, address_zipcode = :address_zipcode,
            address = :address, address_number = :address_number, address2 = :address2,
            address_neighb = :address_neighb, address_city = :address_city, address_citycode = :address_citycode, 
            address_state = :address_state, address_country = :address_country, address_country_code = :address_country_code";
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
        $stmt->bindParam(':address_citycode', $address_citycode);
        $stmt->bindParam(':address_state', $address_state);
        $stmt->bindParam(':address_country', $address_country);
        $stmt->bindParam(':address_country_code', $address_countrycode);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function edit($id, $idCompany, $name, $email, $phone, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country, $address_citycode) {
        $sql = "UPDATE clients SET id_company = :id_company, name = :name, email = :email,
            phone = :phone, stars = :stars, internal_obs = :internal_obs, address_zipcode = :address_zipcode,
            address = :address, address_number = :address_number, address2 = :address2,
            address_neighb = :address_neighb, address_city = :address_city, address_citycode = :address_citycode,
            address_state = :address_state, address_country = :address_country, address_countrycode = 1058 
            WHERE id = :id AND id_company = :id_company2";
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
        $stmt->bindParam(':address_citycode', $address_citycode);
        $stmt->bindParam(':address_state', $address_state);
        $stmt->bindParam(':address_country', $address_country);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company2', $idCompany);
        $stmt->execute();
    }

    public function searchClientsByName($name, $idCompany) {
        $array = array();

        $sql = "SELECT name, id FROM clients WHERE name LIKE :name LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $name = '%' . $name . '%';
        $stmt->bindParam(':name', $name);
        //$stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetchAll();
        }

        return $array;
    }

}
