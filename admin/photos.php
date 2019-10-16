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
                            Photos
                            <small>Subheading</small>
                        </h1>
                        <h5 class="bg-warning"><?php echo $session->message; ?></h5>
                        <table class="table table-hover">
                            <thead>
                               <tr>
                                <th>Photo Id</th>
                                <th>title</th>
                                <th>Photo</th>
                                <th>filename</th>
                                <th>Size</th>
                                <th>Comments</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                               <?php
                                $photos = Photo::get_all_data();
                                foreach($photos as $photo){
                                    echo "<td>$photo->id</td>";
                                    echo "<td>$photo->title</td>";
                                    echo "<td><img src='".$photo->picture_path()."' width=100 height=80>"; ?>
                                    <div>
                                    <a p_id="<?php echo $photo->id;?>" href="javascript:void(0)" class="delete_link">Delete,</a>
                                    <a href="edit_photo.php?id=<?php echo $photo->id; ?> ">Edit,</a>
                                    <a href="../view_photo.php?id=<?php echo $photo->id; ?>">View</a>   
                                    </div>
                                    <?php echo "</td>";
                                    echo "<td>$photo->photo_name</td>";
                                    echo "<td>$photo->size</td>";
                                    ?>
                                    <td>
                                        <a href="photo_comments.php?id=<?php echo $photo->id?>">
                                            <?php
                                            echo count(Comment::get_comments($photo->id));
                                            ?>
                                        </a>
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
                    var link="includes/delete_photo.php?id="+id+" ";
                    $(".modal_delete_link").attr("href",link);
                    $("#myModal").modal('show');

                });                  

                });

            </script>