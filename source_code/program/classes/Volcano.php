<?php

class Volcano extends DB {
    function getVolcanoJoin() {
        $query = "SELECT * FROM volcano JOIN country ON volcano.id_country=country.id_country JOIN volc_type ON volcano.id_volc_type=volc_type.id_volc_type ORDER BY volcano.id_volcano";
        return $this->execute($query);
    }

    function getVolcano() {
        $query = "SELECT * FROM volcano";
        return $this->execute($query);
    }

    function getVolcanoById($id) {
        $query = "SELECT * FROM volcano JOIN country ON volcano.id_country=country.id_country JOIN volc_type ON volcano.id_volc_type=volc_type.id_volc_type WHERE id_volcano = $id";
        return $this->execute($query);
    }

    function searchVolcano($keyword) {
        $query = "SELECT * FROM volcano JOIN country ON volcano.id_country=country.id_country JOIN volc_type ON volcano.id_volc_type=volc_type.id_volc_type WHERE volcano_name LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data, $file) {
        $volcano_name = $data['volcano_name'];
        $id_country = $data['id_country'];
        $id_volc_type = $data['id_volc_type'];
        $last_eruption = $data['last_eruption'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $summit = $data['summit'];

        $img_file = time()."-".rand(1000, 9999)."-".$file['name'];
        $location = "assets/images/".$img_file;
        if (!move_uploaded_file($file['tmp_name'], $location)) {
            echo "<script>
                console.log('Error occurred while uploading the file.');
            </script>";
            return false;
        }

        $query = "INSERT INTO volcano VALUES('', '$volcano_name', $id_country, $id_volc_type, $last_eruption, $latitude, $longitude, $summit, '$img_file')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file) {
        $volcano_name = "volcano_name='".$data['volcano_name']."'";
        $id_country = "id_country=".$data['id_country'];
        $id_volc_type = "id_volc_type=".$data['id_volc_type'];
        $last_eruption = "last_eruption=".$data['last_eruption'];
        $latitude = "latitude=".$data['latitude'];
        $longitude = "longitude=".$data['longitude'];
        $summit = "summit=".$data['summit'];

        if ($file == null) {
            $img_file = '';
        } else {
            $new_name = time()."-".rand(1000, 9999)."-".$file['name'];
            $location = "assets/images/".$new_name;
            if (!move_uploaded_file($file['tmp_name'], $location)) {
                echo "<script>
                    console.log('Error occurred while uploading the file.');
                </script>";
                return false;
            }
            $img_file = ",img_file='".$new_name."'";
        }

        $query = "UPDATE volcano SET $volcano_name, $id_country, $id_volc_type, $last_eruption, $latitude, $longitude, $summit $img_file WHERE id_volcano=$id";
        return $this->executeAffected($query);
    }
    
    function deleteData($id) {
        $query = "DELETE FROM volcano WHERE id_volcano = $id";
        return $this->executeAffected($query);
    }
}