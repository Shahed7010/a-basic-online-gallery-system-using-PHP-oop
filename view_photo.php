<?php include("includes/header.php"); ?>


<body>

<!-- Navigation -->
<?php include("includes/topnav.php"); ?>
<?php 
    if($_GET['id']){
        $comment = new Comment();
        $photo = Photo::get_data_by_id($_GET['id']);
        $comments = comment::get_comments($_GET['id']);
    }
   $session->visitor_count();
?>

<?php 
    if(isset($_POST['add_comment'])){
        
        $comment->author = $_POST['author'];
        $comment->body = $_POST['body'];
        $comment->photo_id = $_GET['id'];
        $comment->cmnt_date = date('y-m-d');
        if(!empty($comment->photo_id) && !empty($comment->author)){
            $comment->create_data();
        }
        header("Location: view_photo.php?id=$photo->id");
        }
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-12">

            <!-- Title -->
            <h1><?php echo $photo->title ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#"><?php echo $photo->author ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $photo->upload_date ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive col-sm-offset-1 img-rounded view_image" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

            <hr>
            <p class="text-justify"><?php echo $photo->description; ?></p>
            <!-- Blog Comments -->
            <hr>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post">
                   <div class="form-group">
                       <input type="text" class="form-control" name="author" placeholder="username" required>
                   </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="body"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php foreach($comments as $comment): ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment->author ?>
                        <small><?php echo $comment->cmnt_date ?></small>
                    </h4>
                    <?php echo $comment->body ?>
                    <!-- Nested Comment -->

                    <!-- End Nested Comment -->
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
           <?php //include("includes/sidebar.php"); ?>


    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include("includes/footer.php"); ?>