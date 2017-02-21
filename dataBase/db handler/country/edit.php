<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/group1-16/project/models/country.class.php';
$country_class = new Country;
$id = (int)$_GET['id'];
$data_country = $country_class->getItemById($id);
?>

<form method="POST" action="server.php?oper=edit">
    <p>
        <label>Название:</label><input type="text" name="name" value="<?=$data_country['name']?>" required>
        <input type="hidden" name ="id" value="<?=$data_country['id']?>">
    </p>
    <p>
        <input type="submit" value="Сохранить">
    </p>
    <p>
        <input type="submit" onclick="document.location.href='index.php'" value="Отмена">
    </p>
</form>