@extends('layouts.deshboard')

@section('content')
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="container">
        <form action="{{ route('superAdmin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="row">
                <div class="col-md-9 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>Add New Post</h3>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <div class=" form-group has-feedback">
                                <input type="text" name="name" id="mySelect" onchange="myFunction()"
                                    class="form-control slugsearch" placeholder="Add Title" value="{{ $post->name }}">

                            </div>
                            <div class="form-group has-feedback">
                                <input type="hidden" name="user_id" value="{{ $post->user_id }}" />
                            </div>

                            <div class="form-group has-feedback">
                                <input type="hidden" name="slug" id="slugValue" value="{{ $post->slug }}" />
                            </div>
                            <div class="form-group has-feedback">
                                <input type="hidden" name="link" id="linkValue" value="{{ $post->link }}" />
                                Permalink: <span id="parmalink">{{ $post->link }} </span>
                            </div>
                            <div class=" form-group has-feedback">
                                <textarea name="content" class="my-editor form-control" id="my-editor" cols="50" rows="20">{{ $post->content }}</textarea>
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
                                <textarea name="excerpt" class=" form-control" cols="10" rows="5">{{ $post->excerpt }}</textarea>
                            </div>
                        </div>
                    </div>
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
                                    <span>{{ $category->name }}</span>
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
                                            <span class="child-child" style="margin-left: 0px">{{ $sub->name }}</span>
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
                                            <button class="pull-right mt-4" onclick="displayimageRemove()"
                                                id="btn_delete">
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
                                            <img src="{{ asset('img/profile/blank-img.jpg') }}" width="170px"
                                                height="200px" alt="" title="">
                                        </a>

                                    </div>
                                @endif
                                <input type="hidden" name="upload_id" value="{{ $post->image_id }}">
                                <input type="hidden" name="image_id" id="image_id" value="{{ $post->image_id }}">
                                <input type="hidden" name="image_name" id="image_name" value="{{ $post->image }}">
                                <input type="hidden" name="alt" id="alt_value" value="{{ $post->alt }}">
                                <input type="hidden" name="title" id="title_value" value="{{ $post->title }}">
                                <input type="hidden" name="caption" id="caption_value" value="{{ $post->caption }}">
                                <input type="hidden" name="description" id="description_value"
                                    value="{{ $post->description }}">
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
                                <input type="hidden" name="filename" id="closefile" value="{{ $post->file }}">
                                <div class="extention-panel" id="btn_delete_post_main_file">
                                    @if (empty($post->video))
                                    @else
                                        <p onclick="fileRemove()" class="pull-right mt-2 mb-2 btn btn-sm btn-danger"
                                            style="cursor: pointer"><i class="fas fa-trash-alt"></i>
                                        </p>
                                    @endif
                                    @php
                                        $file = $post->file;
                                        $extention = pathinfo($file, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($extention == 'csv')
                                        <span class="mt-2 mb-2"
                                            style="text-align: center; display :block; overflow: hidden;">
                                            <img src="{{ asset('img/xlsx.png') }}" width="170px" height="200px"
                                                alt="" title="">
                                        </span>
                                    @elseif($extention == 'txt')
                                        <span class="mt-2 mb-2"
                                            style="text-align: center; display :block; overflow: hidden;">
                                            <img src="{{ asset('img/file.png') }}" width="170px" height="200px"
                                                alt="" title="">
                                        </span>
                                    @elseif($extention == 'docx')
                                        <span class="mt-2 mb-2"
                                            style="text-align: center; display :block; overflow: hidden;">
                                            <img src="{{ asset('img/docx.png') }}" width="170px" height="200px"
                                                alt="" title="">
                                        </span>
                                    @elseif($extention == 'xlsx')
                                        <span class="mt-2 mb-2"
                                            style="text-align: center; display :block; overflow: hidden;">
                                            <img src="{{ asset('img/xlsx.png') }}" width="170px" height="200px"
                                                alt="" title="">
                                        </span>
                                    @elseif($extention == 'pdf')
                                        <span class="mt-2 mb-2"
                                            style="text-align: center; display :block; overflow: hidden;">
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
                                    accept="video/mp4,video/x-m4v,video/*">
                                <input type="hidden" name="videoname" id="closevideo" value="{{ $post->video }}">
                                <div class="extention-panel" id="btn_delete_post_main_video">
                                    @if (empty($post->video))
                                    @else
                                        <p onclick="videoRemove()" class="pull-right mt-2 mb-2 btn btn-sm btn-danger"
                                            style="cursor: pointer"><i class="fas fa-trash-alt"></i>
                                        </p>
                                    @endif
                                    {{-- ======================================== --}}
                                    <label class="mt-4">Enter a YouTube URL:
                                        <input id="myUrl" type="text" class="form-control mb-2"
                                            placeholder="https://www.youtube.com/watch?v=5L-zFRaIiJU&ab_channel=DefenseUpdateBangladesh" />
                                    </label>
                                    <p onclick="myVideo()" class="btn btn-success btn-sm"> conver embade</p>

                                    {{-- ======================================== --}}
                                    @php
                                        $video = $post->video;
                                        $extention = pathinfo($video, PATHINFO_EXTENSION);
                                        
                                    @endphp
                                    @if ($extention == 'mp4')
                                        <span class="mt-2 mb-2"
                                            style="text-align: center; display :block; overflow: hidden;">
                                            <img src="{{ asset('img/xlsx.png') }}" width="170px" height="200px"
                                                alt="" title="">
                                        </span>
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
                                <button type="submit" class="btn btn-primary" id="submit-all">Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            function myFunction() {
                var strng = document.getElementById("mySelect").value;
                var APP_URL = {!! json_encode(url('/')) !!}
                const spt = strng.split(" ");
                var imp = spt.join('_');
                document.getElementById("linkValue").value = APP_URL + '/' + imp;
                document.getElementById("parmalink").innerHTML = APP_URL + '/' + imp;
                // document.getElementById("slugValue").value = imp;
            }
        </script>
        <script language="javascript">
            // Ajex search 
            $('.slugsearch').on('keyup', function() {
                var strng = document.getElementById("mySelect").value;
                const spt = strng.split(" ");
                var imp = spt.join('_');
                var slg = document.getElementById("slugValue").value = imp;
                $value = $(this).val();

                $.ajax({
                    type: 'get',
                    url: "{{ route('superAdmin.post.slugsearch') }}",
                    data: {
                        'slugsearch': $value
                    },
                    success: function(data) {
                        if (data) {
                            document.getElementById("slugValue").value = data + '_1';

                        } else {
                            document.getElementById("slugValue").value = imp;
                        }
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
    </div>

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
    {{-- =================== Strart image upload ========== --}}

    <!-- Modal -->
    <div class="modal fade" id="image_file_manager">
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

                {{-- {!! Form::open(['method' => 'get', 'route' => 'user.Users.destroy', 'enctype' => 'multipart/form-data', 'id' => 'myform']) !!} --}}
                <div class="modal-body">
                    <div class="file-manager">
                        <div class="file-manager-left">
                            <form id="dropzoneForm" enctype="multipart/form-data" class="dropzone"
                                action="{{ route('superAdmin.post.upload') }}">
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
                            {{-- <div id="previewsContainer" name="logo" class="dropzone">
                                <div class="dz-default dz-message">
                                    Drop files here to upload
                                </div>
                            </div> --}}
                        </div>
                        {{-- file-manager-left --}}
                        <div class="file-manager-middel">
                            <div class="file-manager-content">
                                <div class="col-sm-12 col-md-12">
                                    <div class="row">
                                        <div id="image_file_upload_response">
                                            <div class="panel panel-default">
                                                <div class="panel-body" id="uploaded_image">

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
                                <input class="form-control" readonly type="text" name="name"
                                    id="selected_img_name">
                            </div>
                            <div class="form-group">
                                <label>URL</label>
                                <input class="form-control" type="text" name="link" id="selected_img_file_path">
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

                        <button type="button" id="btn_img_delete" class="btn btn-danger pull-left btn-file-delete"><i
                                class="fas fa-trash"></i>&nbsp;&nbsp; Delete </button>

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
                url: "{{ route('superAdmin.posts.fetch') }}",
                success: function(data) {
                    $('#uploaded_image').html(data);
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
            $('#btn_img_delete').show();
            $('#btn_img_select').show();
        });
        //select image Delete
        $(document).on('click', '#image_file_manager #btn_img_delete', function() {
            var file_name = $('#selected_img_name').val();
            $.ajax({
                url: "{{ route('superAdmin.posts.deleted') }}",
                data: {
                    name: file_name
                },
                success: function(data) {
                    if (data.action == 'image') {
                        // use for animation hidden
                        $("#msg").html(data.msg).show().delay(2000).fadeOut();
                    } else {
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
            const element = document.getElementById("rightHide");
            element.remove();

            document.getElementById("NewClass").className = "col-md-12";

        }

        function imageRemove() {
            // const element = document.getElementById("image_id");
            // element.remove();
            document.getElementById("image_id").value = '';
            document.getElementById("image_name").value = '';
            document.getElementById('display_image').removeAttribute('src');
            const element = document.getElementById("btn_delete_post_main_image");
            element.remove();
        }

        function fileRemove() {
            document.getElementById("closefile").value = '';
            const element = document.getElementById("btn_delete_post_main_file");
            element.remove();
        }

        function videoRemove() {
            document.getElementById("closevideo").value = '';
            const element = document.getElementById("btn_delete_post_main_video");
            element.remove();
        }

        function displayimageRemove() {
            // const element = document.getElementById("image_id");
            // element.remove();
            document.getElementById("image_id").value = '';
            document.getElementById("image_name").value = '';
            document.getElementById('selected_image_file').removeAttribute('src');
            const element = document.getElementById("btn_delete");
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
                url: "{{ route('superAdmin.posts.imgsearch') }}",
                data: data,
                success: function(response) {
                    document.getElementById("image_file_upload_response").innerHTML = response
                }
            });
        });
    </script>
    {{-- ===================End image upload========== --}}
@endsection
