<?php

$host = "localhost";
$db = "News";
$charset = "UTF8";
$user = "root";
$pass = "";

//источник данных database source name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

//options
$opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

$pdo = new PDO($dsn, $user, $pass, $opt);

$id = $_GET['id'];

//$stmt = $pdo->prepare('SELECT name FROM region_stage_1 WHERE level_id = :level_id');
//$stmt->execute(array('level_id' => $_POST['level']));
$stmt = $pdo->prepare('DELETE FROM news_list WHERE id = ?');
$stmt->execute(array($id));
header('Location: index.php?msg=Новость удалена&flag=del');

?>