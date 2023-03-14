 <!-- Modal -->
 <div class="modal fade" id="image_file_manager" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Image</h5>
                 <div id="msg"></div>
                 <div class="file-manager-search text-center pull-right">
                     <input type="text" id="input_search_image" placeholder="Search Image" name="search"
                         class="form-control">
                 </div>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             {{-- {!! Form::open(['method' => 'get', 'route' => 'admin.post.destroy', 'enctype' => 'multipart/form-data', 'id' => 'myform']) !!} --}}
             <div class="modal-body">
                 <div class="file-manager">
                     <div class="file-manager-left">
                         <form id="dropzoneForm" enctype="multipart/form-data" class="dropzone"
                             action="{{ route('admin.post.upload') }}">
                             @csrf
                             <p class="file-manager-file-types">
                                 <span>JPG</span>
                                 <span>JPEG</span>
                                 <span>PNG</span>
                                 <span>GIF</span>
                             </p>
                             <p class="dm-upload-icon text-center mt-5">
                                 {{-- <i class="fas fa-cloud-upload-alt"></i> --}}
                             </p>
                         </form>
                         <input type="hidden" name="id" id="selected_img_file_id">
                         {{-- =============== --}}

                     </div>
                     {{-- file-manager-left --}}
                     <div class="file-manager-middel">
                         <div class="file-manager-content">
                             <div class="col-sm-12">
                                 <div class="row">
                                     <div id="image_file_upload_response">
                                         <div class="panel panel-default">
                                             <div class="panel-body" id="uploaded">

                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     {{-- file-manager-middel --}}
                     <div class="file-manager-right">
                         <div class="form-group">
                             <label>Name</label>
                             <input class="form-control" readonly type="text" name="name" id="selected_img_name">
                         </div>
                         <div class="form-group">
                             <label>URL</label>
                             <input class="form-control" readonly type="text" name="link"
                                 id="selected_img_file_path">
                         </div>
                         <div class="form-group">
                             <label>Alt</label>
                             <input class="form-control" type="text" name="alt" id="altText">
                         </div>
                         <div class="form-group">
                             <label>Title</label>
                             <input class="form-control" type="text" name="title" id="titleText">
                         </div>
                         <div class="form-group">
                             <label>Caption</label>
                             <input class="form-control" type="text" name="caption" id="captionText">
                         </div>
                         <div class="form-group">
                             <label>Description</label>
                             <input class="form-control" type="text" name="description" id="descriptionText">
                         </div>
                     </div>
                     {{-- file-manager-right --}}
                 </div>
             </div>

             <div class="modal-footer">
                 <div class="file-manager-footer">
                     {{-- <form action="{{ route('admin.post.delete') }}">
                            <input type="text" id="selected_img_name">
                            <button type="submit" class="fas fa-trash"></i>&nbsp;&nbsp; Delete </button>
                        </form> --}}
                     <button type="button" id="btn_img_delete" class="btn btn-danger pull-left btn-file-delete"><i
                             class="fas fa-trash"></i>&nbsp;&nbsp;
                         Delete </button>

                     <button type="button" id="btn_img_select" class="btn btn-success btn-file-select"><i
                             class="fas fa-check"></i>&nbsp;&nbsp; Select image</button>
                     {{-- Databese value insert --}}
                     {{-- <button type="submit" id="btn_img_select" class="btn btn-primary bg-olive btn-file-select"><i
                                class="fa fa-check"></i>&nbsp;&nbsp; Select image </button> --}}
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                 </div>
             </div>
             {{-- {!! Form::close() !!} --}}
         </div>
     </div>
 </div>
 {{-- </div> --}}

 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
 <script type="text/javascript">
     Dropzone.options.dropzoneForm = {
         maxFilesize: 12,
         acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
         previewsContainer: "#dropzoneForm",
         uploadMultiple: false,
         autoProcessQueue: true,
         addRemoveLinks: false,
         dictDefaultMessage: "Drop image here to upload",
         dictFileTooBig: "File is too big 500 MiB. Max filesize: 450MiB.",
         dictInvalidFileType: "You can't upload files of this type.",
         dictResponseError: "Server responded with 404 code",

         success: function(file, response) {
             console.log(response);
         },
         error: function(file, response) {
             return false;
         },

         init: function() {

             var submitButton = document.querySelector("#submit-all");
             myDropzone = this;

             submitButton.addEventListener('click', function() {
                 myDropzone.preventDefault();
                 myDropzone.stopPropagation();
                 myDropzone.processQueue();
             });

             this.on("complete", function() {
                 if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                     var _this = this;
                     _this.removeAllFiles();
                 }
                 load_images();
             });

         }

     };

     load_images();

     function load_images() {
         $.ajax({
             url: "{{ route('admin.posts.fetch') }}",
             success: function(data) {
                 $('#uploaded').html(data);
             }
         })
     }
 </script>
 <script type="text/javascript">
     /*
      *------------------------------------------------------------------------------------------
      * IMAGES
      *------------------------------------------------------------------------------------------
      */
     var base_url = '';
     //select image
     $(document).on('click', '#image_file_manager .file-box', function() {
         $('#image_file_manager .file-box').removeClass('selected');
         $(this).addClass('selected');
         var file_name = $(this).attr('data-file-name');
         var file_id = $(this).attr('data-file-id');
         var file_path = $(this).attr('data-file-path');
         var alt = $(this).attr('data-file-alt');
         var title = $(this).attr('data-file-title');
         var caption = $(this).attr('data-file-caption');
         var description = $(this).attr('data-file-description');

         $('#selected_img_name').val(file_name);
         $('#selected_img_file_id').val(file_id);
         $('#selected_img_file_path').val(file_path);
         $('#altText').val(alt);
         $('#titleText').val(title);
         $('#captionText').val(caption);
         $('#descriptionText').val(description);
         $('#file_id').val(file_id);
         $('#btn_img_delete').show();
         $('#btn_img_select').show();
     });
     //select image Delete
     $(document).on('click', '#image_file_manager #btn_img_delete', function() {
         var file_name = $('#selected_img_name').val();
         $.ajax({
             url: "{{ route('admin.posts.deleted') }}",
             data: {
                 name: file_name
             },
             success: function(data) {
                 if (data.action == 'image') {
                     // use for animation hidden
                     $("#msg").html(data.msg).show().delay(1000).fadeOut();
                 } else {
                     // window.location.reload(true);
                     load_images();
                 }
             }
         })
     });
     //select image file
     $(document).on('click', '#image_file_manager #btn_img_select', function() {
         select_image();
     });
     //select image file on double click
     $(document).on('dblclick', '#image_file_manager .file-box', function() {
         select_image();
     });

     function select_image() {
         var file_name = $('#selected_img_name').val();
         var file_id = $('#selected_img_file_id').val();
         var img_url = $('#selected_img_file_path').val();
         var alt = $('#altText').val();
         var title = $('#titleText').val();
         var caption = $('#captionText').val();
         var description = $('#descriptionText').val();
         $('#alt_value').val(alt);
         $('#title_value').val(title);
         $('#caption_value').val(caption);
         $('#description_value').val(description);
         // ============================ another way value pass, using input name
         // $('input[name=alt]').val(alt);
         // $('input[name=title]').val(title);
         var captionText = document.getElementById("captionText").value;
         var descriptionText = document.getElementById("descriptionText").value;
         $('#caption_value').val(captionText);
         $('#description_value').val(descriptionText);

         var image = '<div class="post-select-image-container">' +
             '<a id="btn_delete_post_main_image" onclick="imageRemove()" class="btn btn-danger btn-sm btn-delete-selected-file-image">' +
             '<img src="' + base_url + img_url + '" alt="" id="display_image">' +
             '<i class="fa fa-times"></i> ' +
             '</a>' +
             '</div>';
         document.getElementById("post_select_image_container").innerHTML = image;
         $('input[name=image_id]').val(file_id);
         $('#selected_image_file').css('margin-top', '15px');
         $('input[name=image_name]').val(file_name);
         $('#image_file_manager').modal('toggle');
         $('#image_file_manager .file-box').removeClass('selected');
         $('#btn_img_delete').hide();
         $('#btn_img_select').hide();
     }

     function imageRemove() {
         document.getElementById("image_id").value = '';
         document.getElementById("image_name").value = '';
         document.getElementById('display_image').removeAttribute('src');
         const element = document.getElementById("btn_delete_post_main_image");
         element.remove();
     }

     //search image
     $(document).on('input', '#input_search_image', function() {
         var search = $(this).val();
         var data = {
             "search": search
         };
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $.ajax({
             type: "POST",
             url: "{{ route('admin.users.search') }}",
             data: data,
             success: function(response) {
                 document.getElementById("image_file_upload_response").innerHTML = response
             }
         });
     });
 </script>
