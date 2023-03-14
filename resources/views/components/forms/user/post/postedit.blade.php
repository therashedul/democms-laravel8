  <style>
      /* ========================= */
      @media (min-width: 1200px) {
          .modal-lg {
              max-width: 1250px !important;
          }
      }

      .modal-file-manager .modal-header .modal-title {
          float: left;
      }

      .modal-file-manager .modal-content {
          border-radius: 4px;
      }

      .modal-file-manager .modal-body {
          padding: 0;
      }

      .file-manager {
          width: 100%;
          max-width: 100%;
          display: table;
      }

      .file-manager-content {
          height: 422px;
          overflow-y: auto;
      }

      .file-manager-left {
          width: 20%;
          display: table-cell;
          border-right: 1px solid #eee;
          vertical-align: top;
          padding: 15px;
          background-color: #dce0e6;
      }

      .file-manager-middel {
          width: auto;
          display: table-cell;
          vertical-align: top;
          padding: 15px;
      }

      .file-manager-right {
          width: 20%;
          display: table-cell;
          vertical-align: top;
          padding: 15px;
          background-color: #dce0e6;
      }

      .file-manager-left .btn-upload {
          display: block;
          font-size: 14px;
          position: relative;
          cursor: pointer !important;
          padding: 8px 14px;
      }

      .file-manager-left .btn-upload span {
          cursor: pointer !important;
          z-index: 10 !important;
      }

      .file-manager-left .btn-upload input {
          cursor: pointer !important;
      }

      .col-file-manager {
          float: left;
          width: auto;
          padding: 5px;
      }

      .file-box {
          display: block;
          width: 100%;
          border: 1px solid #eee;
          cursor: pointer;
          text-align: center;
          position: relative;
          border-radius: 2px;
      }

      .file-box .image-container {
          display: block;
          width: 122px;
          height: 100px;
          overflow: hidden;
          text-align: center;
          border-radius: 2px;
      }

      .file-box .icon-container {
          padding: 10px;
          height: 110px;
      }

      .file-box .image-container img {
          margin: 0 auto;
          position: relative;
          width: auto;
          min-width: 100%;
          max-width: none;
          height: 100%;
          margin-left: 50%;
          transform: translateX(-50%);
          object-fit: cover;
      }

      .file-box .file-name {
          width: 100%;
          position: absolute;
          bottom: 0;
          left: 0;
          font-size: 12px;
          line-height: 14px;
          background-color: #f4f4f4;
          padding: 2px;
          display: block;
          text-align: center;
          word-break: break-all;
      }

      #audio_file_manager .file-box,
      #video_file_manager .file-box {
          height: 132px;
          text-align: center;
          text-overflow: ellipsis;
          overflow: hidden;
      }

      .file-icon {
          width: 80px;
          margin: 0 auto;
          -webkit-touch-callout: none;
          -webkit-user-select: none;
          -khtml-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          cursor: pointer;
      }

      .file-manager .selected {
          box-shadow: 0 0 3px rgba(40, 174, 141, 1);
          border: 1px solid rgba(40, 174, 141, 1);
      }

      .file-manager-footer {
          margin-left: 235px;
      }

      .btn-file-delete {
          display: none;
      }

      .btn-file-select {
          display: none;
      }

      .file-manager-list-item-name {
          width: 100%;
          padding: 0 5px;
          margin: 0;
          -webkit-touch-callout: none;
          -webkit-user-select: none;
          -khtml-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          cursor: pointer;
      }

      .input-file-label {
          width: 190px;
          background-color: #5bc0de;
          color: #fff;
          text-align: center;
          text-overflow: ellipsis;
          overflow: hidden;
          white-space: nowrap;
          padding: 0 5px;
          font-size: 12px;
      }

      .loader-file-manager {
          display: none;
          position: relative;
          width: 100%;
          text-align: center;
          margin-top: 10px;
      }

      .loader-file-manager img {
          position: relative;
          width: 50px;
          height: 50px;
      }

      .file-manager-search {
          /* position: absolute;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                margin-left: 235px; */
      }

      #image_file_manager .modal-header .close {
          padding: 1rem 1rem;
          margin: -1rem 1rem auto;
      }

      .file-manager-search input {
          border-radius: 2px;
          width: 300px;
          text-align: center
      }

      .dm-uploaded-files .bg-success {
          background-color: #28a745;
      }

      .file-manager-file-types {
          width: 100%;
          position: relative;
          margin: 0;
          left: 0;
          right: 0;
          top: 15px;
          text-align: center;
      }

      .file-manager-file-types span {
          display: inline-block;
          font-size: 11px;
          margin-right: 2px;
          margin-bottom: 2px;
          color: #979ba1 !important;
          padding: 2px 4px;
          border: 1px dashed #dce0e6 !important;
          border-radius: 2px;
      }

      @media (max-width: 900px) {
          .file-manager-left {
              display: block !important;
              width: 100% !important;
              float: left;
          }

          .file-manager-middel {
              display: block !important;
              width: 100% !important;
              float: left;
          }

          .file-manager-footer {
              margin-left: 0 !important;
          }

          .file-manager-search {
              position: relative;
              margin: 0;
              margin-top: 5px;
              display: block;
          }

          .file-manager-search input {
              width: 100%;
          }
      }

      a.upload-text {
          font-size: 1vw;
          font-weight: bold;
          display: inline-block;
          margin-bottom: 10px;
      }

      div#post_select_image_container {
          width: 160px;
          height: 250px;
      }

      div#post_select_image_container .post-select-image-container img {
          width: 100%;
      }

      .btn-browse-files {
          background-color: transparent !important;
          color: #979ba1;
          border-color: #cfd3d9 !important;
          margin-top: 10px;
      }

      div#rightHide {
          background-color: #ebebeb;
          padding: 5%;
      }

      img#selected_image_file {
          width: 100%;
      }

      /* Hide scrollbar for Chrome, Safari and Opera */
      .file-manager-content::-webkit-scrollbar {
          display: none;
          background: transparent;
          width: 0;
          /* Remove scrollbar space */
          /* Optional: just make scrollbar invisible */
      }

      /* Hide scrollbar for IE, Edge and Firefox */
      .file-manager-content {
          -ms-overflow-style: none;
          /* IE and Edge */
          scrollbar-width: none;
          /* Firefox */
      }

      #post_select_image_container button#btn_delete {
          margin: 0 auto;
          float: right;
          margin-top: 10px;
      }
  </style>
  @php
      $post = DB::table('posts')
          ->where('id', '=', $id)
          ->first();
  @endphp
  <input type="hidden" name="id" value="{{ $post->id }}">
  <div class="row">
      <div class="col-md-9 ">
          @php
              $langs[] = '';
          @endphp
          @foreach (config('app.multilocale') as $lang)
              @php
                  $langs[] = $lang;
              @endphp
              <div class="x_panel">
                  <div class="x_title">
                      <h3>Add New Post ({{ $lang }})</h3>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <br />
                      <div class=" form-group has-feedback">
                          <input type="text" name="name_{{ $lang }}" id="mySelect_{{ $lang }}"
                              onchange="myFunction_{{ $lang }}()" class="form-control slugsearch"
                              placeholder="Add Title" value="{{ $post->{'name_' . $lang} }}">

                      </div>
                      <div class="form-group has-feedback">
                          <input type="hidden" name="user_id" value="{{ $post->user_id }}" />
                      </div>

                      <div class="form-group has-feedback">
                          <input type="hidden" name="slug_{{ $lang }}" id="slugValue_{{ $lang }}"
                              value="{{ $post->{'slug_' . $lang} }}" />
                      </div>
                      <div class="form-group has-feedback">
                          <input type="hidden" name="link_{{ $lang }}" id="linkValue_{{ $lang }}"
                              value="{{ $post->{'slug_' . $lang} }}" />
                          Permalink: <span
                              id="parmalink_{{ $lang }}">{{ url('/') . '/' }}post.single/{{ $post->{'slug_' . $lang} }}/{{ $post->id }}
                          </span>
                      </div>
                      <div class=" form-group has-feedback">
                          <textarea name="content_{{ $lang }}" class="my-editor_{{ $lang }} form-control"
                              id="my-editor_{{ $lang }}" cols="50" rows="20">{{ $post->{'content_' . $lang} }}</textarea>
                      </div>
                  </div>
              </div>
              {{-- Exarpt field --}}
              <div class="x_panel">
                  <div class="x_title">
                      <h3>Excarpt</h3>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>

                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class=" form-group has-feedback">
                          <textarea name="excerpt_{{ $lang }}" class=" form-control" cols="10" rows="5">{{ $post->{'excerpt_' . $lang} }}</textarea>
                      </div>
                  </div>
              </div>

              <script type="text/javascript">
                  function myFunction_{{ $lang }}() {
                      var strng = document.getElementById("mySelect_{{ $lang }}").value;
                      var APP_URL = {!! json_encode(url('/')) !!}
                      const spt = strng.split(" ");
                      var imp = spt.join('_');
                      document.getElementById("linkValue_{{ $lang }}").value = APP_URL + '/' + imp;
                      document.getElementById("parmalink_{{ $lang }}").innerHTML = APP_URL + '/' + imp;
                      document.getElementById("slugValue_{{ $lang }}").value = imp;
                  }
              </script>
              <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
              <script>
                  var options_{{ $lang }} = {
                      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
                  };
              </script>
              <script>
                  CKEDITOR.replace('my-editor_{{ $lang }}', options_{{ $lang }});
              </script>
              <script language="javascript">
                  // Ajex search 
                  $('.slugsearch_{{ $lang }}').on('change', function() {

                      var strng = document.getElementById("mySelect_{{ $lang }}").value;
                      const spt = strng.split(" ");
                      var imp = spt.join('_');
                      var slg = document.getElementById("slugValue_{{ $lang }}").value = imp;
                      $value = $(this).val();
                      var successCount = 0;

                      $.ajax({
                          type: 'get',
                          url: "{{ route('superAdmin.post.slugsearch') }}",
                          data: {
                              'slugsearch': $value
                          },
                          success: function(data) {
                              if (data) {
                                  document.getElementById("slugValue_{{ $lang }}").value = data + "_1";

                              } else {
                                  document.getElementById("slugValue_{{ $lang }}").value = imp;
                              }

                              // alert(data)
                              // $('.slugValue').data
                              // $('table').html(data);
                          }
                      });
                  })
              </script>
              <script type="text/javascript">
                  $.ajaxSetup({
                      headers: {
                          'csrftoken': '{{ csrf_token() }}'
                      }
                  });
              </script>
          @endforeach
          {{-- ========================= find same name  --}}


          {{-- =============================== --}}
      </div>
      <div class="col-md-3 ">
          <div class="x_panel">
              <div class="x_title">
                  <h3>Category</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  @php
                      $cate = DB::table('categories')->first();
                  @endphp
                  <input name="hidden_cat" type="hidden" value="{{ $cate->id }}" checked>
                  @foreach ($categories as $category)
                      @php
                          $checked = '';
                      @endphp
                      @foreach ($postmeta as $meta)
                          @if ($meta->cat_id == $category->id)
                              @php
                                  $checked = 'checked = ""';
                              @endphp
                          @endif
                      @endforeach
                      <div class="form-check checkbox">
                          <label>
                              <input class="form-check-input parent flat" name="subcat_id[]" type="checkbox"
                                  value="{{ $category->id }}" {{ $checked }}>
                          </label>
                          <input class="form-check-input parent"
                              style="position: absolute;
                                                left: 67px;
                                                display: none;"
                              name="uncat_id[]" type="checkbox" value="{{ $category->id }}" {{ $checked }}>
                          @foreach ($langs as $lang)
                              <span>{{ $category->{'name_' . $lang} }}</span>
                          @endforeach
                      </div>
                      @if (count($category->subcategory) > 0)
                          @foreach ($category->subcategory as $sub)
                              @php
                                  $checked = '';
                              @endphp
                              @foreach ($postmeta as $meta)
                                  @if ($meta->cat_id == $sub->id)
                                      @php
                                          $checked = 'checked = ""';
                                      @endphp
                                  @endif
                              @endforeach
                              <div class="form-check checkbox" style="margin:1% 0 1% 5%;">
                                  @if ($sub->parent_id)
                                      <label>
                                          <input class="form-check-input child flat" style="margin-left: 7px;"
                                              name="subcat_id[]" type="checkbox" value="{{ $sub->id }}"
                                              id="flexCheckDefault" {{ $checked }}>
                                      </label>
                                  @endif
                                  <input class="form-check-input child"
                                      style="position: absolute;
                                                        left: 76px;
                                                        display: none;"
                                      name="uncat_id[]" type="checkbox" value="{{ $sub->id }}"
                                      {{ $checked }}>
                                  @foreach ($langs as $lang)
                                      <span class="child-child"
                                          style="margin-left: 0px">{{ $sub->{'name_' . $lang} }}</span>
                                  @endforeach

                              </div>
                          @endforeach
                      @endif
                  @endforeach


              </div>
          </div>
          <div class="x_panel">
              <div class="x_title">
                  <h3>Feature Image</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content" id="">
                  <div class="form-group">
                      <strong>Image:</strong>
                      <a href="" class="upload-text" type="text" data-toggle="modal"
                          data-target="#image_file_manager">
                          Featured image
                      </a>
                      @if (!empty($post->image))
                          <div id="post_select_image_container" class="post-select-image-container">
                              @if ($post->image != null)
                                  <button class="pull-right mt-4" onclick="displayimageRemove()" id="btn_delete">
                                      <i class="fa fa-times"></i>
                                  </button>
                              @endif
                              <img src="{{ asset('images/' . $post->image) }}" id="selected_image_file"
                                  alt="">
                          </div>
                      @else
                          <div id="post_select_image_container" class="post-select-image-container">
                              <a href="" class="upload-text" type="text" data-toggle="modal"
                                  data-target="#image_file_manager">
                                  <img src="{{ asset('img/profile/blank-img.jpg') }}" width="170px" height="200px"
                                      alt="" title="">
                              </a>

                          </div>
                      @endif
                      <input type="hidden" name="upload_id" value="">
                      <input type="hidden" name="image_id" id="image_id" value="">
                      <input type="hidden" name="image_name" id="image_name" value="{{ $post->image }}">
                      <input type="hidden" name="alt" id="alt_value" value="">
                      <input type="hidden" name="title" id="title_value" value="">
                      <input type="hidden" name="caption" id="caption_value" value="">
                      <input type="hidden" name="description" id="description_value" value="">
                  </div>
              </div>
          </div>
          <div class="x_panel">
              <div class="x_title">
                  <h3>Slider</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="">
                      <label>
                          <input type="hidden" value="0" class="js-switch" name="slider"
                              {{ $post->slider == 0 ? 'checked' : '' }}>
                          <input type="checkbox" value="1" class="js-switch" name="slider"
                              {{ $post->slider == 1 ? 'checked' : '' }}>
                      </label>
                  </div>
              </div>
          </div>

          <div class="x_panel">
              <div class="x_title">
                  <h3>File Upload</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="custom-file">
                      <input type="file" name="file" class="custom-file-input" id="chooseFile"
                          accept=".doc,.docx,.csv,.xlsx,.txt,.pdf, application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                      <input type="hidden" name="editfilename" id="closefile" value="{{ $post->file }}">
                      <div class="extention-panel" id="btn_delete_post_main_file">
                          @if (!empty($post->file))
                              <p onclick="fileRemove()" class="pull-right mt-2 mb-2 btn btn-sm btn-danger"
                                  style="cursor: pointer"><i class="fas fa-trash-alt"></i>
                              </p>
                          @else
                          @endif
                          @php
                              $file = $post->file;
                              $extention = pathinfo($file, PATHINFO_EXTENSION);
                          @endphp
                          @if ($extention == 'csv')
                              <span class="mt-2 mb-2" style="text-align: center; display :block; overflow: hidden;">
                                  <img src="{{ asset('img/xlsx.png') }}" width="170px" height="200px"
                                      alt="" title="">
                              </span>
                          @elseif($extention == 'txt')
                              <span class="mt-2 mb-2" style="text-align: center; display :block; overflow: hidden;">
                                  <img src="{{ asset('img/file.png') }}" width="170px" height="200px"
                                      alt="" title="">
                              </span>
                          @elseif($extention == 'docx')
                              <span class="mt-2 mb-2" style="text-align: center; display :block; overflow: hidden;">
                                  <img src="{{ asset('img/docx.png') }}" width="170px" height="200px"
                                      alt="" title="">
                              </span>
                          @elseif($extention == 'xlsx')
                              <span class="mt-2 mb-2" style="text-align: center; display :block; overflow: hidden;">
                                  <img src="{{ asset('img/xlsx.png') }}" width="170px" height="200px"
                                      alt="" title="">
                              </span>
                          @elseif($extention == 'pdf')
                              <span class="mt-2 mb-2" style="text-align: center; display :block; overflow: hidden;">
                                  <img src="{{ asset('img/pdf.png') }}" width="170px" height="200px"
                                      alt="" title="">
                              </span>
                          @elseif($extention == 'ppt')
                          @endif
                      </div>

                      {{-- {{ $post->file }} --}}

                      <label class="custom-file-label" for="chooseFile">Select file</label>
                  </div>
              </div>
          </div>


          <div class="x_panel">
              <div class="x_title">
                  <h3>Video Upload</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="custom-file">

                      <input type="file" name="video" class="custom-file-input" id="chooseVideo"
                          accept="video/mp4,video/x-m4v,Tvideo/*">
                      <input type="hidden" name="videoname" id="closevideo" value="{{ $post->video }}">
                      <div class="extention-panel" id="btn_delete_post_main_video">
                          @if (!empty($post->video))
                              <p onclick="videoRemove()" class="pull-right mt-2 mb-2 btn btn-sm btn-danger"
                                  style="cursor: pointer"><i class="fas fa-trash-alt"></i>
                              </p>
                          @else
                          @endif
                          {{-- ======================================== --}}
                          <span style="margin: 5% 0 1% 0; display:block;"> Enter a YouTube
                              URL:</span>
                          <input id="myUrl" type="text" name="youtubevideo" class="form-control mb-2" />

                          {{-- <p onclick="myVideo()" class="btn btn-success btn-sm"> conver embade</p> --}}

                          {{-- ======================================== --}}
                          @php
                              $video = $post->video;
                              $extention = pathinfo($video, PATHINFO_EXTENSION);
                              
                          @endphp
                          @if ($extention == 'mp4' && !empty($post->video))
                              <span class="mt-2 mb-2" style="text-align: center; display :block; overflow: hidden;">
                                  <img src="{{ asset('img/video.png') }}" width="100%" height="96vh"
                                      alt="" title="">
                              </span>
                          @else
                              @if (!empty($post->video))
                                  <input type="hidden" name="edityoutubevideo" value="{{ $post->video }}" />
                                  <iframe width="100%"
                                      height="auto"src="//www.youtube.com/embed/{{ $post->video }}"
                                      frameborder="0" allowfullscreen></iframe>
                              @else
                              @endif
                          @endif
                      </div>
                      <script type="text/javascript">
                          // function myVideo() {
                          //     const link = "https://www.youtube.com/watch?v=Ycp2mPIqPto&ab_channel=AnupamMovieSongs";
                          //     const urlId = link.substring(link.indexOf("=") + 1, link.indexOf("&"));
                          //     var res = link.split("=");
                          //     var embeddedUrl = "https://www.youtube.com/embed/" + urlId;
                          //     document.getElementById("closevideo").value = embeddedUrl;
                          // }
                      </script>
                      <script type="text/javascript">
                          function getId(url) {
                              var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                              var match = url.match(regExp);

                              if (match && match[2].length == 11) {
                                  return match[2];
                              } else {
                                  return 'error';
                              }
                          }
                          var myId;

                          function myVideo() {
                              var myUrl = $('#myUrl').val();
                              videoId = getId(myUrl);
                              var embeddedUrl = "https://www.youtube.com/embed/" + videoId;
                              document.getElementById("closevideo").value = embeddedUrl;

                              // $('#myId').html(myId);
                              // $('#myCode').html('<iframe width="560" height="315" src="//www.youtube.com/embed/' + myId +
                              //     '" frameborder="0" allowfullscreen></iframe>');
                          };
                      </script>
                      {{-- {{ $post->file }} --}}
                      <label class="custom-file-label" for="chooseVideo">Select Video (mp4)</label>
                  </div>
              </div>
          </div>


          <div class="x_panel">
              <div class="x_title">
                  <h3>Active / Inactive</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="">
                      <label>
                          <input type="hidden" value="0" class="js-switch" name="status"
                              {{ $post->status == 0 ? 'checked' : '' }}>
                          <input type="checkbox" value="1" class="js-switch" name="status"
                              {{ $post->status == 1 ? 'checked' : '' }}>
                      </label>
                  </div>
              </div>
          </div>



          <div class="x_panel">
              <div class="x_title">
                  <h3>Trending</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="">
                      <label>
                          <input type="hidden" value="0" class="js-switch" name="trending"
                              {{ $post->trending == 0 ? 'checked' : '' }}>
                          <input type="checkbox" value="1" class="js-switch" name="trending"
                              {{ $post->trending == 1 ? 'checked' : '' }}>
                      </label>
                  </div>
              </div>
          </div>
          <div class="x_panel">
              <div class="x_title">
                  <h3>Template</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="col ">
                      <div class="x_content">
                          <div class="item form-group">
                              <select class="custom-select" name="template" id="inputGroupSelect01">
                                  <option {{ $post->template == 1 ? 'selected=""' : '' }} value="1">
                                      Default </option>
                                  <option {{ $post->template == 2 ? 'selected=""' : '' }} value="2">
                                      Sidebar </option>
                                  <option {{ $post->template == 3 ? 'selected=""' : '' }} value="3">
                                      Full
                                      Width </option>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="x_panel">
              <div class="x_title">
                  <h3>Tag</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="col ">
                      <input id="tags_1" type="text" name="tag" class="tags form-control"
                          value="{{ $post->tag }}" />
                      <div id="suggestions-container"
                          style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                  </div>
              </div>
          </div>
          @php
              $role_id = Auth::user()->role_id;
              $rhps = DB::table('role_has_permissions')
                  ->where('role_id', $role_id)
                  ->get();
              $permissions = DB::table('permissions')->get();
          @endphp
          @foreach ($rhps as $rhpsvalue)
              @php
                  $permissionId = $rhpsvalue->permission_id;
              @endphp

              @foreach ($permissions as $pvalue)
                  @php
                      $pid = $pvalue->id;
                  @endphp
                  @if ($permissionId == $pid)
                      @if ($pvalue->name == 'post-privateshow')
                          <div class="x_panel">
                              <div class="x_title">
                                  <h3>Only Admin Display</h3>
                                  <ul class="nav navbar-right panel_toolbox">
                                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                      </li>

                                  </ul>
                                  <div class="clearfix"></div>
                              </div>
                              <div class="x_content">
                                  <div class="">
                                      <label>
                                          <input type="hidden" value="0" class="js-switch" name="privateshow"
                                              {{ $post->privateshow == 0 ? 'checked' : '' }}>
                                          <input type="checkbox" value="1" class="js-switch" name="privateshow"
                                              {{ $post->privateshow == 1 ? 'checked' : '' }}>
                                      </label>
                                  </div>
                              </div>
                          </div>
                      @endif
                  @endif
              @endforeach
          @endforeach


          <div class="x_panel">
              <div class="x_title">
                  <h3>Publish</h3>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="col">
                      <div class="form-group">
                          <div class='input-group date'>
                              {{-- <input type="text" id="datetime" class="form-control" name="publish_at"
                                                value=" "> --}}
                              <input type='text' id='datetimepicker' class="form-control" name="publish_at"
                                  value="{{ $post->publish_at }}" />
                          </div>
                      </div>
                      <script type="text/javascript">
                          // var today = new Date();
                          // document.getElementById("datetime").value = today.getFullYear() +
                          //     '-' + ('0' + (today.getMonth() + 1)).slice(-2) +
                          //     '-' + ('0' + today.getDate()).slice(-2) +
                          //     ' ' + ('0' + today.getHours()).slice(-2) +
                          //     ':' + ('0' + today.getMinutes()).slice(-2) +
                          //     ':' + ('0' + today.getSeconds()).slice(-2);
                          $(function() {

                              $('#datetimepicker').datetimepicker({
                                  format: 'yyyy-mm-dd hh:ii',
                                  autoclose: true,
                                  todayHighlight: true,
                              });

                          });
                      </script>
                  </div>
                  <div class="col-md-12 mt-2">
                      <button type="submit" class="btn btn-success" style="width:100%;"
                          id="submit-all">Update</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
