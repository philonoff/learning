<?php
session_start();

include 'forms/validator.php';
include 'forms/authorisation_form.php';

$authoValidation = new AuthorisationValidator($_POST);
$authoValidation->checkForm();

if (!$authoValidation->errorFlag) {
    $authorisationForm = new UserAuthorisation($_POST);
    $authorisationForm->signIn();
}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        div {
            margin: 15px 0 15px 0;
        }

        div > div {
            margin: 5px 0 15px 0;
            color: red;
        }
    </style>
</head>
<body>
<h2>Авторизация:</h2>

<form action="" method="post">
    <div>
        Введите логин: <input type="text" name="login">
        <div><?= $authoValidation->errors['login'] ?></div>
    </div>
    <div>
        Введите пароль: <input type="password" name="password">
        <div><?= $authoValidation->errors['password'] ?></div>
    </div>
    <div>
        <label><input type="checkbox" name="rememberMe">Запомнить меня!</label>
        <div><?= $authorisationForm->errors['doesntExist'] ?></div>
    </div>
    <input type="submit" name="submit">
</form>
</body>
</html>
