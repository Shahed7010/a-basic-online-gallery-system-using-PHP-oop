<?php

class Db_objects{
    public $errors=array(); 
    public $upload_errors_array = array(
    UPLOAD_ERR_OK         => 'There is no error, the file uploaded with success',
    UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded',
    UPLOAD_ERR_NO_FILE    => 'No file was uploaded',
    UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
    UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload',
    );
    
    public static function get_all_data(){
      return  $result = static::execute_query("select * from ".static::$db_table."");
    }
    
    public static function get_data_by_id($id){
        global $database;
        $result = static::execute_query("select * from ".static::$db_table." where id=$id");
        return !(empty($result)) ? array_shift($result) : false;
    }
    
    
    
    public static function execute_query($query){
        global $database;
        $result = $database->query($query);
        $object_array = array();
        while($row = mysqli_fetch_assoc($result)){
            $object_array[] = static:: instantiation($row);
        }   
        return $object_array;
    }
   
     public static function instantiation($record){
        $calling_class = get_called_class();
        $the_object = new $calling_class;
        foreach($record as $attribute => $value){
            if($the_object->has_attribute($attribute)){
                $the_object->$attribute = $value;
            }
        }
        return $the_object;
    }
    private function has_attribute($attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
    
     protected function get_properties(){
        $properties = array();
        foreach(static::$db_table_fields as $db_field){
            if(property_exists($this, $db_field)){
                $properties[$db_field]=$this->$db_field;
            }
        }
        return $properties;
    }
    
    protected function get_clean_properties(){
        global $database;
        $clean_properties = array();
        foreach($this->get_properties() as $key=>$value){
            $clean_properties[$key]=$database->escape_string($value);
        }
        return $clean_properties;
    }
    
    
    public function create_data(){
        global $database;
        $properties = $this->get_clean_properties();
        $sql="insert into ".static::$db_table." (". implode(",", array_keys($properties)) .")";
        $sql .="values ('". implode("','", array_values($properties)) ."')";
        
        if($database->query($sql)){
            $this->id=$database->the_insert_id();
            return true;
        }else{
            return false;
        }
    }
    public function update_data(){
        global $database;
        $properties = $this->get_clean_properties();
        $properties_pair = array();
        foreach($properties as $key=>$value){
            $properties_pair[]="{$key}='$value'";
        }
        $sql="update ".static::$db_table." set ";
        $sql .=implode(",",$properties_pair);
        $sql .="where id= '".$database->escape_string($this->id)."' ";
        
        $database->query($sql);
        return (mysqli_affected_rows($database->connection)==1) ? true : false;
        
    }
    
    public function delete_data(){
        global $database;
        $sql="delete from ".static::$db_table." ";
        $sql .="where id='".$database->escape_string($this->id)."'";
        $sql .=" limit 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection)==1) ? true : false;
    }
    
    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[]="there was no file uploaded";
            return false;
        }else if($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $this->photo_name = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
            return true;
        }
    }
    
    public function save(){
        if($this->id){
            $this->update_data();
           
        }else{
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
                if($this->create_data()){
                    unset($this->tmp_path);
                    return true;
                }
            }else{
                $this->errors[]="the file directory has not the permission!";
                return false;
            }
        }
    }
    
    public static function count_all(){
        global $database;
        $sql = "select * from ".static::$db_table."";
        $res = $database->query($sql);
        return mysqli_num_rows($res);
    }

    
}

?>