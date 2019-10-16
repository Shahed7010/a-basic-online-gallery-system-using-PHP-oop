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
                            comments
                            <small>list</small>
                        </h1>
                        
                        <table class="table table-hover">
                            <thead>
                               <tr>
                                <th>Comment Id</th>
                                <th>Photo Id</th>
                                <th>author</th>
                                <th>body</th>
                                <th>date</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                               <?php
                                $comments = Comment::get_all_data();
                                foreach($comments as $comment){
                                    echo "<td>$comment->id</td>";
                                    echo "<td>$comment->photo_id</td>";

                                    echo "<td>$comment->author</td>";
                                    echo "<td>$comment->body</td>";
                                    echo "<td>$comment->cmnt_date</td>";
                                   
                                ?>
<!--
                                   <td>
                                    <div>
                                    <a p_id="<?php echo $comment->id;?>" href="javascript:void(0)" class="delete_link">Delete,</a>
                                    <a href="edit_comment.php?id=<?php echo $comment->id;?>"> Edit</a> 
                                    </div>
                                    </td>
-->
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
                    var link="includes/delete_comment.php?id="+id+" ";
                    $(".modal_delete_link").attr("href",link);
                    $("#myModal").modal('show');

                });                  

                });

            </script>