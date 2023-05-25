<?php

include('config/db.php');
include('classes/DB.php');
include('classes/VolcType.php');
include('classes/Template.php');

$volcTypes = new VolcType($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$volcTypes->open();
$volcTypes->getVolcType();

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

$pageTitle = "Types of Volcano";
$tableHeader = '<tr>
    <th scope="row">#</th>
    <th scope="row">Type of volcano</th>
    <th scope="row">Actions</th>
</tr>';
$tableRows = '';
$counter = 0;
while ($row = $volcTypes->getResult()) {
    $counter += 1;
    $tableRows .= '<tr>
        <th scope="row">'.$counter.'</th>
        <td>'.$row['volc_type_name'].'</td>
        <td style="font-size: 22px;">
            <a type="button" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$row['id_volc_type'].'" data-value="'.$row['volc_type_name'].'">
                <i class="bi bi-pencil-square text-warning"></i>
            </a>
            &nbsp;
            <a href="volctype.php?hapus='.$row['id_volc_type'].'" title="Delete Data">
                <i class="bi bi-trash-fill text-danger"></i>
            </a>
        </td>
    </tr>';
}
$inputLabel = "Type of volcano";
$inputId = '<input type="hidden" class="form-control" name="id_volc_type">';
$inputValue = '<input type="text" class="form-control" placeholder="Type of volcano" name="volc_type_name">';
$keyId = "id_volc_type";
$keyValue = "volc_type_name";

// Close connection
$volcTypes->close();

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