<?php include("init.php"); ?>

<?php if(!$session->is_signed_in()){
    header("Location: login.php");
} ?>


<?php 

if(isset($_GET['id'])){
    $user = User::get_data_by_id($_GET['id']);
    if($user){
        $user->delete_data();
        $target_path = SITE_ROOT.DS.'admin'.DS.$user->upload_directory.DS.$user->photo_name;
        unlink($target_path);
        $session->set_message("".$user->username." user has been deleted!");
        header("Location: ../users.php");
    }
}else{
    header("Location: ../users.php");
}

?>