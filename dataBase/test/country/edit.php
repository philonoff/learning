<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/dataBase/test/models/country.class.php";

$country_class = new Country();
$id = (int)$_GET['id'];
$data_country = $country_class->getItemById($id);
?>

<form action="server.php?oper=edit" method="POST">
    <div>
        <label>Название:</label><input type="text" name="name" value="<?=$data_country['name']?>" required>
        <input type="hidden" name="id" value="<?=$data_country['id']?>">
    </div>
    <div>
        <input type="submit" value="Сохранить">
    </div>
    <div>
        <button type="button" onclick="document.location.href='index.php'">Отмена</button>
    </div>
</form>
