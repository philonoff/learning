<?php

class DB
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "News";
    private $charset = "utf8";

    public $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, $this->user, $this->password, $opt);
    }

    /**
     * Внутренняя функция для формирования строки SET
     * @param $items Принимает данные из формы
     * На основании массива данных из формы формируют строку
     * вида `field_name`=:field_name
     * @return string
     */
    private function set_fields($items)
    {
        $str = array();
        if (empty($items)) {
            return "";
        }
        foreach ($items as $key => $value) {
            $str[] = "`" . $key . "`=:". $key;
        }
        return implode(",", $str);
    }

    /**
     * Добавление записи в базу данных
     * Свойство table_name создаем в классе наследнике
     * @param $data Принимает данные из формы
     * @return bool Возвратит true, если запрос выполнен, в противном случае - false
     */
    public function add($data)
    {
        $fields = $this->set_fields($data);
        $sql = "INSERT INTO {$this->table_name} SET " . $fields;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * @return array Возвращает массив всех данных из БД
     */
    public function getAll($order = "")
    {
        $sql = "SELECT * FROM {$this->table_name}";
        if (!empty($order)) {
            $sql .= " ORDER BY " . $order ;
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * @param $id Принимает id элемента
     * @return mixed
     */
    public function getItemById($id)
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE id=" . $id;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    /**
     * @param $data
     * @param string $where
     * @return bool
     */
    public function edit($data, $where = "")
    {
        $fields = $this->set_fields($data);
        $sql = "UPDATE `{$this->table_name}` SET" . $fields;
        if (!empty($where)) {
            $sql .= " WHERE " . $where;
        }
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        if (isset($id)) {
            $sql = "DELETE FROM {$this->table_name} WHERE id=" . $id;
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute();
        }
        return false;
    }

}

?>