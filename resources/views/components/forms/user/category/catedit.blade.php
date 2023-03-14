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
        $cat = DB::table('categories')
            ->where('id', '=', $id)
            ->first();
    @endphp
    {{-- <input type="text" value="{{ $id }}" /> --}}
    <div class="lang">
        @php
            $langs[] = '';
        @endphp
        @foreach (config('app.multilocale') as $lang)
            @php
                $langs[] = $lang;
            @endphp
            <br />
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Category Name
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="text" name="name_{{ $lang }}" value="{{ $cat->{'name_' . $lang} }}"
                        id="mySelect_{{ $lang }}" onchange="myFunction_{{ $lang }}()"
                        class="form-control" placeholder="Category name" required />
                    <input type="hidden" name="title_{{ $lang }}" id="titleSelect_{{ $lang }}"
                        value="{{ $cat->{'title_' . $lang} }}" class="form-control">
                    <input type="hidden" name="slug_{{ $lang }}" value="{{ $cat->{'slug_' . $lang} }}"
                        id="slugValue_{{ $lang }}" class="form-control" placeholder="Category slug" required />
                    <input type="hidden" name="link_{{ $lang }}" id="linkValue_{{ $lang }}"
                        value="" class="form-control">
                </div>
            </div>
            <script type="text/javascript">
                function myFunction_{{ $lang }}() {

                    var strng = document.getElementById("mySelect_{{ $lang }}").value;
                    var APP_URL = {!! json_encode(url('/')) !!}
                    const spt = strng.split(" ");
                    var imp = spt.join('_');
                    document.getElementById("linkValue_{{ $lang }}").value = APP_URL + '/' + imp;
                    // document.getElementById("parmalink").innerHTML = APP_URL + '/' + imp;
                    document.getElementById("slugValue_{{ $lang }}").value = imp;
                    document.getElementById("titleSelect_{{ $lang }}").value = imp;
                }
            </script>
            @php
                //print_r($lang);
            @endphp
        @endforeach

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Select Parent
                Category<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 ">
                <select class="custom-select" name="parent_id" id="inputGroupSelect01">
                    <option selected value="0">Choose...</option>
                    @if ($categories)
                        @foreach ($categories as $category)
                            @if ($cat->id != $category->id)
                                <option {{ $category->id == $cat->parent_id ? 'selected=""' : '' }}
                                    value="{{ $category->id }}">
                                    @foreach ($langs as $lang)
                                        {{ $category->{'slug_' . $lang} }}
                                    @endforeach
                                </option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Status
        </label>
        <div class="col-md-6 col-sm-6 ">
            <input type="hidden" value="0" class="js-switch" name="status"
                {{ $cat->status == 0 ? 'checked' : '' }}>
            <input type="checkbox" value="1" class="js-switch" name="status"
                {{ $cat->status == 1 ? 'checked' : '' }}>
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
                @if ($pvalue->name == 'category-privatecat')
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Only Admin Display
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="hidden" value="0" class="js-switch" name="privatecat"
                                {{ $cat->privatecat == 0 ? 'checked' : '' }}>
                            <input type="checkbox" value="1" class="js-switch" name="privatecat"
                                {{ $cat->privatecat == 1 ? 'checked' : '' }}>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @endforeach




    {{-- ================================================ --}}
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Category
            Images<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            <a href="" class="upload-text" type="text" data-toggle="modal" data-target="#image_file_manager">
                Category image
            </a>
            @if (!empty($cat->category_img))
                <div id="post_select_image_container" class="post-select-image-container">
                    @if ($cat->category_img != null)
                        <button class="pull-right mt-4" onclick="displayimageRemove()" id="btn_delete">
                            <i class="fa fa-times"></i>
                        </button>
                    @endif
                    <img src="{{ asset('images/' . $cat->category_img) }}" id="selected_image_file" alt="">
                </div>
            @else
                <div id="post_select_image_container" class="post-select-image-container">
                    <a href="" class="upload-text" type="text" data-toggle="modal"
                        data-target="#image_file_manager">
                        <img src="{{ asset('img/profile/profile-image.png') }}" width="170px" height="200px"
                            alt="" title="">
                    </a>

                </div>
            @endif
            {{-- <input type="hidden" name="upload_id" value="{{ $cat->image_id }}"> --}}
            <input type="hidden" name="image_id" id="image_id" value="">
            <input type="hidden" name="image_name" id="image_name" value="{{ $cat->category_img }}">
            <input type="hidden" name="alt" id="alt_value" value="">
            <input type="hidden" name="title" id="title_value" value="">
            <input type="hidden" name="caption" id="caption_value" value="">
            <input type="hidden" name="description" id="description_value" value="">
        </div>
    </div>
