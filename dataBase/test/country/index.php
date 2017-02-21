<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/dataBase/test/models/country.class.php";

$country_class = new Country();
$list = $country_class->getAll();
?>

<h1>Список стран</h1>
<a href="add.php">Добавить страну</a>

<?php foreach ($list as $country) {?>
    <div>
        <?=$country['name']?>
        <a href="edit.php?id=<?=$country['id']?>">Редактировать</a>
        <a href="delete.php?id=<?=$country['id']?>">Удалить</a>
    </div>
<?php }?>