<?php

class DB_object {


    public static function find_all(){
        $sql = "SELECT * FROM " .static::$db_table;
        return static::find_querys($sql);
    }

    public static function find_by_id($id){
        $sql = "SELECT * FROM " .static::$db_table. " WHERE id = ?";
        //print_r($sql);
        $result_array = static::find_by_query($sql, $id);
        //print_r($result_array);
        /* foreach ($result_array as $result) {
            return $result;
        }  */
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_query($sql, $params){
        global $database;
        $get_row = $database->get_row($sql, $params);
        $object_array[] = static::instantination($get_row);
       return $object_array;
    }

    public static function find_querys($sql){
        global $database;
        $get_rows = $database->get_rows($sql);
        $object_array = [];
        foreach($get_rows as $get_row) {
            $object_array[] = static::instantination($get_row);
        }
       return $object_array;
    }

    public static function instantination($record){

        if (!$record) {
            return false;
        }
        $calling_class = get_called_class();
        $new_object = new $calling_class;
        
        foreach ($record as $property => $value) {
            if ($new_object->has_the_attribute($property)) {
                $new_object->$property = $value;
            } 
        }
        return $new_object;
    } 

    private function has_the_attribute($property){
        $object_properties = get_object_vars($this);
        return array_key_exists($property, $object_properties);
    } 

    public function properties(){
        //return get_object_vars($this);
        $properties = [];
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
      return $properties;
    }

    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create(){
        global $database;
        $properties = $this->properties();
        $length = count($properties);
       
        $statements = [];
        for ($i=0; $i < $length; $i++) { 
            $statements[] = "?";
        }
        $positional_statements = implode(", ", $statements);

        $obj_keys = array_keys($properties);
        $obj_values = array_values($properties); 
        
        $sql = "INSERT INTO " .static::$db_table. " (" . implode(", ", $obj_keys)  . ")" .  " VALUES (" . $positional_statements . ")";
        $this->id = $database->last_insert_id();
        $database->insert_row($sql, $obj_values); 
    }

    public function update(){
        global $database;
        $properties = $this->properties();
        $obj_keys = array_keys($properties);
        $obj_values = array_values($properties);
        array_push($obj_values, $this->id);

        $properties_pairs = [];
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key} = ?";
        }
        $pairs = implode(', ', $properties_pairs);

        //$params = [$this->username, $this->password, $this->first_name, $this->last_name, $this->id];
        //$sql = "UPDATE " .static::$db_table. " SET username = ?, password = ?, first_name = ?, last_name = ? WHERE id = ?";
        
        $sql = "UPDATE " .static::$db_table. " SET " . $pairs . " WHERE id = ?";
        
        $database->update_row($sql, $obj_values);
    }

    public function delete(){
        global $database;
        $params = [$this->id];
        $sql = "DELETE FROM " .static::$db_table. " WHERE id = ?";
        $database->delete_row($sql, $params);
    }

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $get_rows = $database->get_rows($sql);
        $row = array_shift($get_rows);
        return array_shift($row);
    }
}