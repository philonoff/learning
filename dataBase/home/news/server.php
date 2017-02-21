<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/home/models/news.class.php";

if (isset($_GET['oper'])) {
    $oper = $_GET['oper'];

    if ($oper === "add") {
        $data = $_POST;
        $data['create_date'] = Date("Y-m-d H:i:s");
        $news = new News();
        $result = $news->add($data);
        if ($result) {
            header('Location: index.php?msg=Новость добавлена&flag=added');
        }
    } elseif ($oper === "edit") {
        $data = $_POST;
        $data['edit_date'] = Date("Y-m-d H:i:s");
        $news = new News();
        $result = $news->edit($data, "id=".$data['id']);
        if ($result) {
            header("Location: edit.php?id={$data['id']}&msg=Сохранено");
        }
    }
}

?>