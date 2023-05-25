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
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["img_file"]["tmp_name"]);
    if($check !== false) {
        // If the file indeed an image, proceed to process the data
        if ($volcano->addData($_POST, $_FILES["img_file"]) > 0) {
            echo "<script>
                alert('Data added successfully!');
                document.location.href = 'addvolcano.php';
            </script>";
        } else {
            echo "<script>
                alert('Add data failed.');
                document.location.href = 'addvolcano.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('File is not an image.');
            document.location.href = 'addvolcano.php';
        </script>";
    }
}
else {
    $pageTitle = "Add Volcano";

    $formAction = "addvolcano.php";

    $inputName = '<input type="text" class="form-control" id="volcano_name" name="volcano_name" required>';

    $inputIdCountry = '<option disabled hidden selected>Select the country</option>';
    $listCountry->getCountry();
    while ($country = $listCountry->getResult()) {
        $inputIdCountry .= '<option value='. $country['id_country'] .'>'. $country['country_name'] .'</option>';
    }
    
    $inputIdVolcType = '<option disabled hidden selected>Select the volcano type</option>';
    $listVolcType->getVolcType();
    while ($volcType = $listVolcType->getResult()) {
        $inputIdVolcType .= '<option value="'. $volcType['id_volc_type'] .'">'. $volcType['volc_type_name'] .'</option>';
    }

    $inputLastEruption = '<input type="number" class="form-control" id="last_eruption" name="last_eruption" required>';

    $inputLatitude = '<input type="number" step=any class="form-control" id="latitude" name="latitude" required>';

    $inputLongitude = '<input type="number" step=any class="form-control" id="longitude" name="longitude" required>';

    $inputSummit = '<input type="number" step=any class="form-control" id="summit" name="summit" required>';

    $inputImgFile = '<input type="file" accept="image/*" class="form-control" id="img_file" name="img_file" required>';
    
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

$volcano->close();
$listCountry->close();
$listVolcType->close();
