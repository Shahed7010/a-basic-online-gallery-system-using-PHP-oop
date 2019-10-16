<?php include("includes/header.php"); ?>

<body>

<!-- Navigation -->
<?php include("includes/topnav.php"); ?>
    
    <?php 
    $page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $items = 4;
    $total_items = Photo::count_all();
    $paginate = new Paginate($page, $items, $total_items);
    $sql = "select * from photos ";
    $sql .= "limit {$items} ";
    $sql .= "offset {$paginate->offset()}";
    $photos = Photo::execute_query($sql);
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
            <?php foreach($photos as $photo): ?>
            <div class="col-md-3">
                <div class="thumbnail">
                  <a href="view_photo.php?id=<?php echo $photo->id ?>">
                    <img class="homepage_image" src="admin/<?php echo $photo->picture_path();?>" alt="Lights">
                    <div class="caption">
                      <p><?php echo $photo->title ?></p>
                    </div>
                  </a>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
            
               <div class="row text-center">
                   <ul class="pagination">
                      <?php 
                       if($paginate->total_page()>1){
                           if($paginate->has_prev()){
                               echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>prev</a> </li>";
                           }
                           
                           for($i=1;$i<=$paginate->total_page();$i++){
                               if($i==$page){
                                    echo "<li class='active'><a href='index.php?page={$i}'>$i</a> </li>";
                               }else{
                                    echo "<li><a href='index.php?page={$i}'>$i</a> </li>";
                               }
                           }
                           if($paginate->has_next()){
                               echo "<li class='next'><a href='index.php?page={$paginate->nexts()}'>Next</a> </li>";
                           }
                           
                       }
                       ?>
  
                   </ul>
               </div>
                <!-- Blog Categories Well -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include("includes/footer.php"); ?>
