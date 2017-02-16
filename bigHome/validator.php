<?php

class Validator
{
    public $formData;
    public $formFile;
    public $errors = array();
    public $errorFlag = false;

    function __construct($formData, $formFile)
    {
        $this->formData = $formData;
        $this->formFile = $formFile;
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
        //Массив имен полей, которые следует проверить на заполненность
        $fields = array('login', 'password', 'passwordRepeat', 'textarea', 'email');

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

    //Метод, проверяющий загруженный файл на соответствие формату, размеру и отсутствие разного рода ошибок.
    private function checkFile()
    {
        $file = $this->formFile['userfile'];

        $errors_files = array(
            "1" => "Размер принятого файла превысил максимально допустимый размер.",
            "2" => "Размер загружаемого файла превысил значение.",
            "3" => "Загружаемый файл был получен только частично.",
            "4" => "Не выбран файл для загрузки.",
            "6" => "Отсутствует временная папка.",
            "7" => "Не удалось записать файл на диск.",
            "8" => "Программа остановилы загрузку файла."
        );

        if (isset($file)) {

            if ($file['error'] === 0) {

                if ($file['size'] < 2097152) {

                    $type = mb_substr($file['name'], mb_strrpos($file['name'], '.', 0, "UTF-8") + 1, null, "UTF-8");
                    $type = mb_strtolower($type, "UTF-8");

                    if ($type === "png") {

                        $path_to_document = $_SERVER['DOCUMENT_ROOT'] . "/bigHome/pictures/";
                        $result = move_uploaded_file(
                            $file['tmp_name'], $path_to_document . md5(Date("Y-m-d H:i:s")) . "." . "png"
                        );

                    } else {
                        $this->errors['userfile'] = "Допустимый формат файла: PNG";
                        $this->errorFlag = true;
                    }

                } else {
                    $this->errors['userfile'] = "Размер файла больше 2Мб";
                    $this->errorFlag = true;
                }

            } else {
                $this->errors['userfile'] = $errors_files[$file['error']];
                $this->errorFlag = true;
            }
        }
    }

    //Метод, проверящий взведённость хотя бы одного checkbox'а
    private function checkCheckboxes()
    {
        if (isset($this->formData['submit']) && count($this->formData['checkboxes']) === 0) {
            $this->errors['checkboxes'] = "Должен быть взведен хотя бы один checkbox";
            $this->errorFlag = true;
        }
    }

    //Метод, проверяющий, выбрано ли в multiselect'е не менее двух значений
    private function checkMultiselect()
    {
        if (isset($this->formData['submit']) && count($_POST['days']) < 2) {
            $this->errors['multiselect'] = "В multiselect должно быть выбрано не менее 2-х вариантов.";
            $this->errorFlag = true;
        }
    }

    //Метод для вывода данных
    private function showData()
    {
        if (!$this->errorFlag) {
            echo "<ul>";
            foreach ($this->formData as $fieldName => $fieldValue) {
                if (is_array($fieldValue)) {
                    echo "<li>{$fieldName}:<ul>";
                    foreach ($fieldValue as $subValue) {
                        echo "<li>$subValue</li>";
                    }
                    echo "</ul></li>";
                } else {
                    echo "<li>{$fieldName}: {$fieldValue}</li>";
                }
            }
            echo "</ul>";
        }
    }

    //Main метод
    public function checkForm()
    {
        $this->checkEmptyFields();
        $this->isEmail();
        $this->checkPasswords();
        $this->checkFile();
        $this->checkCheckboxes();
        $this->checkMultiselect();
        $this->showData();
    }

}

?>