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

function pdoSet($allowed, &$values, $source = array()) {
    $set = '';
    $values = array();
    if (!$source) $source = &$_POST;
    foreach ($allowed as $field) {
        if (isset($source[$field])) {
            $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
            $values[$field] = $source[$field];
        }
    }
    return substr($set, 0, -2);
}

if ($_POST['submit']) {
    $values = array('title' => $_POST['title'], 'news_text' => $_POST['news_text']);
    $allowed = ['title','news_text']; // allowed fields
    $sql = "INSERT INTO news_list SET ".pdoSet($allowed,$values);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);
    header('Location: index.php?msg=Новость добавлена');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News</title>
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
            <form action="" method="POST">
                <div class="form-group">
                    <label for="title">Заголовок новости</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Заголовок">
                </div>
                <div class="form-group">
                    <label for="text">Текст новости</label>
                    <textarea class="form-control" name="news_text" rows="10" id="text" placeholder="Текст новости" style="resize: none;"></textarea>
                </div>
                <input type="submit" name="submit" class="btn btn-default" value="Добавить">
            </form>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>
