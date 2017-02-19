<?php

include "news.class.php";
NewsHandler::addNews();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавить новость</title>
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
                <li role="presentation" class="active"><a href="#">Добавить новость</a></li>
            </ul>
        </nav>
    </div>

    <div class="row marketing">
        <div class="col-lg-12">
            <h3>Добавить новость:</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="title">Заголовок новости</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Заголовок">
                </div>
                <div class="form-group">
                    <label for="text">Текст новости</label>
                    <textarea class="form-control" name="news_text" rows="10" id="text" placeholder="Текст новости"
                              style="resize: none;"></textarea>
                </div>
                <input type="submit" name="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>
