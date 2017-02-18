<?php
//error_reporting(E_ALL);
ini_set("display_errors", 1);

function printr($data) {
    echo "<pre>";
    print_r($data);
    echo "<pre>";
}

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

//fetchColumn() используем, если запрашиваем только одно поле
//$stmt = $pdo->prepare('SELECT name FROM region_stage_1 WHERE id = :id');
//$stmt->execute(array('id' => $_POST['id']));
//$name = $stmt->fetchColumn();
//
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

//PDO и оператор LIKE
//$name = "%{$_POST['str']}%";
//$stmt = $pdo->prepare("SELECT name FROM areas WHERE name LIKE :name");
//$stmt->execute(array('name' => $name));
//foreach ($stmt as $row) {
//    echo $row['name'] . "<br>";
//}

//PDO и оператор IN
//$arr = array(4,5);
//$in = str_repeat('?,', count($arr)-1) . '?';
//$sql = "SELECT * FROM areas WHERE utc_timezone IN ($in)";
//$stmt = $pdo->prepare($sql);
//$stmt->execute($arr);
//$data = $stmt->fetchAll();
//printr($data);

function pdoSet($allowed, &$values, $source = array()) {
    $set = '';
    $values = array();
    if (!$source) $source = &$_POST;
    printr($allowed);
    printr($values);
    printr($source);
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
    printr($sql);
    $stmt = $pdo->prepare($sql);
    var_dump($stmt);
    $stmt->execute($values);
}

?>

<form action="" method="post">
    <input type="text" name="title">
    <input type="text" name="news_text">
    <input type="submit" name="submit">
</form>

