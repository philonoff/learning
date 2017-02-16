<?php
session_start();
include "session.php";

Session::destroy();

header('Location: index.php?msg=Вы вышли из аккаунта');