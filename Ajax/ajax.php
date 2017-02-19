<?php
session_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<form id="formAuth" action="" method="POST">
    <div>
        Ваш email: <input type="text" name="email">
    </div>
    <div>
        Ваше имя: <input type="password" name="name">
    </div>
    <div>
        Сообщение: <textarea name="message" cols="30" rows="10"></textarea>
    </div>
    <input type="submit">
</form>
<style>
    div {margin: 10px 0;}
</style>

<script>
    $(function () {
        $("#formAuth").submit(function () {
            sendDataToServer();
            return false;
        });
    })

    //Отправка данных авторизации на сервер
    function sendDataToServer() {
        var login = $('[name = "login"]').val();
        $.ajax({
            url: "server_auth.php",
            type: "POST",
            dataType: "json",
            data: $("#formAuth").serialize(),
            success: function (data) {

                if ('errors' in data) {
                    $('.error').remove();
                    $(":input").css({'borderColor' : 'black'});
                    for (var error in data.errors) {
                        $('[name=' + error + ']').css({'border' : '1px solid red'});
                        $('[name=' + error + ']').after("<div class='error'>" + data.errors[error] + "</div>");
                    }
                } else {
                    alert("Ошибок нет!");
                }
            }
        });
    }
</script>

