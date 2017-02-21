<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/home/models/news.class.php";
$news = new News();
$news_list = $news->getAll("`create_date` DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новости</title>
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
                <li role="presentation" class="active"><a href="index.php">Главная</a></li>
                <li role="presentation"><a href="add.php">Добавить новость</a></li>
            </ul>
        </nav>
    </div>

    <div class="row marketing">
        <div class="col-lg-12">
            <?php
            if (isset($_GET['msg']) && $_GET['flag'] === "added") {
                echo "<div class='btn-lg bg-success'>{$_GET['msg']}</div>";
            } elseif (isset($_GET['msg']) && $_GET['flag'] === "del") {
                echo "<div class='btn-lg bg-danger'>{$_GET['msg']}</div>";
            }
            ?>
            <table class="table table-hover">
                <?php
                    if (count($news_list) === 0) {
                        echo "<h4>Пока нет ни одной новости</h4>";
                    } else {
                        echo "<thead><tr><th colspan='3'><h3>Новости</h3></th></tr></thead>";
                        foreach ($news_list as $news) {
                            $result = "<tr>";
                            $result .= "<td width='85%'><a href='fullview.php?id={$news['id']}'>{$news['title']}</a></td>";
                            $result .= "<td><a class='btn btn-default btn-sm' href='edit.php?id={$news['id']}'>Редактировать</a></td>";
                            $result .= "<td><a class='btn btn-default btn-sm btn btn-danger' href='delete.php?id={$news['id']}'>Удалить</a></td>";
                            $result .= "</tr>";
                            echo $result;
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>

