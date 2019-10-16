<?php

class Photo extends Db_objects{
    protected static $db_table="photos";
    protected static $db_table_fields=array('id', 'title', 'author', 'description','upload_date', 'photo_name', 'type', 'size');
    public $id;
    public $title;
    public $author;
    public $description;
    public $upload_date;
    public $photo_name;
    public $type;
    public $size;
    
    public $tmp_path; 
    public $upload_directory="images"; 
    
    
    
    public function picture_path(){
        return $this->upload_directory.DS.$this->photo_name;
    }
    
    public static function photo_side_bar($photo_id){
        $photo = self::get_data_by_id($photo_id);
        
        echo "<a class='thumbnail'><img src='{$photo->picture_path()}' height='100px' alt=''></a>";
        echo "<p>Name: ".$photo->photo_name."<p/>";
    }
    
    
    
}

?>
