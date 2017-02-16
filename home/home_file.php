<?php
//    phpinfo(); die;
//    $_POST = array_map(trim, $_POST);
//    $data = $_POST;
//    if (($_POST['login'] == '') || ($_POST['pass'] == '')) {
//        echo "Заполните поля";
//    } elseif (($_POST['login'] == 'admin') && ($_POST['pass'] == '123456')) {
//        echo "Успешно";
//    }

$data = $_FILES;

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

$allow = ['jpg', "png", 'gif'];

var_dump($_FILES['userfile']);
echo "<br>";

if (isset($_FILES['userfile'])) {

    if ($_FILES['userfile']['error'] === 0) {

        //проверка размера файла
        if ($_FILES['userfile']['size'] < 1048576) {

            //проверка на тип файла
            $type = mb_substr($_FILES['userfile']['name'], mb_strrpos($_FILES['userfile']['name'], '.', 0, "UTF-8") + 1, null, "UTF-8");
            $type = mb_strtolower($type, 'UTF-8');
            if (in_array($type, $allow)) {
                $path_to_upload = $_SERVER['DOCUMENT_ROOT'] . '/group1-16/uploads/';
//                $fileName = mb_substr($_FILES['userfile']['name'], 0, mb_strrpos($_FILES['userfile']['name'], '.', 0, "UTF-8"), "UTF-8");
                $result = move_uploaded_file(
                    $_FILES['userfile']['tmp_name'], $path_to_upload . md5(Date("Y-m-d H:i:s")) . "." . $type
                );
// в папку с пиками залить файлы php и html
                var_dump($path_to_upload);
                var_dump($result);
            } else {
                $error = "необходимо загружать только картинку";
            }
        } else {
            $error = "Размер файла больше 1Мб";
        }
    } else {
        $error = $errors_files[$_FILES['userfile']['error']];
    }
}
print_r($error);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="test.php" method="POST" enctype="multipart/form-data">
    <!--скрытый инпут перед каждым полем с загрузкой файла-->
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
    <input type="file" name="userfile">
    <input type="submit">
</form>
</body>
</html>