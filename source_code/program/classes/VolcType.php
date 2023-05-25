<?php

class VolcType extends DB {
    function getVolcType() {
        $query = "SELECT * FROM volc_type";
        return $this->execute($query);
    }

    function getVolcTypeById($id) {
        $query = "SELECT * FROM volc_type WHERE id_volc_type = $id";
        return $this->execute($query);
    }

    function addVolcType($data) {
        $volc_type_name = $data['volc_type_name'];
        $query = "INSERT INTO volc_type VALUES(, $volc_type_name)";
        return $this->executeAffected($query);
    }

    function updateVolcType($id, $data) {
        $volc_type_name = $data['volc_type_name'];
        $query = "UPDATE volc_type set volc_type_name = $volc_type_name WHERE id_volc_type = $id";
        return $this->executeAffected($query);
    }
    
    function deleteVolcType($id) {
        $query = "DELETE FROM volc_type WHERE id_volc_type = $id";
        return $this->executeAffected($query);
    }
}
