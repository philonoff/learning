<?php

$host = "localhost";
$db = "date";
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

$stmt = $pdo->query("SELECT id, name, surname FROM region_stage_1");

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
            <ul class="nav nav-pills pull-right">
                <li role="presentation" class="active"><a href="index.php">Главная</a></li>
                <li role="presentation"><a href="#">Добавить новость</a></li>
            </ul>
        </nav>
        <h3 class="text-muted">Новости</h3>
    </div>

    <div class="row marketing">
        <div class="col-lg-12">
            <table class="table table-hover">
                <?php
                    $colcount = $stmt->rowCount();
                    if ($colcount > 0) {
                        while ($row = $stmt->fetch()) {
                            $result = "<tr>";
                            $result .= "<td width='85%'>" . $row['name'] . " " . $row['surname'] . "</td>";
                            $result .= "<td><a class='btn btn-default btn-sm' href='editnews.php?id={$row['id']}'>Редактировать</a></td>";
                            $result .= "</tr>";
                            echo $result;
                        }
                    } else {
                        echo "<h4>Пока нет ни одной новости</h4>";
                    }
                ?>
            </table>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>

