<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Volcano.php');
include('classes/Country.php');
include('classes/VolcType.php');
include('classes/Template.php');

$volcano = new Volcano($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$volcano->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $volcano->getVolcanoById($id);
        $row = $volcano->getResult();

        $data .= '<div class="card text-center">
            <div class="card-header">
                <h5 class="fw-bold">'. $row['volcano_name'] .'</h5>
            </div>
            <div class="card-body row">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['img_file'] . '" class="img-thumbnail" alt="' . $row['img_file'] . '" width="60">
                    </div>
                </div>
                <div class="col-9">
                    <div class="card px-3">
                        <table class="text-start">
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td>' . $row['country_name'] . '</td>
                            </tr>
                            <tr>
                                <td>Volcano Type</td>
                                <td>:</td>
                                <td>' . $row['volc_type_name'] . '</td>
                            </tr>
                            <tr>
                                <td>Last Eruption</td>
                                <td>:</td>
                                <td>' . $row['last_eruption'] . '</td>
                            </tr>
                            <tr>
                                <td>Latitude</td>
                                <td>:</td>
                                <td>' . $row['latitude'] . '</td>
                            </tr>
                            <tr>
                                <td>Lognitude</td>
                                <td>:</td>
                                <td>' . $row['longitude'] . '</td>
                            </tr>
                            <tr>
                                <td>Summit</td>
                                <td>:</td>
                                <td>' . $row['summit'] . '</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="editvolcano.php?id='. $row['id_volcano'] .'"><button type="button" class="btn btn-warning me-2">Edit</button></a>
                <a href="detail.php?delete='. $row['id_volcano'] .'"><button type="button" class="btn btn-danger">Delete</button></a>
            </div>
        </div>';
    } else {
        echo "<script>
            alert('Data not found.');
            document.location.href = 'index.php';
        </script>";
    }
}
else if (isset($_GET['delete'])) {
    if ($volcano->deleteData($_GET['delete']) > 0) {
        echo "<script>
            alert('Data deleted successfully!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('delete data failed.');
            document.location.href = 'detail.php?id=".$_GET['delete']."';
        </script>";
    }
}

$volcano->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_VOLCANO', $data);
$detail->write();
