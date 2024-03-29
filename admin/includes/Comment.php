<?php

class Comment extends DB_object {
    protected static $db_table = "comments";
    protected static $db_table_fields = ["id", "photo_id", "author", "body"];
    public $id;
    public $photo_id;
    public $author;
    public $body;

    public static function create_comment($photo_id, $author="Author", $body=""){

        if (!empty($photo_id) && !empty($author) && !empty($body)) {
            
            $comment           = new Comment;
            $comment->photo_id = (int)$photo_id;
            $comment->author   = $author;
            $comment->body     = $body;

            return $comment;
        } else {
            return false;
        }
    }

    public static function find_comments($photo_id=0){
        $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = $photo_id ORDER BY photo_id ASC";
       
        $result_array = self::find_querys($sql);

        return !empty($result_array) ? $result_array : false;
    }

}
