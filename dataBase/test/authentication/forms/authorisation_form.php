<?php

include "session.php";

class UserAuthorisation
{
    private $login;
    private $password;
    private $rememberMe;
    private $submit;
    public $errors = [];

    function __construct($userData)
    {
        $this->login = $userData['login'];
        $this->password = $userData['password'];
        $this->submit = $userData['submit'];
        $this->rememberMe = $userData['rememberMe'];
    }

    private function checkIfExists()
    {
        $firstTempArr = preg_split("/;/", file_get_contents("users_data.txt"), 0, PREG_SPLIT_NO_EMPTY);
        foreach ($firstTempArr as $value) {
            $secondTempArr = preg_split('/,/', $value, 0, PREG_SPLIT_NO_EMPTY);
            if ($secondTempArr[0] === $this->login && $secondTempArr[1] === $this->password) {
                return $secondTempArr[0];
            }
        }
        $this->errors['doesntExist'] = "Пользователя с данным логином не существует или пароль введен неверно";
        return false;
    }

    public function signIn()
    {
        if (isset($this->submit)) {
            if (file_exists("users_data.txt")) {
                if ($this->checkIfExists()) {
                    if (isset($this->rememberMe)) {
                        setcookie("login", $this->login, time() + 9999999);
                        setcookie("password", $this->password, time() + 9999999);
                    }
                    $user = $this->checkIfExists();
                    Session::set('user', $user);
                    header('location: index.php?msg=Вы успешно зашли на аккаунт');
                }
            }
        }
    }

}

?>