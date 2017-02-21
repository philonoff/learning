<h1>Добавление страны</h1>
<form method="POST" action="server.php?oper=add">
    <p>
        <label>Название:</label><input type="text" name="name" required>
    </p>
    <p>
        <input type="submit" value="Сохранить">
    </p>
    <p>
        <input type="submit" onclick="document.location.href='index.php'" value="Отмена">
    </p>
</form>