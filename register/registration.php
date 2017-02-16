<?php

include "validator.php";
include "user registration.php";

$regValidation = new Validator($_POST);
$regValidation->checkForm();

if (!$regValidation->errorFlag) {
    $registrationForm = new UserRegistration($_POST);
    $registrationForm->userRegistering();
}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Authorisation</title>
    <style>
        div {
            margin: 15px 0 15px 0;
        }

        div > div {
            margin: 5px 0 15px 0;
            color: red;
        }

        div.passwords {
            color: red;
        }
    </style>
</head>
<body>
<h2>Регистрация:</h2>
<form action="" method="post">
    <div>
        Введите логин: <input type="text" name="login" value="<?= ($regValidation->errorFlag) ? $regValidation->formData['login'] : "" ?>">
        <div><?= $regValidation->errors['login'] ?></div>
    </div>
    <div>
        Введите пароль: <input type="password" name="password">
        <div><?= $regValidation->errors['password'] ?></div>
    </div>
    <div class="passwords"><?= $regValidation->errors['passwords'] ?></div>
    <div>
        Повторите пароль: <input type="password" name="passwordRepeat">
        <div><?= $regValidation->errors['passwordRepeat'] ?></div>
    </div>
    <div>
        Введите email: <input type="text" name="email" value="<?= ($regValidation->errorFlag) ? $regValidation->formData['email'] : "" ?>">
        <div><?= $regValidation->errors['email'] ?></div>
        <div><?= $registrationForm->errors['alreadyExists'] ?></div>
    </div>
    <input type="submit" name="submit">
</form>
</body>
</html>
