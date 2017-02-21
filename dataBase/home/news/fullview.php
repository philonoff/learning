<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/home/models/news.class.php";
$news = new News();
$id = (int)$_GET['id'];
$news_data = $news->getItemById($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Редактировать новость</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">
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
            <h2><?=$news_data['title']?></h2>
            <p style="font-size: 18px;"><?=$news_data['news_text']?></p>
            <ul class="nav nav-pills pull-right">
                <li role="presentation"><a class='btn btn-default btn-sm' href='edit.php?id=<?=$news_data['id']?>'>Редактировать</a></li>
                <li role="presentation"><a class='btn btn-default btn-sm btn btn-danger' href='delete.php?id=<?=$news_data['id']?>''>Удалить</a></li>
            </ul>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>

