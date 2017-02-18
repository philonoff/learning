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

$stmt = $pdo->prepare('SELECT title, news_text FROM news_list WHERE id = ?');
$stmt->execute(array($id));
$row = $stmt->fetch();

$title = $row['title'];
$text = $row['news_text'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Редактировать новость</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-left">
                <li role="presentation"><a href="index.php">Главная</a></li>
                <li role="presentation"><a href="addnews.php">Добавить новость</a></li>
            </ul>
        </nav>
    </div>

    <div class="row marketing">
        <div class="col-lg-12">
            <h2><?=(isset($title)) ? $title : "" ?></h2>
            <p style="font-size: 18px;"><?=(isset($text)) ? $text : "" ?></p>
            <ul class="nav nav-pills pull-right">
                <li role="presentation"><a class='btn btn-default btn-sm' href='editnews.php?id=<?=$id?>'>Редактировать</a></li>
                <li role="presentation"><a class='btn btn-default btn-sm btn btn-danger' href='deletenews.php?id=<?=$id?>''>Удалить</a></li>
            </ul>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>

