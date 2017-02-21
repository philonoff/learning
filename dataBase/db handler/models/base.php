<?php
//класс для работы с бд
class DB
{
 
    private $host = "localhost";
    private $user = "root";
    private $password = "root";
    private $db = "cars";
    private $charset = "utf8";
   
    public $pdo;
 
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, $this->user, $this->password, $opt);
    }
    
    /**
         * Внутренная функция для формирования строки SET
         * @param Array $items
         * @return String
         */
    private function set_fields($items)
    {
        $str = array();
        if (empty($items)) {
            return "";
        }
        foreach ($items as $key => $value){
            $str[] = "`".$key."`=:".$key;
        }
        return implode(',', $str);
    }
    
    /**
     * добавление записи в базу данных
     * @param type $data - ассоциативный массив данных
     * @return type Description
     */
    public function add($data)
    {
        $fields = $this->set_fields($data);
        $sql = "INSERT INTO {$this->table_name} SET " . $fields;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table_name}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getItemById($id)
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE id=" . $id;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
//        return ($result) ? $result[0] : false;
    }
    
    /**
    * Обновление данных в таблице. Опциональный параметр $where
    * @param Array $data - данные обновления
    * @param String $where - критерий поиска.
    * @return Boolean
    */
    public function edit($data, $where = "")
    {
        $fields = $this->set_fields($data);
        $sql = "UPDATE `{$this->table_name}` SET ".$fields;
        if(!empty($where)){
            $sql.= " WHERE ".$where;
        }
        $stmt = $this->pdo->prepare( $sql );
        return $stmt->execute($data);
    }
 
}

?>