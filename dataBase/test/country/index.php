<?php
session_start();
include_once "../authentication/session.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/dataBase/test/models/country.class.php";

$country_class = new Country();
$list = $country_class->getAll();

?>


<?php if (Session::has('user')) : ?>
    <div>
        <a href="../authentication/logout.php"> Выйти (<?= Session::get('user'); ?>)</a>
        <a href="add.php">Добавить страну</a>
    </div>
    <br>
    <h1>Список стран</h1>
    <?php foreach ($list as $country) {?>
        <div>
            <?=$country['name']?>
            <a href="edit.php?id=<?=$country['id']?>">Редактировать</a>
            <a href="delete.php?id=<?=$country['id']?>">Удалить</a>
        </div>
        <br>
    <?php }?>
<?php else : ?>
    <h1>Список стран</h1>
    <?php foreach ($list as $country) {?>
        <div>
            <?=$country['name']?>
        </div>
    <?php }?>
<?php endif; ?>

<style>

    a {
        display: inline-block;
        padding: 5px 10px;
        background-color: rgb(96, 130, 187);
        text-decoration: none;
        color: white;
        font-family: Verdana, Verdana, Geneva, sans-serif;
    }

    .msg {
        display: inline-block;
        padding: 5px 10px;
        font-family: Verdana, Verdana, Geneva, sans-serif;
    }
</style>

