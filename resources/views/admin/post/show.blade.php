@extends('layouts.deshboard')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>

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
        }
    </style>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-9 ">
                <h1 style="display: block;text-align:center;">{{ $post[0]->name }}</h1>
                @if (!empty($post[0]->image))
                    <div id="post_select_image_container" class="post-select-image-container text-center mb-4">
                        @if ($post[0]->image != null)
                        @endif
                        <img class="d-block text-center" src="{{ asset('images/' . $post[0]->image) }}"
                            id="selected_image_file" alt="">
                    </div>
                @else
                    <div id="post_select_image_container" class="post-select-image-container">
                        <img src="{{ asset('images/profile/cemera.jpg') }}" width="170px" height="200px" alt=""
                            title="">
                    </div>
                @endif
                <input type="hidden" name="upload_id" value="{{ $post[0]->image_id }}">
                <input type="hidden" name="image_id" id="image_id" value="{{ $post[0]->image_id }}">
                <input type="hidden" name="image_name" id="image_name" value="{{ $post[0]->image }}">
                <input type="hidden" name="alt" id="alt_value" value="{{ $post[0]->alt }}">
                <input type="hidden" name="title" id="title_value" value="{{ $post[0]->title }}">
                <input type="hidden" name="caption" id="caption_value" value="{{ $post[0]->caption }}">
                <input type="hidden" name="description" id="description_value" value="{{ $post[0]->description }}">
                {!! $post[0]->content !!}
                {!! $post[0]->excerpt !!}


                <h4>Add comment</h4>

                {{-- @foreach ($post[0]->comments as $comment)
                    <div class="display-comment">
                        <strong>{{ $comment->user->name }}</strong>
                        <p>{{ $comment->comment_body }}</p>
                    </div>
                @endforeach --}}
                <hr />
                <form action="{{ route('admin.comments.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="comment_body"></textarea>
                        <input type="hidden" name="post_id" value="{{ $post[0]->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add Comment" />
                    </div>
                </form>
                @include('admin.post.commentsDisplay', [
                    'comments' => $post[0]->comments,
                    'post_id' => $post[0]->id,
                ])
            </div>
            <div class="col-md-3 ">
                <div class="x_content">
                    <h4>Category</h4>
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
                            <a href=""> {{ $category->name }}</a>
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
                                <div class="form-check checkbox">
                                    <a href=""> {{ $sub->name }}</a>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
                <h4>Tag</h4>
                <a href="">{{ $post[0]->tag }}</a>
            </div>
        </div>
        </form>
    </div>
@endsection
