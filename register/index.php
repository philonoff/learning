<?php
session_start();

include "session.php";
?>

<?php if (Session::has('user')) : ?>
    <a href="logout.php">Logout (<?=Session::get('user'); ?>)</a>
<?php else : ?>
    <a href="registration.php">Регистрация</a>
    <a href="authorisation.php">Авторизация</a>
<?php endif; ?>

<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
