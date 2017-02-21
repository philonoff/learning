<?php
session_start();
include "session.php";
setcookie('login');
setcookie('password');
Session::delete('user');
Session::destroy();
header('Location: index.php?msg=Вы вышли из аккаунта');
?>