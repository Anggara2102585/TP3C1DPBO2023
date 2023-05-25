<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Volcano.php');
include('classes/Country.php');
include('classes/VolcType.php');
include('classes/Template.php');

$volcano = new Volcano($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$volcano->open();
$listCountry = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listCountry->open();
$listVolcType = new VolcType($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listVolcType->open();

if (isset($_POST['submit'])) {
    $flag = null;
    if ($_FILES["img_file"]["tmp_name"] != '') {
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["img_file"]["tmp_name"]);
        if($check !== false) {
            // If the file indeed an image, proceed to process the data
            $flag = $volcano->updateData($_POST['id_volcano'], $_POST, $_FILES["img_file"]);
        } else {
            echo "<script>
                alert('File is not an image.');
                document.location.href = 'editvolcano.php?id=". $_POST['id_volcano'] ."';
            </script>";
        }
    } else {
        $flag = $volcano->updateData($_POST['id_volcano'], $_POST, null);
    }

    if ($flag > 0) {
        echo "<script>
            alert('Data updated successfully!');
            document.location.href = 'editvolcano.php?id=". $_POST['id_volcano'] ."';
        </script>";
    } else {
        echo "<script>
            alert('Update data failed.');
            document.location.href = 'editvolcano.php?id=". $_POST['id_volcano'] ."';
        </script>";
    }
}
else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $volcano->getVolcanoById($id);
    if ($row = $volcano->getResult()) {

        $pageTitle = "Edit Volcano";

        $formAction = "editvolcano.php";

        $hiddenInput = '<input type="hidden" class="form-control" name="id_volcano" value="'. $row['id_volcano'] .'" required>';

        $inputName = '<input type="text" class="form-control" id="volcano_name" name="volcano_name" value="'. $row['volcano_name'] .'" required>';
        $inputName .= $hiddenInput;

        $inputIdCountry = '<option selected value='. $row['id_country'] .'>'. $row['country_name'] .'</option>';
        $listCountry->getCountry();
        while ($country = $listCountry->getResult()) {
            if ($country['id_country'] != $row['id_country']) {
                $inputIdCountry .= '<option value='. $country['id_country'] .'>'. $country['country_name'] .'</option>';
            }
        }
        
        $inputIdVolcType = '<option selected value='. $row['id_volc_type'] .'>'. $row['volc_type_name'] .'</option>';
        $listVolcType->getVolcType();
        while ($volcType = $listVolcType->getResult()) {
            if ($volcType['id_volc_type'] != $row['id_volc_type']) {
                $inputIdVolcType .= '<option value="'. $volcType['id_volc_type'] .'">'. $volcType['volc_type_name'] .'</option>';
            }
        }

        $inputLastEruption = '<input type="number" class="form-control" id="last_eruption" name="last_eruption" value="'. $row['last_eruption'] .'" required>';

        $inputLatitude = '<input type="number" step=any class="form-control" id="latitude" name="latitude" value="'. $row['latitude'] .'" required>';

        $inputLongitude = '<input type="number" step=any class="form-control" id="longitude" name="longitude" value="'. $row['longitude'] .'" required>';

        $inputSummit = '<input type="number" step=any class="form-control" id="summit" name="summit" value="'. $row['summit'] .'" required>';

        $inputImgFile = '<input type="file" accept="image/*" class="form-control" id="img_file" name="img_file">';
        
        $formVolcano = new Template('templates/skinformvolcano.html');
        $formVolcano->replace('DATA_PAGE_TITLE', $pageTitle);
        $formVolcano->replace('DATA_INPUT_NAME', $inputName);
        $formVolcano->replace('DATA_INPUT_ID_COUNTRY', $inputIdCountry);
        $formVolcano->replace('DATA_INPUT_ID_VOLC_TYPE', $inputIdVolcType);
        $formVolcano->replace('DATA_INPUT_LAST_ERUPTION', $inputLastEruption);
        $formVolcano->replace('DATA_INPUT_LATITUDE', $inputLatitude);
        $formVolcano->replace('DATA_INPUT_LONGITUDE', $inputLongitude);
        $formVolcano->replace('DATA_INPUT_SUMMIT', $inputSummit);
        $formVolcano->replace('DATA_INPUT_IMG_FILE', $inputImgFile);
        $formVolcano->write();
    }
    else {
        echo "<script>
            alert('Data not found.');
            document.location.href = 'index.php';
        </script>";
    }
}

$volcano->close();
$listCountry->close();
$listVolcType->close();
