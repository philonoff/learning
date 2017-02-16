<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

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

//для статических запросов query()
//$stmt = $pdo->query("SELECT name FROM region_stage_1");
//while ($row = $stmt->fetch()) {
//    echo $row['name'] . "<br>";
//}

//$levelId = $_POST['level'];
//$sql = "SELECT name FROM region_stage_1 WHERE school_class = ?";
//$stmt->execute(array($school_class));
//$sql = "SELECT name FROM region_stage_1 WHERE school_class = :school_class";

//$stmt = $pdo->prepare("SELECT name,surname,sex,school_class FROM region_stage_1 WHERE level_id = ?");
//$stmt->execute(array($levelId));
//foreach ($stmt as $value) {
//    echo "<pre>";
//    print_r($value);
//    echo "</pre>";
//}


?>

<form action="" method="POST">
    <input type="text" name="level">
    <input type="submit" name="submit">
</form>
