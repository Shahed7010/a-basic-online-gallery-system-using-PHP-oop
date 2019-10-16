<?php include("includes/header.php"); ?>



<?php

if($session->is_signed_in()){
     header("Location: index.php");
}

if(isset($_POST['login'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $user_found = User::verify_user($username, $password);
    
    if($user_found){
        $session->login($user_found);
        header("Location: index.php");
        }
    else if($username==null and $password==null){
        $message="fields are empty!";
        }
    else{
        $message="Wrong username or password!";
        }
    }else{
    $username = "";
    $password = "";
    $message=null;
}
?>



 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


<!-- Blog login Well -->
<div class="container">
<div class="well col-xs-6" style="margin-left: 25%">
   
    <?php

    if($message){
         echo "<h5 class='bg-danger'> $message </h5>";
        }
    ?>
    <h4>Login here</h4>
    <form action="" method="post">
    <div  class="form-group">
       <?php
        /*if(isset($_GET['source'])){
            echo "<input name='username' type='text' class='form-control' placeholder='enter username' autofocus>";
        }else{
            echo "<input name='username' type='text' class='form-control' placeholder='enter username'>";
        }*/
        ?>
    <input name='username' type='text' class='form-control' placeholder='enter username' value="<?php echo htmlentities($username); ?>" autofocus>
    </div>
    <div  class="form-group">
        <input name="password" type="password" class="form-control" placeholder="enter password" value="<?php echo htmlentities($password); ?>">
    </div>

        <button name="login" class="btn btn-primary" type="submit">Login</button>
    </form><br>
    <div class="form form-inline">
    <h5 class="form-group" style="margin-right:10px">New here?</h5>
    <a href="" class="btn btn-success form-group ml-10">Register now</a>
    </div>
   </div>
</div>