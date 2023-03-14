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
              width: 200px;
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

          .lang_en {
              margin-bottom: 3%;
          }
      </style>
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
                          <h3> New Post ( {{ $lang == 'en' ? 'English' : 'Bangla' }} )</h3>
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
                                  onchange="myFunction_{{ $lang }}()"
                                  class="form-control slugsearch_{{ $lang }}" placeholder="Add Title">


                              {{-- {!! Form::text('name'_{{ $lang }}, null, [
                                                'placeholder' => 'All post name',
                                                'class' => 'form-control slugsearch',
                                                'onchange' => 'myFunction_{{ $lang }}()',
                                                'id' => 'mySelect_{{ $lang }}',
                                                'pattern' => '[A-Za-z0-9_ ]{1,250}', // {1,15} this text lenth
                                                'title' => 'Please add post name',
                                                'oninvalid' => "setCustomValidity('Please don`t use syntex. ')",
                                            ]) !!} --}}

                              <input type="hidden" name="title_{{ $lang }}"
                                  id="titleSelect_{{ $lang }}" value="" class="form-control">
                          </div>

                          <input class="form-check-input" name="userId_{{ $lang }}" type="hidden"
                              value="{{ $user['id'] }}" checked>
                          <div class="form-group has-feedback">
                              <input type="hidden" name="slug_{{ $lang }}" id="slugValue_{{ $lang }}"
                                  value="" />
                          </div>
                          <div class="form-group has-feedback">
                              <input type="hidden" name="link_{{ $lang }}" id="linkValue_{{ $lang }}"
                                  value="" />
                              Permalink: <span id="parmalink_{{ $lang }}"> </span>
                          </div>
                          <div class=" form-group has-feedback">
                              {{-- {!! Form::textarea('content_{{ $lang }}', null, [
                                                'class' => 'form-control',
                                                'id' => 'my-editor_{{ $lang }}',
                                                'required' => '',
                                                'title' => 'Please add body',
                                            ]) !!} --}}

                              <textarea name="content_{{ $lang }}" class="my-editor_{{ $lang }} form-control"
                                  id="my-editor_{{ $lang }}" cols="50" rows="20"></textarea>

                          </div>
                      </div>
                      {{-- Exarpt field --}}

                      <div class="x_panel">
                          <div class="x_title">
                              <h3>Exarpt <span id="total_records"></span>
                              </h3>
                              <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                              </ul>
                              <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                              <div class=" form-group has-feedback">
                                  <textarea name="excerpt_{{ $lang }}" class="excerpt_{{ $lang }} form-control"
                                      id="excerpt_{{ $lang }}" cols="20" rows="5"></textarea>
                              </div>
                              {{-- {!! Form::textarea('excerpt_{{ $lang }}', null, [
                                                'class' => 'form-control',
                                                'title' => 'Please add excerpt',
                                                'cols' => '10',
                                                'rows' => '5',
                                            ]) !!} --}}
                          </div>
                      </div>
                  </div>

                  <script>
                      function myFunction_{{ $lang }}() {
                          var strng = document.getElementById("mySelect_{{ $lang }}").value;
                          var APP_URL = {!! json_encode(url('/')) !!}
                          const spt = strng.split(" ");
                          var imp = spt.join('-');
                          document.getElementById("linkValue_{{ $lang }}").value = APP_URL + '/' + imp;
                          document.getElementById("parmalink_{{ $lang }}").innerHTML = APP_URL + '/' + imp;
                          document.getElementById("slugValue_{{ $lang }}").value = imp;
                          document.getElementById("titleSelect_{{ $lang }}").value = strng;

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
                      CKEDITOR.replace('expt-editor_{{ $lang }}', options_{{ $lang }});
                  </script>
                  <script language="javascript">
                      // Ajex search 
                      $('.slugsearch_{{ $lang }}').on('change', function() {

                          var strng = document.getElementById("mySelect_{{ $lang }}").value;
                          const spt = strng.split(" ");
                          var imp = spt.join('_');
                          var slg = document.getElementById("slugValue_{{ $lang }}").value = imp;
                          $value = $(this).val();

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
                      @if ($categories)
                          @foreach ($categories as $category)
                              <div class="form-check checkbox">
                                  <label>
                                      <input class="form-check-input parent flat " name="subcat_id[]" type="checkbox"
                                          value="{{ $category->id }}" id="flexCheckDefault">
                                      @foreach (config('app.multilocale') as $lang)
                                          {{ $category->{'name_' . $lang} }}
                                      @endforeach
                                  </label>
                              </div>
                              @if (count($category->subcategory) > 0)
                                  @foreach ($category->subcategory as $sub)
                                      @if ($sub->parent_id)
                                          <div class="form-check" style="margin:1% 0 3% 5%;">
                                              <input class="form-check-input child flat" style="px;margin-left: 7px;"
                                                  name="subcat_id[]" type="checkbox" value="{{ $sub->id }}"
                                                  id="flexCheckDefault">
                                              <span class="child-child" style="margin-left: 0px ">
                                                  @foreach (config('app.multilocale') as $lang)
                                                      {{ $sub->{'name_' . $lang} }}
                                                  @endforeach

                                              </span>
                                          </div>
                                      @endif
                                      @if (count($sub->subcategory) > 0)
                                          @include('post.createsubcategories', [
                                              'category' => $sub->subcategory,
                                          ])
                                      @endif
                                  @endforeach
                              @endif
                          @endforeach
                      @endif
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
                              <input type="hidden" value="0" class="js-switch" name="status">
                              <input type="checkbox" value="1" class="js-switch" name="status"
                                  @if ('checked') checked @endif>
                          </label>
                      </div>
                  </div>
              </div>
              <div class="x_panel">
                  <div class="x_title">
                      <h3>Tending</h3>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="">
                          <label>
                              <input type="hidden" value="0" class="js-switch" name="trending">
                              <input type="checkbox" value="1" class="js-switch" name="trending"
                                  @if ('checked') checked @endif>
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
                                      <option value="1">Default Post </option>
                                      <option value="2">Sidebar post </option>
                                      <option value="3">Full Width post </option>

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
                          <input id="tags_1" type="text" name="tag" title="Please add tag"
                              class="tags form-control" value="" />
                          <div id="suggestions-container"
                              style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                      </div>
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
                  <div class="x_content">
                      <div class="form-group">
                          <strong>Image:</strong>
                          <a href="" type="text" class="upload-text" data-toggle="modal"
                              data-target="#image_file_manager">
                              Featured image
                          </a>
                          <div id="post_select_image_container" class="post-select-image-container">
                              <a href="" type="text" class="upload-text" data-toggle="modal"
                                  data-target="#image_file_manager">
                                  <img src="{{ asset('img/profile/cemera.jpg') }}" width="170px" height="200px"
                                      alt="" title="">
                              </a>

                          </div>
                          <input type="hidden" name="image_id" id="image_id">
                          <input type="hidden" name="image_name" id="image_name">
                          <input type="hidden" name="alt" id="alt_value">
                          <input type="hidden" name="title" id="title_value">
                          <input type="hidden" name="caption" id="caption_value">
                          <input type="hidden" name="description" id="description_value">
                      </div>
                  </div>
              </div>

              <div class="x_panel">
                  <div class="x_title">
                      <h3>Make Slider</h3>
                      <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                      </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="form-group">
                          <input type="checkbox" value="0" class="js-switch" name="slider"
                              @if ('checked') checked @endif>
                          <input type="hidden" value="1" class="js-switch" name="slider">
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
                              accept="video/mp4,video/x-m4v,video/*">
                          <div class="extention-panel" id="btn_delete_post_main_video">
                              {{-- ======================================== --}}
                              <span style="margin: 5% 0 1% 0; display:block;"> Enter a YouTube
                                  URL:</span>
                              <input id="myUrl" type="text" name="youtubevideo" class="form-control mb-2" />
                              {{-- <p onclick="myVideo()" class="btn btn-success btn-sm"> conver embade</p> --}}
                              <label class="custom-file-label" for="chooseVideo">Select Video (mp4)</label>
                          </div>
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
                                              <input type="checkbox" value="0" class="js-switch"
                                                  name="privateshow">
                                              <input type="hidden" value="1" class="js-switch"
                                                  name="privateshow" @if ('checked') checked @endif>
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
                                  <input type='text' id='datetimepicker' class="form-control" name="publish_at"
                                      value="{{ date('Y-m-d H:i:s', time()) }}" />
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
                                      format: 'yyyy-mm-dd hh:ii:ss',
                                      autoclose: true,
                                      timePicker: true,
                                      todayHighlight: true,
                                  });
                              });
                          </script>
                      </div>
                      <div class="col-md-12 mt-2">
                          <button type="submit" class="btn btn-success" style="width: 100%;"
                              id="submit-all">Publish</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
