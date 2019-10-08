<?php

class User extends DB_object {
    protected static $db_table = "users";
    protected static $db_table_fields = ["username", "password", "first_name", "last_name", "user_image"];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "https://via.placeholder.com/400?text=image";
    public $errors = [];
    public  $upload_errors_array = [
        UPLOAD_ERR_OK => 'There is no error, the file uploaded with success.',
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded.',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Cannot write to target directory. Please fix CHMOD.',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.'
    ];


    // This is passing $_FILES['file_upload'] as an argument

    public function set_file($file){
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "File was not uploaded";
            return false;
        } else if($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }
   
    public function image_path_placeholder(){
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }
    
    public function save_image(){
        /* if ($this->id) {
            $this->update();
        } else { */
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->user_image) || empty($this->tmp_path)) {
                $this->errors[] = "File was not available"; 
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
            if (file_exists($target_path)) {
                $this->errors[] = "The picture: {$this->user_image} alredy exists, choose another filename ";
                return false; 
            }
            if (move_uploaded_file($this->tmp_path, $target_path)) {
                    unset($this->tmp_path);
                    return true;
                } else {
                    $this->errors[] = "File directory probably does not have permission for upload";
                    return false;
                }

       /*  }  */
    } 

  /*   public function save_user(){
        $this->create();
    }  */

    public static function verify_user($username, $password){
        $params = [$username, $password];
        $sql = "SELECT * FROM " .self::$db_table. " WHERE username = ? AND password = ?";
        $result_array = self::find_by_query($sql, $params);
        //print_r($result_array);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public function delete_user_photo(){
        $target_path = SITE_ROOT.DS. 'admin' . DS . $this->image_path_placeholder();
        unlink($target_path);
        return true;
    }


}
