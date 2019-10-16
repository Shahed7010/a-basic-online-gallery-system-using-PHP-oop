<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){
    header("Location: login.php");
} ?>

   
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>
<?php
$message="";
if(isset($_POST['create_user'])){
    
    $user = new User();
    $user->username = $_POST['username'];
    $user->user_firstname = $_POST['user_firstname'];
    $user->user_lastname = $_POST['user_lastname'];
    $user->user_password = $_POST['user_password'];
    $user->user_email = $_POST['user_email'];
    
    if($user->set_file($_FILES['user_image'])){
    if($user->save()){
            $message = "user created successfully";
        }else{
            $message = join("", $user->errors);
        }
    }else{   
        if($user->create_data()){
            $message = "user created successfully";
        }else{
            $message = "something wrong! cant't create user.";
        }
    }
    
}
        
?>
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add
                            <small>User</small>
                        </h1>
                        <?php if($message){echo "<h5 class='bg-warning'> $message <br> </h5>";}?>
                        <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="user_firstname">First Name</label>
                            <input type="text" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Last Name</label>
                            <input type="text" class="form-control" name="user_lastname">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Enter Email</label>
                            <input type="email" class="form-control" name="user_email" required>
                        </div>
                    <!--
                        <div class="radio-button">
                            <label for="user_role"><input type="radio" value="user" name="radio" checked>User</label>
                            <label for="user_role"><input type="radio" value="admin" name="radio">Admin</label>
                        </div>
                    -->

                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" class="form-control" name="user_password">
                        </div>
                        <div class="form-group">
                            <label for="user_image">Upload Image</label>
                            <input type="file" name="user_image">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="create_user" value="Register">
                        </div>


                    </form>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include("includes/footer.php"); ?>