<?php include("init.php"); ?>



<?php


    $session->logout();
    $_SESSION['counts']=null;
    header("Location: ../login.php");
 

?>