<?php

class User extends Db_objects{
    protected static $db_table="users";
    protected static $db_table_fields=array('id', 'username', 'user_password', 'photo_name', 'user_firstname', 'user_lastname','user_email');
    public $username;
    public $user_password;
    public $photo_name;
    public $id;
    public $user_email;
    public $user_image;
    public $user_firstname;
    public $user_lastname;
    public $tmp_path;
    public $type;
    public $size;
    public $upload_directory="images";
    public $thumbnail="user_thumbnail.jpg";
    
    public function image_or_thumbnail(){
        return empty($this->photo_name) ? $this->upload_directory.DS.$this->thumbnail : $this->upload_directory.DS.$this->photo_name;
    }

    
    
    public static function verify_user($user_name, $user_password){
        global $database;
        $user_name = mysqli_real_escape_string($database->connection, $user_name);
        $user_password = mysqli_real_escape_string($database->connection, $user_password);
        $sql = "select * from ".self::$db_table." where username = '{$user_name}' and user_password = '{$user_password}'";
        $result = self::execute_query($sql);
        return !(empty($result)) ? array_shift($result) : false;
    }

    public function update_user_image(){
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->photo_name) || empty($this->tmp_path)){
                $this->errors[]="the file was not available";
                return false;
            }
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->photo_name;
            if(file_exists($target_path)){
                $this->errors[]="the file {$this->photo_name} already exists";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)){
                    unset($this->tmp_path);
                    return true;
            }else{
                $this->errors[]="the file directory has not the permission!";
                return false;
            }
        }
    public function set_user_image($image_name, $user_id){
        global $database;
        $this->photo_name = $database->escape_string($image_name);
        $this->id = $database->escape_string($user_id);
        $sql = "update ". self::$db_table ." set photo_name = '{$this->photo_name}'";
        $sql .= " where id = {$this->id}";
        $bal = $database->query($sql);
        echo $this->image_or_thumbnail();
    }

    
}//end of User class

//$user = new User();
?>