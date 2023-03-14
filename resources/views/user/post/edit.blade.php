@extends('layouts.deshboard')

@section('content')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="container">
        <form action="{{ route('post/update') }}" method="post" enctype="multipart/form-data">
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
                                <input type="text" name="title" id="mySelect" onchange="myFunction()"
                                    class="form-control" placeholder="Add Title" value="{{ $post->title }}">

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
                                <div class="form-check">
                                    <input class="form-check-input parent" name="subcat_id[]" type="checkbox"
                                        value="{{ $category->id }}" {{ $checked }}>
                                    <input class="form-check-input parent"
                                        style="position: absolute;
                                                                                                    left: 67px;
                                                                                                    display: none;"
                                        name="uncat_id[]" type="checkbox" value="{{ $category->id }}" {{ $checked }}>
                                    <p>{{ $category->name }}</p>
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
                                        <div class="form-check">
                                            <input class="form-check-input child" style="margin-left: 7px;"
                                                name="subcat_id[]" type="checkbox" value="{{ $sub->id }}"
                                                {{ $checked }}>
                                            <input class="form-check-input child"
                                                style="position: absolute;
                                                                                                    left: 76px;
                                                                                                    display: none;"
                                                name="uncat_id[]" type="checkbox" value="{{ $sub->id }}"
                                                {{ $checked }}>
                                            <p class="child-child" style="margin-left: 30px">{{ $sub->name }}</p>
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
                        <div class="x_content">
                            <div class="form-group ">

                                <input type="file" name="image" />
                                <img src="{{ asset($post->image) }}" width="80px" height="60px">
                                {{-- <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only form-control" id="inputImage" name="file"
                                            accept="image/*">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="Import image ">
                                            <span class="fa fa-upload"></span>
                                        </span>
                                    </label> --}} {{-- <input type="file" name="image" class="form-control"> --}}
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
                                <button type="submit" class="btn btn-primary">Publish</button>
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
                var imp = spt.join('-');
                document.getElementById("linkValue").value = APP_URL + '/' + imp;
                document.getElementById("parmalink").innerHTML = APP_URL + '/' + imp;
                document.getElementById("slugValue").value = imp;
            }
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
@endsection
