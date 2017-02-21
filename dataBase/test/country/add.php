<h1>Добавление страны</h1>
<form method="POST" action="server.php?oper=add">
    <div>
        <label>Название:</label><input type="text" name="name" required>
    </div>
    <div>
        <input type="submit" value="Сохранить">
    </div>
    <div>
        <button type="button" onclick="document.location.href='index.php'">Отмена</button>
    </div>
</form>
