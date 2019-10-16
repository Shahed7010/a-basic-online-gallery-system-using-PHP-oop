<?php require_once("init.php"); ?>
<?php $photos = Photo::get_all_data(); ?>
<!-- Modal -->
<div class="modal fade" id="photo_library" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-sm-9">
       <div class="thumbnails row">
          <?php foreach($photos as $photo): ?>
          <div class="col-xs-2">
          <a href="#" role="checkbox" area-checked="false" tabindex="0" class="thumbnail" id="">
           <img class="img-responsive modal-thumbnails" src="<?php echo $photo->picture_path();?>" data="<?php echo $photo->id ?>"  alt="">
           </a>
           </div>
           <?php endforeach; ?>
       </div>
       </div>
       <div class="col-sm-3">
           <div id="modal-sidebar">
               
           </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="set_user_image" disabled="true" type="button" class="btn btn-primary" data-dismiss="modal">Set user image</button>
      </div>
    </div>
  </div>
</div>