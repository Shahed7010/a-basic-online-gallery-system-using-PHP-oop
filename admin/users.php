<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()){
    header("Location: login.php");
} ?>
   <?php include("includes/modal.php"); ?>
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
                <a class="navbar-brand" href="../index.php">Home Page</a>
            </div>
            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            users
                            <small>list</small>
                            <a href="add_user.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add new</a>
                        </h1>
                        <h5 class="bg-warning"><?php echo $session->message; ?></h5>
                        <table class="table table-hover">
                            <thead>
                               <tr>
                                <th>User Id</th>
                                <th>Picture</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                               <?php
                                $users = User::get_all_data();
                                foreach($users as $user){
                                    echo "<td>$user->id</td>";
                                    echo "<td><img src='".$user->image_or_thumbnail()."' width=100 height=80></td>"; 
                                    echo "<td>$user->username</td>";
                                    echo "<td>$user->user_email</td>";
                                    echo "<td>$user->user_firstname</td>";
                                    echo "<td>$user->user_lastname</td>";
                                   
                                ?>
                                   <td>
                                    <div>
                                    <a p_id="<?php echo $user->id;?>" href="javascript:void(0)" class="delete_link">Delete,</a>
                                    <a href="edit_user.php?id=<?php echo $user->id;?>"> Edit</a> 
                                    </div>
                                    </td>
                                <?php  
                                    echo "</tr>";
                                    }
                                ?>
                        </tbody>
                        </table>
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
     <script>
                $(document).ready(function(){
                $(".delete_link").on('click', function(){
                    var id= $(this).attr("p_id");
                    var link="includes/delete_user.php?id="+id+" ";
                    $(".modal_delete_link").attr("href",link);
                    $("#myModal").modal('show');

                });                  

                });

            </script>