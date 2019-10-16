<?php require("init.php");
$user = new User();
if(isset($_POST['photo_name'])){
    $user->set_user_image($_POST['photo_name'], $_POST['user_id']);
}

if(isset($_POST['photo_id'])){
    Photo::photo_side_bar($_POST['photo_id']);
}
?>