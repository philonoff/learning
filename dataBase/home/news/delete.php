<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/home/models/news.class.php";

$news = new News();
$id = (int)$_GET['id'];
$result = $news->delete($id);

if ($result) {
    header('Location: index.php?msg=Новость удалена&flag=del');
}

?>