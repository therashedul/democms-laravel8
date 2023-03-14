@extends('layouts.deshboard')

@section('content')
    <div class="container">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <div class="bootstrap-iso">
            <form method="POST" action="{{ route('post/store') }}" enctype="multipart/form-data">
                @csrf
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
                                        class="form-control" placeholder="Add Title">
                                    <input type="hidden" name="title" id="titleSelect" value=""
                                        class="form-control">
                                </div>

                                <input class="form-check-input" name="userId" type="hidden" value="{{ $user['id'] }}"
                                    checked>
                                <div class="form-group has-feedback">
                                    <input type="hidden" name="slug" id="slugValue" value="" />
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="hidden" name="link" id="linkValue" value="" />
                                    Permalink: <span id="parmalink"> </span>
                                </div>
                                <div class=" form-group has-feedback">
                                    <textarea name="content" class="my-editor form-control" id="my-editor" cols="50" rows="20"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Exarpt field --}}
                        <div class="x_panel">
                            <div class="x_title">
                                <h3>Exarpt</h3>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class=" form-group has-feedback">
                                    <textarea name="excerpt" class=" form-control" cols="10" rows="5"></textarea>
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
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input parent " name="subcat_id[]" type="checkbox"
                                                value="{{ $category->id }}" id="flexCheckDefault">
                                            <p> {{ $category->name }} </p>
                                        </div>
                                        @if (count($category->subcategory) > 0)
                                            @foreach ($category->subcategory as $sub)
                                                <div class="form-check">
                                                    <input class="form-check-input child " style="px;margin-left: 7px;"
                                                        name="subcat_id[]" type="checkbox" value="{{ $sub->id }}"
                                                        id="flexCheckDefault">
                                                    <p class="child-child" style="margin-left: 30px">{{ $sub->name }}
                                                    </p>
                                                </div>
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

                                    {{-- <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only form-control" id="inputImage" name="file"
                                            accept="image/*">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="Import image ">
                                            <span class="fa fa-upload"></span>
                                        </span>
                                    </label> --}}
                                    {{-- <input type="file" name="image" class="form-control"> --}}

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
                                        <input type="hidden" value="0" class="js-switch" name="status">
                                        <input type="checkbox" value="1" class="js-switch" name="status"
                                            @if ('checked') checked @endif>
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
                                        value="" />
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
                                            <input type='text' id='datetimepicker' class="form-control"
                                                name="publish_at" value="{{ date('Y-m-d H:i:s', time()) }}" />
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
                                    <button type="submit" class="btn btn-primary">Publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <script>
                function myFunction() {
                    var strng = document.getElementById("mySelect").value;
                    var APP_URL = {!! json_encode(url('/')) !!}
                    const spt = strng.split(" ");
                    var imp = spt.join('-');
                    document.getElementById("linkValue").value = APP_URL + '/' + imp;
                    document.getElementById("parmalink").innerHTML = APP_URL + '/' + imp;
                    document.getElementById("slugValue").value = imp;
                    document.getElementById("titleSelect").value = strng;

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
            CKEDITOR.replace('expt-editor', options);
        </script>


    @endsection

    {{-- <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <!-- Form code begins -->
                        <form method="post">
                            <div class="form-group">
                                <!-- Date input -->
                                <label class="control-label" for="date">Date</label>
                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" />
                            </div>
                            <div class="form-group">
                                <!-- Submit button -->
                                <button class="btn btn-primary " name="submit" type="submit">Submit</button>
                            </div>
                        </form>
                        <!-- Form code ends -->

                    </div>
                </div>
            </div>
           

            <script>
                $(document).ready(function() {
                    var date_input = $('input[name="date"]'); //our date input has the name "date"
                    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                    var options = {
                        format: 'yyyy-mm-dd',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                    };
                    date_input.datepicker(options);
                })
            </script> --}}
