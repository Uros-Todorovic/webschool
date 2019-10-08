<?php

class Database {

    private static $instance = null;
    private $connection;
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db_name = "web_school";
    
   // Connect to db
    private function __construct(){
        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}",$this->user,$this->password);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    // Get instance
    public static function get_instance(){
        if (!self::$instance) {
            self::$instance = new Database;
        }
        return self::$instance;
    }

    // Get connection
    public function get_connection(){
        return $this->connection;
    }

   // Disconnet from db
    public function disconnect(){
        $this->connection = NULL;
    }

    // User autentification row 

    /* public function user_login($sql, $username, $password){
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password']))
        {
            return $user;
        } else {
            echo "invalid";
        }
    } */

   // Get a single row
    public function get_row($query, $params = []){
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

   // Get rows
    public function get_rows($query, $params = []){
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

   // Insert row
   public function insert_row($query, $params = []){
        try {
            $stmt = $this->connection->prepare($query);
            $inserted = $stmt->execute($params);
            return $inserted;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    // last insert id

    public function last_insert_id(){
        return $this->connection->lastInsertId();
        
    }

   // Update row
   public function update_row($query, $params = []){
    try {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        $rows_affected = $stmt->rowCount();
        return ($rows_affected == 1) ? true : false;
    } catch (PDOException $e) {
        throw new Exception($e->getMessage());
    }
        
    }


   // Delete row
   public function delete_row($query, $params = []){
        $this->update_row($query, $params);
    }
}

/* $database = Database::get_instance();
$connection = $database->get_connection(); */

/* function die_r($value){
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die;
} */



//$get_row = $database->get_row("SELECT * FROM users WHERE id = ?", ["1"]);

//$get_rows = $database->get_rows("SELECT * FROM users");

//$insert_row = $database->insert_row("INSERT INTO users (username, pass, first_name, last_name) VALUES (?,?,?,?)", ["Generic", "897", "Generic", "Todorovic"]);

//$update_row = $database->update_row("UPDATE users SET username = ?, pass = ?, first_name = ?, last_name = ? WHERE id = ?", ["Urosh", "123", "Uros", "Todorovic", "1"]);

//$delete_row = $database->delete_row("DELETE FROM users WHERE id = ?", ["5"]);

//die_r($delete_row);


