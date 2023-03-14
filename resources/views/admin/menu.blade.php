@extends('layouts.deshboard')

@section('content')
    <style>
        #accordionExample .accordionBtn:before,
        #accordionExample .accordionBtn.collapsed:before {
            content: "\f067";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            width: 25px;
            height: 25px;
            line-height: 28px;
            font-size: 14px;
            color: #50bbaa;
            text-align: center;
            position: absolute;
            top: 18px;
            right: 15px;
            transform: rotate(135deg);
            transition: all 0.3s ease 0s;
        }

        #accordionExample .accordionBtn.collapsed:before {
            color: #a0a0a0;
            transform: rotate(0);
        }

        .item-list,
        .info-box {
            background: #fff;
            padding: 10px;
        }

        #serialize_output {
            display: hidden;
        }

        .item-list-body {
            max-height: 300px;
            overflow-y: scroll;
        }

        .panel-body p {
            margin-bottom: 5px;
        }

        .info-box {
            margin-bottom: 15px;
        }

        .item-list-footer {
            padding-top: 10px;
        }

        .panel-heading a {
            display: block;
        }

        .form-inline {
            display: inline;
        }

        .form-inline select {
            padding: 4px 10px;
        }

        .btn-menu-select {
            padding: 4px 10px
        }

        .disabled {
            pointer-events: none;
            opacity: 0.7;
        }

        .menu-item-bar {
            background: #eee;
            padding: 5px 10px;
            border: 1px solid #d7d7d7;
            margin-bottom: 5px;
            width: 75%;
            cursor: move;
            display: block;
        }

        #serialize_output {
            display: block;
        }

        .menulocation label {
            font-weight: normal;
            display: block;
        }

        body.dragging,
        body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            z-index: 1;
        }

        ol.example li.placeholder {
            position: relative;
        }

        ol.example li.placeholder:before {
            position: absolute;
        }

        #menuitem {
            list-style: none;
        }

        #menuitem ul {
            list-style: none;
        }

        .input-box {
            width: 75%;
            background: #fff;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 5px;
        }

        .input-box .form-control {
            width: 50%
        }
    </style>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <h2>Menus</h2>
                <div class="content info-box">
                    @if (count($menus) > 0)
                        Select a menu to edit:
                        <form action="{{ route('admin.menus') }}" class="form-inline">
                            <select name="id">
                                @foreach ($menus as $menu)
                                    @if ($desiredMenu != '')
                                        <option value="{{ $menu->id }}"
                                            @if ($menu->id == $desiredMenu->id) selected @endif>
                                            {{ $menu->title }}</option>
                                    @else
                                        <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary btn-menu-select">Select</button>
                        </form>
                        or
                    @endif
                    <a href="{{ route('admin.menus', ['id' => 'new']) }}" class="btn btn-info">Create a new menu</a>.
                </div>
            </div>
        </div>

        <div class="row" id="main-row">
            <div class="col-sm-3 cat-form @if (count($menus) == 0) disabled @endif">
                <h3><span>Add Menu Items</span></h3>
                {{-- ==================== --}}
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseTwo"><i class="fa fa-plus"></i>Categories</button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div id="categories-list">
                                <div class="card-body">
                                    <div class="item-list-body">
                                        @foreach ($categories as $cat)
                                            <p><input type="checkbox" name="select-category[]" value="{{ $cat->id }}">
                                                @foreach (config('app.multilocale') as $lang)
                                                    {{ $cat->{'name_' . $lang} }}
                                                @endforeach
                                                {{-- {{ $cat->{'name_' . app()->getLocale()} }} --}}
                                            </p>
                                        @endforeach
                                    </div>
                                    <div class="item-list-footer">
                                        <label class="btn btn-sm btn-default"><input type="checkbox"
                                                id="select-all-categories">
                                            Select All</label>
                                        <button type="button" class="pull-right btn btn-default btn-sm"
                                            id="add-categories">Add
                                            to Menu</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $('#select-all-categories').click(function(event) {
                                    if (this.checked) {
                                        $('#categories-list :checkbox').each(function() {
                                            this.checked = true;
                                        });
                                    } else {
                                        $('#categories-list :checkbox').each(function() {
                                            this.checked = false;
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    {{-- Category --}}
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapseOne"><i class="fa fa-plus"></i> Pages</button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div id="pages-list">
                                <div class="card-body">
                                    <div class="item-list-body">
                                        @foreach ($pages as $page)
                                            <p><input type="checkbox" name="select-page[]" value="{{ $page->id }}">
                                                @foreach (config('app.multilocale') as $lang)
                                                    {{ $page->{'name_' . $lang} }}
                                                @endforeach
                                                {{-- {{ $page->title }} --}}
                                            </p>
                                        @endforeach
                                    </div>
                                    <div class="item-list-footer">
                                        <label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-pages">
                                            Select All</label>
                                        <button type="button" id="add-pages" class="pull-right btn btn-default btn-sm">Add
                                            to
                                            Menu</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $('#select-all-pages').click(function(event) {
                                    if (this.checked) {
                                        $('#pages-list :checkbox').each(function() {
                                            this.checked = true;
                                        });
                                    } else {
                                        $('#pages-list :checkbox').each(function() {
                                            this.checked = false;
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    {{-- Page --}}
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapseThree"><i class="fa fa-plus"></i> Post</button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div id="posts-list">
                                <div class="card-body">
                                    <div class="item-list-body">
                                        @foreach ($posts as $post)
                                            <p><input type="checkbox" name="select-post[]" value="{{ $post->id }}">
                                                @foreach (config('app.multilocale') as $lang)
                                                    {{ $post->{'name_' . $lang} }}
                                                @endforeach
                                            </p>
                                        @endforeach
                                    </div>
                                    <div class="item-list-footer">
                                        <label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-posts">
                                            Select All</label>
                                        <button type="button" id="add-posts" class="pull-right btn btn-default btn-sm">Add
                                            to
                                            Menu</button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $('#select-all-posts').click(function(event) {
                                    if (this.checked) {
                                        $('#posts-list :checkbox').each(function() {
                                            this.checked = true;
                                        });
                                    } else {
                                        $('#posts-list :checkbox').each(function() {
                                            this.checked = false;
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    {{-- Post --}}
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapseFour"><i class="fa fa-plus"></i> Custom Link</button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-parent="#accordionExample">
                            <div id="custom-list">
                                <div class="card-body">
                                    <div class="item-list-body">
                                        @foreach (config('app.multilocale') as $lang)
                                            <div class="form-group">
                                                <label>URL ({{ $lang }})</label>
                                                <input type="url" id="url_{{ $lang }}" class="form-control"
                                                    placeholder="https://">
                                            </div>
                                            <div class="form-group">
                                                <label>Link Text ({{ $lang }})</label>
                                                <input type="text" id="linktext_{{ $lang }}"
                                                    class="form-control" placeholder="">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="item-list-footer">
                                        <button type="button" class="pull-right btn btn-default btn-sm"
                                            id="add-custom-link">Add
                                            to Menu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ==================== --}}
            </div>
            <div class="col-sm-9 cat-view">
                <h3><span>Menu Structure</span></h3>
                @if ($desiredMenu == '')
                    <h4>Create New Menu</h4>
                    <form method="post" action="{{ route('admin.menus.create') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-sm btn-primary">Create Menu</button>
                            </div>
                        </div>
                    </form>
                @else
                    <div id="menu-content">
                        <div id="result"></div>
                        <div style="min-height: 240px;">
                            {{-- @php
                                print_r($desiredMenu);
                            @endphp --}}
                            <p>Select categories, pages or add custom links to menus.</p>
                            @if ($desiredMenu != '')
                                <ul class="menu ui-sortable" id="menuitems">
                                    @if (!empty($menuitems))
                                        @foreach ($menuitems as $key => $item)
                                            @php
                                                // print_r($menuitems);
                                                // die();
                                            @endphp
                                            <li data-id="{{ $item->id }}">
                                                <span class="menu-item-bar"><i class="fa fa-arrows"></i>
                                                    @foreach (config('app.multilocale') as $lang)
                                                        {{ $item->{'title_' . $lang} }}
                                                        {{-- {{ $item->{'name_' . $lang} }} --}}
                                                    @endforeach
                                                    <a href="#collapse{{ $item->id }}" class="pull-right"
                                                        data-toggle="collapse"><i class="fa fa-chevron-down"></i></a>
                                                </span>
                                                <div class="collapse" id="collapse{{ $item->id }}">
                                                    <div class="input-box">
                                                        <form method="post"
                                                            action="{{ route('admin.menus.update-menuitem', $item->id) }}">
                                                            {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <label>Link Name</label>
                                                                @foreach (config('app.multilocale') as $lang)
                                                                    <input type="text" name="name_{{ $lang }}"
                                                                        value="{{ $item->{'name_' . $lang} }} "
                                                                        class="form-control"
                                                                        id="mySelect_{{ $lang }}_{{ $item->id }}"
                                                                        onkeyup="myFunction_{{ $lang }}_{{ $item->id }}()">
                                                                    <input type="hidden"
                                                                        name="title_{{ $lang }}"
                                                                        id="titleSelect_{{ $lang }}_{{ $item->id }}"
                                                                        value="{{ $item->{'title_' . $lang} }}"
                                                                        class="form-control">


                                                                    <script type="text/javascript">
                                                                        function myFunction_{{ $lang }}_{{ $item->id }}() {
                                                                            var strng = document.getElementById("mySelect_{{ $lang }}_{{ $item->id }}").value;
                                                                            document.getElementById("titleSelect_{{ $lang }}_{{ $item->id }}").value = strng;
                                                                        }
                                                                    </script>
                                                                @endforeach
                                                            </div>
                                                            @if ($item->type == 'custom')
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="text" name="slug"
                                                                        value="{{ $item->{'slug_' . $lang} }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="target" value="_blank"
                                                                        @if ($item->target == '_blank') checked @endif>
                                                                    <input type="hidden" name="target"
                                                                        value="" />
                                                                    Open in a new tab
                                                                </div>
                                                            @endif
                                                            <div class="form-group">
                                                                {{-- {{ $key }} --}}
                                                                <button class="btn btn-sm btn-primary">Save</button>
                                                                <a href="{{ route('admin.menus.delete-menuitem', ['id' => $item->id, 'key' => $key]) }}"
                                                                    class="btn btn-sm btn-danger">Delete</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <ul>
                                                    @if (isset($item->children))
                                                        @foreach ($item->children as $m)
                                                            @foreach ($m as $in => $data)
                                                                @php
                                                                    // print_r($data);
                                                                    // print_r($data->name);
                                                                @endphp
                                                                <li data-id="{{ $data->id }}" class="menu-item">
                                                                    <span class="menu-item-bar"><i
                                                                            class="fa fa-arrows"></i>
                                                                        @foreach (config('app.multilocale') as $lang)
                                                                            @if (empty($data->{'name_' . $lang}))
                                                                                {{ $data->{'title_' . $lang} }}
                                                                            @else
                                                                                {{ $data->{'name_' . $lang} }}
                                                                            @endif
                                                                        @endforeach
                                                                        <a href="#collapse{{ $data->id }}"
                                                                            class="pull-right" data-toggle="collapse"><i
                                                                                class="fa fa-chevron-down"></i>
                                                                        </a>
                                                                    </span>
                                                                    <div class="collapse"
                                                                        id="collapse{{ $data->id }}">
                                                                        <div class="input-box">
                                                                            <form method="post"
                                                                                action="{{ route('admin.menus.update-menuitem', $data->id) }}">
                                                                                {{ csrf_field() }}
                                                                                <div class="form-group">
                                                                                    <label>Link Name</label>
                                                                                    @foreach (config('app.multilocale') as $lang)
                                                                                        <input type="text"
                                                                                            name="name_{{ $lang }}"
                                                                                            value="{{ $data->{'name_' . $lang} }} "
                                                                                            class="form-control"
                                                                                            id="mySelect_{{ $lang }}_{{ $data->id }}"
                                                                                            onkeyup="myFunction_{{ $lang }}_{{ $data->id }}()">
                                                                                        <input type="text"
                                                                                            name="title_{{ $lang }}"
                                                                                            id="titleSelect_{{ $lang }}_{{ $data->id }}"
                                                                                            value="{{ $data->{'title_' . $lang} }}"
                                                                                            class="form-control">

                                                                                        <script type="text/javascript">
                                                                                            function myFunction_{{ $lang }}_{{ $data->id }}() {
                                                                                                var strng = document.getElementById("mySelect_{{ $lang }}_{{ $data->id }}").value;
                                                                                                document.getElementById("titleSelect_{{ $lang }}_{{ $data->id }}").value = strng;
                                                                                            }
                                                                                        </script>
                                                                                    @endforeach
                                                                                </div>
                                                                                {{-- <div class="form-group">
                                                                                    <label>Link Name</label>
                                                                                    <input type="text" name="name"
                                                                                        value="
                                                                                          @foreach (config('app.multilocale') as $lang)
                                                                            @if (empty($data->{'name_' . $lang}))
                                                                                {{ $data->{'title_' . $lang} }}
                                                                            @else
                                                                                {{ $data->{'name_' . $lang} }}
                                                                            @endif @endforeach"
                                                                                        class="form-control">
                                                                                </div> --}}
                                                                                @if ($data->type == 'custom')
                                                                                    <div class="form-group">
                                                                                        <label>URL</label>
                                                                                        <input type="text"
                                                                                            name="slug"
                                                                                            value="
                                                                                            {{ $data->{'slug_' . app()->getLocale()} }}"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="checkbox"
                                                                                            name="target" value="_blank"
                                                                                            @if ($data->target == '_blank') checked @endif>
                                                                                        <input type="hidden"
                                                                                            name="target"
                                                                                            value="" />
                                                                                        Open in a new tab
                                                                                    </div>
                                                                                @endif

                                                                                <div class="form-group">
                                                                                    {{-- {{ $key }} --}}

                                                                                    <button
                                                                                        class="btn btn-sm btn-primary">Save</button>
                                                                                    <a href="{{ route('admin.menus.delete-menuitem', ['id' => $data->id, 'key' => $key, 'in' => $in]) }}"
                                                                                        class="btn btn-sm btn-danger">Delete</a>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    {{-- ===================== --}}
                                                                    <ul>
                                                                        @if (isset($data->children))
                                                                            @foreach ($data->children as $value)
                                                                                @foreach ($value as $val)
                                                                                    {{ $val->id }}
                                                                                    <li data-id="{{ $val->id }}"
                                                                                        class="menu-item">
                                                                                        <span class="menu-item-bar"><i
                                                                                                class="fa fa-arrows"></i>
                                                                                            @foreach (config('app.multilocale') as $lang)
                                                                                                @if (empty($val->{'name_' . $lang}))
                                                                                                    {{ $val->{'title_' . $lang} }}
                                                                                                @else
                                                                                                    {{ $val->{'name_' . $lang} }}
                                                                                                @endif
                                                                                            @endforeach

                                                                                            <a href="#collapse{{ $val->id }}"
                                                                                                class="pull-right"
                                                                                                data-toggle="collapse"><i
                                                                                                    class="fa fa-chevron-down"></i></a>
                                                                                        </span>
                                                                                        <div class="collapse"
                                                                                            id="collapse{{ $val->id }}">
                                                                                            <div class="input-box">
                                                                                                <form method="post"
                                                                                                    action="{{ route('admin.menus.update-menuitem', $val->id) }}">
                                                                                                    {{ csrf_field() }}

                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>Link
                                                                                                            Name</label>
                                                                                                        @foreach (config('app.multilocale') as $lang)
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                name="name_{{ $lang }}"
                                                                                                                value="{{ $val->{'name_' . $lang} }} "
                                                                                                                class="form-control"
                                                                                                                id="mySelect_{{ $lang }}_{{ $val->id }}"
                                                                                                                onkeyup="myFunction_{{ $lang }}_{{ $val->id }}()">
                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="title_{{ $lang }}"
                                                                                                                id="titleSelect_{{ $lang }}_{{ $val->id }}"
                                                                                                                value="{{ $val->{'title_' . $lang} }}"
                                                                                                                class="form-control">

                                                                                                            <blade
                                                                                                                ___scripts_5___ />
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                    @if ($val->type == 'custom')
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <label>URL</label>
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                name="slug"
                                                                                                                value="{{ $val->{'slug_' . app()->getLocale()} }}"
                                                                                                                class="form-control">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                name="target"
                                                                                                                value="_blank"
                                                                                                                @if ($val->target == '_blank') checked @endif>
                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="target"
                                                                                                                value="" />
                                                                                                            Open in a new
                                                                                                            tab
                                                                                                        </div>
                                                                                                    @endif
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <button
                                                                                                            class="btn btn-sm btn-primary">Save</button>
                                                                                                        <a href="{{ route('admin.menus.delete-menuitem', ['id' => $val->id, 'key' => $key, 'in' => $in]) }}"
                                                                                                            class="btn btn-sm btn-danger">Delete</a>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
                                                                    {{-- ==================== --}}
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endif
                        </div>
                        @if ($desiredMenu != '')
                            <div class="form-group menulocation">
                                <label><b>Menu Location</b></label>
                                <p><label><input type="radio" name="location" value="1"
                                            @if ($desiredMenu->location == 1) checked @endif>
                                        Header Menu</label></p>
                                <p><label><input type="radio" name="location" value="2"
                                            @if ($desiredMenu->location == 2) checked @endif> Footer
                                        Menu</label></p>
                                <p><label><input type="radio" name="location" value="3"
                                            @if ($desiredMenu->location == 3) checked @endif> Sidebar Menu</label></p>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-sm btn-primary" id="saveMenu">Save Menu</button>
                            </div>
                            <p><a href="{{ route('admin.menus.delete-menu', $desiredMenu->id) }}"
                                    class="btn btn-danger">Delete Selected Menu</a>
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div id="serialize_output">
        @if ($desiredMenu)
            {{-- {{ $desiredMenu->content }} --}}
        @endif
    </div>
    <script>
        $('input[type="checkbox"]').on('change', function(e) {
            if ($(this).prop('checked')) {
                $(this).next().val('_blank');
            } else {
                $(this).next().val('');
            }
        });
    </script>
    <script src="{{ url('js/sortable.js') }}"></script>
    @if ($desiredMenu)
        <script>
            $('#add-categories').click(function() {
                var menuid = <?= $desiredMenu->id ?>;
                var n = $('input[name="select-category[]"]:checked').length;
                var array = $('input[name="select-category[]"]:checked');
                var ids = [];
                for (i = 0; i < n; i++) {
                    ids[i] = array.eq(i).val();
                }
                if (ids.length == 0) {
                    return false;
                }
                $.ajax({
                    type: "get",
                    data: {
                        menuid: menuid,
                        ids: ids
                    },
                    url: "{{ route('admin.menus.add-categories-to-menu') }}",
                    success: function(res) {
                        location.reload();
                    }
                })
            })
            $('#add-pages').click(function() {
                var menuid = <?= $desiredMenu->id ?>;
                var n = $('input[name="select-page[]"]:checked').length;
                var array = $('input[name="select-page[]"]:checked');
                var ids = [];
                for (i = 0; i < n; i++) {
                    ids[i] = array.eq(i).val();
                }
                if (ids.length == 0) {
                    return false;
                }
                $.ajax({
                    type: "get",
                    data: {
                        menuid: menuid,
                        ids: ids
                    },
                    url: "{{ route('admin.menus.add-page-to-menu') }}",
                    success: function(res) {
                        location.reload();
                    }
                })
            })
            $('#add-posts').click(function() {
                var menuid = <?= $desiredMenu->id ?>;
                var n = $('input[name="select-post[]"]:checked').length;
                var array = $('input[name="select-post[]"]:checked');
                var ids = [];
                for (i = 0; i < n; i++) {
                    ids[i] = array.eq(i).val();
                }
                if (ids.length == 0) {
                    return false;
                }
                $.ajax({
                    type: "get",
                    data: {
                        menuid: menuid,
                        ids: ids
                    },
                    url: "{{ route('admin.menus.add-post-to-menu') }}",
                    success: function(res) {
                        location.reload();
                    }
                })
            })
            $("#add-custom-link").click(function() {

                var menuid = <?= $desiredMenu->id ?>;
                var urlen = $('#url_en').val();
                var linken = $('#linktext_en').val();
                var urlbn = $('#url_bn').val();
                var linkbn = $('#linktext_bn').val();

                if (urlen.length > 0 && linken.length > 0 && urlbn.length > 0 && linkbn.length > 0) {
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            url_en: urlen,
                            link_en: linken,
                            url_bn: urlbn,
                            link_bn: linkbn

                        },
                        url: "{{ route('admin.menus.add-custom-link') }}",
                        success: function(res) {
                            location.reload();
                        }
                    })
                }
            })
        </script>
        <script>
            var group = $("#menuitems").sortable({
                group: 'serialization',
                onDrop: function($item, container, _super) {
                    var data = group.sortable("serialize").get();
                    var jsonString = JSON.stringify(data, null, ' ');
                    $('#serialize_output').text(jsonString);
                    _super($item, container);
                }
            });
        </script>
        <script>
            $('#saveMenu').click(function() {
                var menuid = <?= $desiredMenu->id ?>;
                var location = $('input[name="location"]:checked').val();
                var newText = $("#serialize_output").text();
                var data = JSON.parse($("#serialize_output").text());
                $.ajax({
                    type: "get",
                    data: {
                        menuid: menuid,
                        data: data,
                        location: location
                    },
                    url: "{{ route('admin.menus.update-menu') }}",
                    success: function(res) {
                        window.location.reload();
                    }
                })
            })
        </script>
        <script>
            $('.panel-collapse').on('show.bs.collapse', function() {
                $(this).siblings('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function() {
                $(this).siblings('.panel-heading').removeClass('active');
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });
            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });
        });
    </script>

@stop
