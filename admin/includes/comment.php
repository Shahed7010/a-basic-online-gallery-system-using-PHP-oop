<?php

class Comment extends Db_objects{
    protected static $db_table="comments";
    protected static $db_table_fields=array('id', 'photo_id', 'author', 'body', 'cmnt_date');
    public $photo_id;
    public $author;
    public $body;
    public $id;
    public $cmnt_date;
    
    public static function get_comments($p_id){
        global $database;
        $sql = "select * from ".self::$db_table;
        $sql.= " where photo_id = ".$database->escape_string($p_id);
        return self::execute_query($sql);
    }
}//end of User class

//$user = new User();
?>