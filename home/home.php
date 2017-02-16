<?php

//Функция для очистки данных из поля от лишних символов
function getCleanData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);

    return $data;
}

//Массив ошибок, выводимых при незаполнении полей
$emptyFieldErrors = array(
    'login' => "Введите логин<br>",
    'password' => "Введите пароль<br>",
    'passwordRepeat' => "Повторите пароль<br>",
    'textarea' => "Заполните поле textarea<br>"
);

//Результирующая строка с ошибкой/ошибками;
$error = "";

//Поля, которые нужно проверить на пустоту
$fields = array($_POST['login'], $_POST['password'], $_POST['passwordRepeat'], $_POST['textarea']);

//Проверка полей на пустоту
foreach ($_POST as $fieldName => $fieldValue) {

    if (in_array($_POST[$fieldName], $fields)) {

        if (getCleanData($fieldValue) === '') {
            $error .= $emptyFieldErrors[$fieldName];
        }
    }
}

//проверка на совпадение введенных паролей
if (!($_POST['password'] === $_POST['passwordRepeat'])) {
    $error .= "Пароли не совпадают<br>";
}

//Проверка количества взведенных checkbox'ов
if (count($_POST['checkboxes']) === 0) {
    $error .= "Должен быть взведен хотя бы один checkbox<br>";
}

//Проверка количества выбраных элементов в multiselect'е
if (count($_POST['days']) < 2) {
    $error .= "В multiselect должно быть выбрано не менее 2-х вариантов.<br>";
}

//Вывод полей и их значений в случае, если форма заполнена верно
if ($error === "") {
    echo "<ul>";
    foreach ($_POST as $name => $value) {

        if (is_array($value)) {
            echo "<li>{$name}:<ul>";

            foreach ($value as $subValue) {
                echo "<li>$subValue</li>";
            }

            echo "</ul></li>";

        } else {
            echo "<li>{$name}: {$value}</li>";
        }
    }
    echo "</ul>";
}


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
    <style>
        div {
            margin: 15px 0 15px 0;
        }
    </style>
</head>
<body>
<form name="form" action="" method="post">
    <div>
        Введите логин: <input type="text" name="login">
    </div>
    <div>
        Введите пароль пароль: <input type="password" name="password">
    </div>
    <div>
        Повторите пароль: <input type="password" name="passwordRepeat">
    </div>
    <div>
        Скрытое поле hidden <input type="hidden" name="hiddenField" value="hidden data">
    </div>
    <hr>
    <div>
        <p>Heзависимые переключатели(checkbox):</p>
        <label>
            <input type="checkbox" name="checkboxes[]" value="firstCheckbox"> Вариант первый
        </label>
        <label>
            <input type="checkbox" name="checkboxes[]" value="secondCheckbox"> Вариант второй
        </label>
        <label>
            <input type="checkbox" name="checkboxes[]" value="thirdCheckbox" checked> Вариант третий
        </label>
    </div>
    <hr>
    <div>
        <p>Зависимые переключатели(radio):</p>
        <label>
            <input type="radio" name="radioBtn" value="yes">Да
        </label>
        <label>
            <input type="radio" name="radioBtn" value="no">Нет
        </label>
    </div>
    <hr>
    <div>
        <p>Многострочное текстовое поле (textarea):</p>
        <textarea name="textarea" cols="40" rows="10">Текст по умолчанию</textarea>
    </div>
    <hr>
    <div>
        <p>Список с единственным выбором:</p>
        <select name="day">
            <option value="1">Понедельник</option>
            <option value="2">Вторник</option>
            <option value="3" selected>Среда</option>
            <option value="4">Четверг</option>
            <option value="5">Пятница</option>
            <option value="6">Суббота</option>
            <option value="7">Воскресенье</option>
        </select>
        <p>Список с множественным выбором:</p>
        <select name="days[]" multiple size="7">
            <option value="1" selected>Понедельник</option>
            <option value="2">Вторник</option>
            <option value="3">Среда</option>
            <option value="4">Четверг</option>
            <option value="5">Пятница</option>
            <option value="6">Суббота</option>
            <option value="7">Воскресенье</option>
        </select>
    </div>
    <hr>
    <div>
        <input type="submit" value="Отослать форму">
        <input type="reset" value="Очистить форму">
    </div>
</form>
<div>
    <?php echo $error ?>
</div>
</body>
</html>


