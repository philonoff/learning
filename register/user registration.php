<?php

class UserRegistration
{
    private $login;
    private $password;
    private $passwordRepeat;
    private $email;
    private $submit;
    public $errors = [];

    function __construct($userData)
    {
        $this->login = $userData['login'];
        $this->password = $userData['password'];
        $this->passwordRepeat = $userData['passwordRepeat'];
        $this->email = $userData['email'];
        $this->submit = $userData['submit'];
    }

    private function checkIfExists() {
        $firstTempArr = preg_split("/;/", file_get_contents("users_data.txt"), 0, PREG_SPLIT_NO_EMPTY);
        foreach ($firstTempArr as $value) {
            $secondTempArr = preg_split('/,/', $value, 0, PREG_SPLIT_NO_EMPTY);
            if ($secondTempArr[0] === $this->login or $secondTempArr[2] === $this->email) {
                $this->errors['alreadyExists'] = "Пользователь с данным логином или email'ом уже существует!";
                return false;
            }
        }
        return true;
    }

    private function filing() {
        $dataFile = fopen("users_data.txt", 'a');
        fwrite($dataFile, "$this->login,$this->password,$this->email;");
        fclose($dataFile);
    }

    public function userRegistering()
    {
        if (isset($this->submit)) {
            if (file_exists("users_data.txt")) {
                if ($this->checkIfExists()) {
                    $this->filing();
                }
            } else {
                $this->filing();
            }
        }
    }
}