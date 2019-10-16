<?php 

class Database{
    public $connection;
    
    function __construct(){
        $this->create_db_connection();
    }
    public function create_db_connection(){
        $this->connection = mysqli_connect("localhost", "root", "", "gallery");
    }
    
    public function query($sql){
        $result= mysqli_query($this->connection, $sql);
        return $result;
    }
    
    private function confirm_query($result){
        if(!result){
            die("query failed" . mysqli_error($this->connection));
        }
    }
    
    public function the_insert_id(){
        return mysqli_insert_id($this->connection);
    }
    public function escape_string($string){
        return mysqli_real_escape_string($this->connection, $string);
    }
    
    
}
$database = new Database();
?>
