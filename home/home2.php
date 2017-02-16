<?php

function printr($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

$error = "";

$errors_files = array(
    "1" => "Размер принятого файла превысил максимально допустимый размер.",
    "2" => "Размер загружаемого файла превысил значение.",
    "3" => "Загружаемый файл был получен только частично.",
    "4" => "Не выбран файл для загрузки.",
    "6" => "Отсутствует временная папка.",
    "7" => "Не удалось записать файл на диск.",
    "8" => "Программа остановилы загрузку файла."
);

$allow = array("txt", "doc", "docx", "odt", "rtf", "pdf");
$file = $_FILES['userfile'];

if (isset($file)) {

    if ($file['error'] === 0) {

        if ($file['size'] < 2097152) {

            $type = mb_substr($file['name'], mb_strrpos($file['name'], '.', 0, "UTF-8") + 1, null, "UTF-8");
            $type = mb_strtolower($type, "UTF-8");

            if (in_array($type, $allow)) {

                $path_to_document = $_SERVER['DOCUMENT_ROOT'] . "/documents/";
                $result = move_uploaded_file(
                    $file['tmp_name'], $path_to_document . md5(Date("Y-m-d H:i:s")) . "." . $type
                );

            } else {
                $error = "Допустимые форматы файла: \"txt\", \"doc\", \"docx\", \"odt\", \"rtf\", \"pdf\";";
            }

        } else {
            $error = "Размер файла больше 2Мб";
        }

    } else {
        $error = $errors_files[$file['error']];
    }

}

printr($file);
printr($result);
printr($error);


?>


<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type="file" name="userfile">
    <input type="submit">
</form>
</body>
</html>
