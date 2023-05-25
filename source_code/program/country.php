<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Country.php');
include('classes/Template.php');

$countries = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$countries->open();
$countries->getCountry();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($divisi->addDivisi($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'divisi.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'divisi.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$pageTitle = "Countries";
$tableHeader = '<tr>
    <th scope="row">#</th>
    <th scope="row">Country</th>
    <th scope="row">Actions</th>
</tr>';
$tableRows = '';
$counter = 0;
while ($row = $countries->getResult()) {
    $counter += 1;
    $tableRows .= '<tr>
        <th scope="row">'.$counter.'</th>
        <td>'.$row['country_name'].'</td>
        <td style="font-size: 22px;">
            <a type="button" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$row['id_country'].'" data-value="'.$row['country_name'].'">
                <i class="bi bi-pencil-square text-warning"></i>
            </a>
            &nbsp;
            <a href="country.php?hapus='.$row['id_country'].'" title="Delete Data">
                <i class="bi bi-trash-fill text-danger"></i>
            </a>
        </td>
    </tr>';
}
$inputLabel = "Country";
$inputId = '<input type="hidden" class="form-control" name="id_country">';
$inputValue = '<input type="text" class="form-control" placeholder="Country" name="country_name">';
$keyId = "id_country";
$keyValue = "country_name";

// Close connection
$countries->close();

// Instantiate template
$index = new Template('templates/skintable.html');

// Insert data to template
$index->replace('DATA_PAGE_TITLE', $pageTitle);
$index->replace('DATA_TABLE_HEADER', $tableHeader);
$index->replace('DATA_TABLE_ROWS', $tableRows);
$index->replace('DATA_INPUT_LABEL', $inputLabel);
$index->replace('DATA_INPUT_ID', $inputId);
$index->replace('DATA_INPUT_VALUE', $inputValue);
$index->replace('DATA_KEY_ID', $keyId);
$index->replace('DATA_KEY_VALUE', $keyValue);
$index->write();