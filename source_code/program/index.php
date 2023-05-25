<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Volcano.php');
include('classes/Country.php');
include('classes/Template.php');

// Instantiate volcano
$listVolcano = new Volcano($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Make connection
$listVolcano->open();
// // Get volcano data
// $listVolcano->getVolcanoJoin();

// Handle search
if (isset($_GET['btn-search'])) {
    // Get based on search keyword
    $listVolcano->searchVolcano($_GET['search']);
} else {
    // Get volcano data
    $listVolcano->getVolcanoJoin();
}

$data = null;

// Put volcano data into html tag before then passed to the skin/template
while ($row = $listVolcano->getResult()) {
    $data .= '<a href="detail.php?id='. $row['id_volcano'] .'" class="card mt-3 gx-0 linked-card">
        <img src="assets/images/'. $row['img_file'] .'" class="card-img-top" alt="'. $row['img_file'] .'">
        <div class="card-body">
            <h5 class="card-title">'. $row['volcano_name'] .'</h5>
            <p class="card-text"><small class="text-muted">'. $row['country_name'] .'</small></p>
        </div>
    </a>';
}

// Close connection
$listVolcano->close();

// Instantiate template
$index = new Template('templates/skinvolcano.html');

// Insert data to template
$index->replace('DATA_VOLCANO', $data);
$index->write();