<?php

class Photo extends DB_object {
    protected static $db_table = "photos";
    protected static $db_table_fields = ["id", "title", "caption", "description", "filename", "alternate_text", "type", "size"];
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";

    
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
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }
   

    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }

    public function save(){
        if ($this->id) {
            $this->update();
        } else {
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "File was not available"; 
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} alredy exists";
                return false; 
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "File directory probably does not have permission for upload";
                return false;
            }
        } 
    } 

    public function delete_photo(){
        $target_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();
        unlink($target_path);
        return $this->delete() ? true : false;
        /* if ($this->delete()) {
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
       */
    }
}