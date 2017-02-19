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
    private function getCleanData($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);

        return $data;
    }

    //Медот для проверки полей на заполненность
    private function checkEmptyFields()
    {
        foreach ($this->formData as $fieldName => $fieldValue) {
            if (empty($this->getCleanData($fieldValue))) {
                $this->errors[$fieldName] = "Поле {$fieldName} не заполнено";
                $this->errorFlag = true;
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

    //Main метод
    public function checkForm()
    {
        $this->checkEmptyFields();
        $this->isEmail();
    }
}

?>