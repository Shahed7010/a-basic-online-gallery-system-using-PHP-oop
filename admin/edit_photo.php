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
                <a class="navbar-brand" href="../index.php">Home Page</a>
            </div>
            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>
<?php
        if(isset($_GET['id'])){
            $photo = Photo::get_data_by_id($_GET['id']);
        }
        if(isset($_POST['update'])){
            if($photo){
                $photo->title=$_POST['title'];
                $photo->description=$_POST['description'];
                $photo->upload_date = date('Y-m-d');
                $photo->save();
                header("Location: photos.php");
            }else{
                header("Location: photos.php");
            }   
        }
        
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photos
                            <small>Subheading</small>
                        </h1>
                        
                        <form action="" method="post">
                           <div class="col-sm-8">
                           <div class="form-group">
                               <img src="<?php echo $photo->picture_path(); ?>" alt="" height="100" width="120">
                            </div>
                            <div class="form-group">
                               <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" value="<?php echo $photo->title ?>">
                            </div>
                            
                            <div class="form-group">
                               <label for="description">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" ><?php echo $photo->description ?></textarea>
                            </div>
                         </div>
                         <div class="col-sm-4">
                             <div>
                                Photo Id: <span><?php echo $photo->id ?></span>
                             </div>
                             <div>
                                Filename: <span><?php echo $photo->photo_name ?></span>
                             </div>
                             <div>
                                File type: <span><?php echo $photo->type ?></span>
                             </div>
                             <div>
                                File size: <span><?php echo $photo->size ?></span>
                             </div>
                             <div>
                               <i class="fa fa-calendar"></i>
                                Upload date: <span><?php echo $photo->upload_date ?></span>
                             </div>
                             <div>
                                 <input type="submit" name="update" class="btn btn-success" value="Update">
                            
                                 <a href="includes/delete_photo.php?id=<?php echo $photo->id ?>" onclick="return confirm('you want to delete?')" class="btn btn-danger">Delete</a>
                             </div>
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