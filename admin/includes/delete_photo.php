<?php include("init.php"); ?>

<?php if(!$session->is_signed_in()){
    header("Location: login.php");
} ?>


<?php 

if(isset($_GET['id'])){
    $photo = Photo::get_data_by_id($_GET['id']);
    if($photo){
        if($photo->delete_data()){
            $target_path = SITE_ROOT.DS.'admin'.DS.$photo->picture_path();
            unlink($target_path);
        }
        header("Location: ../photos.php");
    }
}else{
    header("Location: ../photos.php");
}

?>