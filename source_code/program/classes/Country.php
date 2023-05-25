<?php

class Country extends DB {
    function getCountry() {
        $query = "SELECT * FROM country";
        return $this->execute($query);
    }

    function getCountryById($id) {
        $query = "SELECT * FROM country WHERE id_country = $id";
        return $this->execute($query);
    }

    function addCountry($data) {
        $country_name = $data['country_name'];
        $query = "INSERT INTO country VALUES(, $country_name)";
        return $this->executeAffected($query);
    }

    function updateCountry($id, $data) {
        $country_name = $data['country_name'];
        $query = "UPDATE country set country_name = $country_name WHERE id_country = $id";
        return $this->executeAffected($query);
    }
    
    function deleteCountry($id) {
        $query = "DELETE FROM country WHERE id_country = $id";
        return $this->executeAffected($query);
    }
}
