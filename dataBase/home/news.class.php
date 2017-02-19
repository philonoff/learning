<?php

include "database.php";

class NewsHandler
{
    private function pdoSet($allowed, &$values, $source = array())
    {
        $set = '';
        $values = array();
        if (!$source) $source = &$_POST;
        foreach ($allowed as $field) {
            if (isset($source[$field])) {
                $set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
                $values[$field] = $source[$field];
            }
        }
        return substr($set, 0, -2);
    }

    public static function showNews()
    {
        $pdo = DataBase::connect();
        return $pdo->query("SELECT id, title, news_text FROM news_list ORDER BY publication_date DESC");
    }

    public static function addNews()
    {
        if ($_POST['submit']) {
            $pdo = DataBase::connect();
            $values = array('title' => $_POST['title'], 'news_text' => $_POST['news_text']);
            $allowed = ['title', 'news_text']; // allowed fields
            $sql = "INSERT INTO news_list SET " . NewsHandler::pdoSet($allowed, $values);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);
            header('Location: index.php?msg=Новость добавлена&flag=added');
        }
    }

    public static function getNews()
    {
        $pdo = DataBase::connect();
        $stmt = $pdo->prepare('SELECT title, news_text FROM news_list WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        return $stmt->fetch();
    }

    public static function editNews()
    {
        $pdo = DataBase::connect();
        if ($_POST['submit']) {
            $values = array('title' => $_POST['title'], 'news_text' => $_POST['news_text']);
            $allowed = array("title", "news_text"); // allowed fields
            $sql = "UPDATE news_list SET ".NewsHandler::pdoSet($allowed,$values)." WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $values['id'] = $_GET['id'];
            $stmt->execute($values);
            header("Location: editnews.php?id={$_GET['id']}&msg=Сохранено");
        }
    }

    public static function deleteNews()
    {
        $pdo = DataBase::connect();
        $id = $_GET['id'];
        $stmt = $pdo->prepare('DELETE FROM news_list WHERE id = ?');
        $stmt->execute(array($id));
        header('Location: index.php?msg=Новость удалена&flag=del');
    }
}

?>