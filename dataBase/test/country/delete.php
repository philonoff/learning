<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/test/models/country.class.php";

$country_class = new Country();
$id = (int)$_GET['id'];
$result = $country_class->delete($id);

if ($result) {
    header('Location: index.php');
}
?>