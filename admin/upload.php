<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){
    header("Location: login.php");
} ?>

   <?php
    $message='';
    if(isset($_POST['submit'])){
        $photo = new Photo();
        $photo->title=$_POST['title'];
        $photo->author=$_SESSION['username'];
        $photo->description=$_POST['description'];
        $photo->upload_date = date('Y-m-d h:i:sa');
        $photo->set_file($_FILES['file']);
         if($photo->save()){
            $message="photo uploaded successfully";
        }else{
            $message=join("", $photo->errors);
        }
        
    }

    ?>
   
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

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Upload
                            <small>Subheading</small>
                        </h1>
                        
                        <form action="" method="post" enctype="multipart/form-data" class="col-sm-6">
                           <h5 class="bg-warning"><?php echo $message; ?></h5>
                            <div  class="form-group">
                                <input type="text" name="title" placeholder="give a title" class="form-control">
                            </div>
                            <div  class="form-group">
                               <label for="description">Description</label>
                                <textarea name="description" id="" cols="10" rows="2" class="form-control"></textarea>
                            </div>
<!--
                            <div  class="form-group">
                                <input type="date" value="<?//php echo date("Y-m-d"); ?>" class="form-control">
                            </div>
-->
                            <div  class="form-group">
                                <input type="file" name="file">
                            </div>
                            <div  class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary">
                            </div>
                        </form>
                        
                    </div>
                </div>
                <!-- /.row -->
                <!-- /dropzone form -->
<!--
                <div class="row">
                   <div class="col-sm-8">
                    <form action="upload.php" class="dropzone" method=""></form>
                    <button type="submit" id="uploadfiles" class="btn btn-success">Upload</button>
                </div>
                </div>
-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include("includes/footer.php"); ?>