<?php

//error_reporting(E_ALL);
ini_set("display_errors", 1);

function printr($data) {
    echo "<pre>";
    print_r($data);
    echo "<pre>";
}

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

//Позиционный плейсхолдер
//$stmt = $pdo->prepare('SELECT name FROM region_stage_1 WHERE level_id = ?');
//$stmt->execute(array($_POST['level']));
//foreach ($stmt as $row) {
//    echo $row['name'] . "</br>";
//}

//Именованный плейсхолдер
//$stmt = $pdo->prepare('SELECT name FROM region_stage_1 WHERE level_id = :level_id');
//$stmt->execute(array('level_id' => $_POST['level']));
//foreach ($stmt as $row) {
//    echo $row['name'] . "</br>";
//}

//PDO::FETCH_LAZY
//$stmt = $pdo->prepare('SELECT name FROM region_stage_1 WHERE level_id = :level_id');
//$stmt->execute(array('level_id' => $_POST['level']));
//while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
//    echo $row->name . "<br>";
//}

//fetchColumn() используем, если запрашиваем только одно полеz
//$stmt = $pdo->prepare('SELECT name FROM region_stage_1 WHERE id = :id');
//$stmt->execute(array('id' => $_POST['id']));
//$name = $stmt->fetchColumn();

//$stmt = $pdo->prepare('SELECT name FROM region_stage_1 WHERE level_id = :level_id');
//$stmt->execute(['level_id' => $_POST['level']]);
//$array = $stmt->fetchAll();
//foreach ($array as $user) {
//    echo $user['name'] . "<br>";
//}

//Получение колонки
//$data = $pdo->query('SELECT name FROM region_stage_1')->fetchAll(PDO::FETCH_COLUMN);
//printr($data);

//Получение пар ключ-значение.
//$data = $pdo->query('SELECT id, name FROM region_stage_1')->fetchAll(PDO::FETCH_KEY_PAIR);
//printr($data);


//Получение всех строк, индексированных полем.
//$data = $pdo->query('SELECT * FROM region_stage_1')->fetchAll(PDO::FETCH_UNIQUE);
//printr($data);
?>

<form action="" method="POST">
    <input type="text" name="level">
    <input type="submit" name="submit">
</form>
