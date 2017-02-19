<?php

abstract class DataBase
{
    public static function connect()
    {
        $host = "localhost";
        $db = "News";
        $charset = "UTF8";
        $user = "root";
        $pass = "";

        //источник данных database source name
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        //options
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        return new PDO($dsn, $user, $pass, $opt);
    }
}

?>