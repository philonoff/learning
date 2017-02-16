<?php

include "validator.php";

$form = new Validator($_POST, $_FILES);

$form->checkForm();

?>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        Введите логин: <input type="text" name="login"
                              value="<?= ($form->errorFlag) ? $form->formData['login'] : "" ?>">
        <div><?= $form->errors['login'] ?></div>
    </div>
    <div>
        Введите пароль пароль: <input type="password" name="password"
                                      value="<?= ($form->errorFlag) ? $form->formData['password'] : "" ?>">
        <div><?= $form->errors['password'] ?></div>
    </div>
    <div class="passwords"><?= $form->errors['passwords'] ?></div>
    <div>
        Повторите пароль: <input type="password" name="passwordRepeat"
                                 value="<?= ($form->errorFlag) ? $form->formData['passwordRepeat'] : "" ?>">
        <div><?= $form->errors['passwordRepeat'] ?></div>
    </div>
    <div>
        Введите email: <input type="text" name="email"
                              value="<?= ($form->errorFlag) ? $form->formData['email'] : "" ?>">
        <div><?= $form->errors['email'] ?></div>
    </div>
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
        Загрузить фотографию: <input type="file" name="userfile">
        <div><?= $form->errors['userfile'] ?></div>
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
        <div><?= $form->errors['checkboxes'] ?></div>
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
        <textarea name="textarea" cols="40"
                  rows="10"><?= ($form->errorFlag) ? $form->formData['textarea'] : "" ?></textarea>
        <div><?= $form->errors['textarea'] ?></div>
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
        <div><?= $form->errors['multiselect'] ?></div>
    </div>
    <hr>
    <div>
        <input type="submit" name="submit" value="Отослать форму">
        <input type="reset" value="Очистить форму">
    </div>
</form>

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

