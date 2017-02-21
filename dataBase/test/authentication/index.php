<?php
session_start();
include "session.php";

function checkIfExists($login, $password)
{
    $firstTempArr = preg_split("/;/", file_get_contents("users_data.txt"), 0, PREG_SPLIT_NO_EMPTY);
    foreach ($firstTempArr as $value) {
        $secondTempArr = preg_split('/,/', $value, 0, PREG_SPLIT_NO_EMPTY);
        if ($secondTempArr[0] === $login && $secondTempArr[1] === $password) {
            return true;
        }
    }
    return false;
}

if ($_COOKIE) {
    $user = isset($_COOKIE['login']) ? $_COOKIE['login'] : null;
    $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
    if (file_exists("users_data.txt")) {
        if (checkIfExists($user, $password)) {
            Session::set('user', $user);
        }
    }
}

?>

<?php if (Session::has('user')) : ?>
    <a href="logout.php"> Выйти (<?= Session::get('user'); ?>)</a>
    <a href="../country/index.php">Список стран</a>
<?php else : ?>
    <a href="registration.php">Регистрация</a>
    <a href="authorisation.php">Авторизация</a>
    <a href="../country/index.php">Список стран</a>
<?php endif; ?>

<div class="msg">
    <?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
</div>

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