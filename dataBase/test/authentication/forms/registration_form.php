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

    private function checkIfExists()
    {
        $firstTempArr = preg_split("/;/", file_get_contents("users_data.txt"), 0, PREG_SPLIT_NO_EMPTY);
        foreach ($firstTempArr as $value) {
            $secondTempArr = preg_split('/,/', $value, 0, PREG_SPLIT_NO_EMPTY);
            if ($secondTempArr[0] === $this->login || $secondTempArr[2] === $this->email) {
                $this->errors['alreadyExists'] = "Пользователь с данным логином или email'ом уже существует!";
                return false;
            }
        }
        return true;
    }

    private function filing()
    {
        $dataFile = fopen("users_data.txt", 'a');
        fwrite($dataFile, "$this->login,$this->password,$this->email;");
        fclose($dataFile);
    }

    private function sendMail()
    {
        $dataFile = fopen("user.txt", 'a+');
        fwrite($dataFile, "Данные для входа на сайт:" . PHP_EOL . "Логин: $this->login" . PHP_EOL . "Пароль: $this->password");
        fclose($dataFile);

        $to = $this->email;
        $subject = "Регистрация на сайте";
        $message = "Вы были успешно зарегистрированы на сайте";
        $filename = "user.txt";

        $boundary = "--" . md5(uniqid(time()));
        $mailheaders = "MIME-Version: 1.0;\r\n";
        $mailheaders .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        $mailheaders .= "From: admin@gmail.com\r\n";
        $mailheaders .= "Reply-To: admin@gmail.com\r\n";

        $multipart = "--$boundary\r\n";
        $multipart .= "Content-Type: text/html; charset=windows-1251\r\n";
        $multipart .= "Content-Transfer-Encoding: base64\r\n";
        $multipart .= "\r\n";
        $multipart .= chunk_split(base64_encode(iconv("utf8", "windows-1251", $message)));

        $fp = fopen($filename, "r");
        if (!$fp) {
            print "Не удается открыть файл22";
            exit();
        }

        $file = fread($fp, filesize($filename));
        fclose($fp);


        $message_part = "\r\n--$boundary\r\n";
        $message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
        $message_part .= "Content-Transfer-Encoding: base64\r\n";
        $message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
        $message_part .= "\r\n";
        $message_part .= chunk_split(base64_encode($file));
        $message_part .= "\r\n--$boundary--\r\n";

        $multipart .= $message_part;

        mail($to, $subject, $multipart, $mailheaders);

        if (time_nanosleep(5, 0)) {
            unlink($filename);
        }

        header('location: index.php?msg=Вы успешно зарегистрированы на сайте');
    }

    public function signUp()
    {
        if (isset($this->submit)) {
            if (file_exists("users_data.txt")) {
                if ($this->checkIfExists()) {
                    $this->filing();
                    $this->sendMail();
                }
            } else {
                $this->filing();
                $this->sendMail();
            }
        }
    }
}

?>