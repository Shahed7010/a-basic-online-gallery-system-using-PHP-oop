<?php 

class Session{
    private $signed_in=false;
    public $user_id;
    public $counts;
    public $message;
    
    function __construct(){
        session_start();
        $this->check_login();
        $this->check_message();
        //$this->visitor_count();
    }
    
    public function is_signed_in(){
        return $this->signed_in;
    }
    public function login($user){
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $_SESSION['counts']=0;
            $this->signed_in=true;
        }
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }
    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        }else{
            unset($this->user_id);
            $this->signed_in=false;
        }
    }
    public function visitor_count(){
        if(isset($_SESSION['counts'])){
           return $this->counts = $_SESSION['counts']++;
        }else{
            return $_SESSION['counts'] = 1;
        }
    }
    
    private function check_message(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message = "";
        }
    }
    public function set_message($msg=""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }else{
            return $this->message;
        }
    }
    
    
    
    
    
}

$session = new Session();
?>