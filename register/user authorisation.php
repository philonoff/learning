<?php

include "session.php";

class UserAuthorisation
{
    private $login;
    private $password;
    private $submit;
    public $errors = [];

    function __construct($userData)
    {
        $this->login = $userData['login'];
        $this->password = $userData['password'];
        $this->submit = $userData['submit'];
    }

    public function checkIfExists()
    {
        if (isset($this->submit)) {
            if (file_exists("users_data.txt")) {
                $firstTempArr = preg_split("/;/", file_get_contents("users_data.txt"), 0, PREG_SPLIT_NO_EMPTY);
                foreach ($firstTempArr as $value) {
                    $secondTempArr = preg_split("/,/", $value, 0, PREG_SPLIT_NO_EMPTY);
                    if ($secondTempArr[0] === $this->login && $secondTempArr[1] === $this->password) {
                        $user = $secondTempArr[0];
                        Session::set('user', $user);
                        header('location: index.php?msg=Вы успешно зашли на сайт!');
                    } else {
                        $this->errors['doesntExist'] = "Пользователя с данным логином не существует";
                    }
                }
            }
        }
    }

}

?>