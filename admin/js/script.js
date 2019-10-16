$(document).ready(function(){
var user_href;
var user_splitted_href;
var user_id;

var photo_src;
var photo_splitted_src;
var photo_name;
var photo_id;
$(".modal-thumbnails").click(function(){
    $("#set_user_image").prop('disabled',false);
    user_href = $("#delete-btn").prop('href');
    user_splitted_href = user_href.split('=');
    user_id = user_splitted_href[user_splitted_href.length - 1];
    
    photo_src = $(this).prop('src');
    photo_splitted_src = photo_src.split('/');
    photo_name = photo_splitted_src[photo_splitted_src.length - 1];
     $("#modal-sidebar").setAttribute("class", "well");
    photo_id = $(this).attr("data");
    $.ajax({
          url: "includes/ajax_code.php",
           data: {photo_id: photo_id},
           type: "POST",
           success:function(data){
               if(!data.error){
                  
                  $("#modal-sidebar").html(data);
               }
           }
       }); 
});

    $("#set_user_image").click(function(){
       $.ajax({
          url: "includes/ajax_code.php",
           data: {photo_name: photo_name, user_id: user_id},
           type: "POST",
           success:function(data){
               if(!data.error){
                  $("#edit-img").prop('src', data);
               }
           }
       }); 
    });
    
});

Dropzone.autoDiscover = false;

var myDropzone = new Dropzone(".dropzone", { 
   autoProcessQueue: false,
   parallelUploads: 10 // Number of files process at a time (default 2)
});

$('#uploadfiles').click(function(){
   myDropzone.processQueue();
});

