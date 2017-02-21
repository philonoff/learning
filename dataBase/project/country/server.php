<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once $_SERVER['DOCUMENT_ROOT'].'/group1-16/project/models/country.class.php';

if (isset($_GET['oper'])) {
    $oper = $_GET['oper'];
    if ( $oper === "add") {
        //добавление страны в базу данных
        $data = $_POST;
        $data['create_date'] = Date("Y-m-d H:i:s");
        $country_class = new Country();
        $result = $country_class->add($data);
        if($result) {
            header("Location:/group1-16/project/country/index.php");
        }
    }
}

if ( $oper === "edit") {
    $data = $_POST;
    $data['edit_date'] = Date("Y-m-d H:i:s");
    $country_class = new Country();
    $result = $country_class->edit($data, "id=".$data['id']); //если не подставим where отредактируются все записи

    if($result) {
        header("Location:/group1-16/project/country/index.php");
    }
}

?>