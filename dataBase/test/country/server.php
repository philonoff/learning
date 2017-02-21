<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/test/models/country.class.php";

if (isset($_GET['oper'])) {
    $oper = $_GET['oper'];

    if ($oper === "add") {
        $data = $_POST;
        $data['create_data'] = Date("Y-m-d H:i:s");
        $country_class = new Country();
        $result = $country_class->add($data);
        if ($result) {
            header("Location: index.php");
        }
    } elseif ($oper === "edit") {
        $data = $_POST;
        $data['edit_date'] = Date("Y-m-d H:i:s");
        $country_class = new Country();
        $result = $country_class->edit($data, "id=".$data['id']);
        if ($result) {
            header("Location: index.php");
        }
    }
}


?>