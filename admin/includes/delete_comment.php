<?php include("init.php"); ?>

<?php if(!$session->is_signed_in()){
    header("Location: login.php");
} ?>


<?php 

if(isset($_GET['id'])){
    $comment = Comment::get_data_by_id($_GET['id']);
    if($comment){
        $comment->delete_data();
        header("Location: ../photo_comments.php");
    }
}else{
    header("Location: ../photo_comments.php");
}

?>