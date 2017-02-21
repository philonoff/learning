<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/group1-16/project/models/country.class.php';

$country_class = new Country();
$list = $country_class->getAll();
?>
<h1>Список стран</h1>
<a href="add.php">Добавить страну</a>

<?php foreach ($list as $country) {?>
    <p>
        <?php echo $country['name']?>
        <a href="edit.php?id=<?=$country['id']?>">Редактировать</a>
    </p>
<?php } ?>