<?php

class Validator
{
    public $formData;
    public $errors = array();
    public $errorFlag = false;

    function __construct($formData)
    {
        $this->formData = $formData;
    }

    //Метод для очистки данных из поля от лишних символов
    protected function getCleanData($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);

        return $data;
    }

    //Медот для проверки полей на заполненность
    protected function checkEmptyFields()
    {
        //Массив имен полей, которые следует проверить на заполненность
        $fields = array('login', 'password', 'passwordRepeat', 'email');

        foreach ($this->formData as $fieldName => $fieldValue) {
            if (in_array($fieldName, $fields)) {
                if (empty($this->getCleanData($fieldValue))) {
                    $this->errors[$fieldName] = "Поле " . $fieldName . " не заполнено";
                    $this->errorFlag = true;
                }
            }
        }
    }

    //Метод, проверяющий, является ли введенное значение email'ом
    private function isEmail()
    {
        $email = $this->getCleanData($this->formData['email']);
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email введен неверно";
            $this->errorFlag = true;
        }
    }

    //Метод для проверки идентичность введенных паролей
    private function checkPasswords()
    {
        if ($this->formData['password'] !== $this->formData['passwordRepeat']) {
            $this->errors['passwords'] = "Пароли не совпадают";
            $this->errorFlag = true;
        }
    }

    //Main метод
    public function checkForm()
    {
        $this->checkEmptyFields();
        $this->isEmail();
        $this->checkPasswords();
    }
}

class AuthorisationValidator extends Validator
{
    public function checkForm()
    {
        parent::checkEmptyFields();
    }
}

?>