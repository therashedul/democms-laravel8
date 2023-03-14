@extends('layouts.deshboard')
@section('content')
    <div class="container">

        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Edit role
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('superAdmin.roles') }}">Roles</a>
                    </span>
                </div>
                <div class="card-body">

                    {!! Form::model($role, ['route' => ['superAdmin.roles.update', $role->id], 'method' => 'PATCH']) !!}
                    <div class="form-group">
                        <strong class="mb-2"
                            style="text-align: center;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        display: flex;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        font-size: 18px;">Name:</strong>
                        <div class="form-group">
                            <select style="width:50%;margin-top: 10px;" name="role_id" class="form-control">
                                <option value="{{ $role->id }}">{{ $role->name ? $role->name : '' }}</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <strong class="mt-3"
                            style="text-align: center;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     display: flex;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 font-size: 22px;">Permission:</strong>
                        <br />
                        <div class="col-md-3">
                            <!-- Tabs nav -->
                            <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link mb-3 p-3 shadow active" id="v-pills-user-tab" data-toggle="pill"
                                    href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">User</span></a>
                                <a class="nav-link mb-3 p-3 shadow" id="v-pills-role-tab" data-toggle="pill"
                                    href="#v-pills-role" role="tab" aria-controls="v-pills-role" aria-selected="false">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">User Role</span></a>

                                <a class="nav-link mb-3 p-3 shadow" id="v-pills-permission-tab" data-toggle="pill"
                                    href="#v-pills-permission" role="tab" aria-controls="v-pills-permission"
                                    aria-selected="false">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">Permission</span></a>
                                {{-- =================== --}}
                                <a class="nav-link mb-3 p-3 shadow" id="v-pills-media-tab" data-toggle="pill"
                                    href="#v-pills-media" role="tab" aria-controls="v-pills-media"
                                    aria-selected="false">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">Media</span></a>
                                <a class="nav-link mb-3 p-3 shadow" id="v-pills-category-tab" data-toggle="pill"
                                    href="#v-pills-category" role="tab" aria-controls="v-pills-category"
                                    aria-selected="false">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">Category</span></a>

                                <a class="nav-link mb-3 p-3 shadow" id="v-pills-post-tab" data-toggle="pill"
                                    href="#v-pills-post" role="tab" aria-controls="v-pills-post" aria-selected="false">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">Post</span></a>

                                <a class="nav-link mb-3 p-3 shadow" id="v-pills-page-tab" data-toggle="pill"
                                    href="#v-pills-page" role="tab" aria-controls="v-pills-page" aria-selected="false">
                                    <i class="fa fa-check mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">Page</span></a>



                                {{-- ========================== --}}
                                <a class="nav-link mb-3 p-3 shadow" id="v-pills-menu-tab" data-toggle="pill"
                                    href="#v-pills-menu" role="tab" aria-controls="v-pills-menu" aria-selected="false">
                                    <i class="fa fa-star mr-2"></i>
                                    <span class="font-weight-bold small text-uppercase">Menu</span></a>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <!-- Tabs content -->
                            <div class="tab-content" id="v-pills-tabContent">
                                {{-- user --}}
                                <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-user"
                                    role="tabpanel" aria-labelledby="v-pills-user-tab">
                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                        @endphp
                                        @php
                                            $name = $value->name;
                                            $user = stristr($name, 'user');
                                        @endphp
                                        @if ($value->name == $user)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach
                                </div>


                                {{-- role --}}
                                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-role" role="tabpanel"
                                    aria-labelledby="v-pills-role-tab">
                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                        @endphp
                                        @php
                                            $name = $value->name;
                                            $role = stristr($name, 'role');
                                        @endphp
                                        @if ($value->name == $role)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- Media --}}
                                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-media" role="tabpanel"
                                    aria-labelledby="v-pills-media-tab">
                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                        @endphp
                                        @php
                                            $name = $value->name;
                                            $role = stristr($name, 'media');
                                        @endphp
                                        @if ($value->name == $role)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- Category --}}
                                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-category"
                                    role="tabpanel" aria-labelledby="v-pills-category-tab">
                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                        @endphp
                                        @php
                                            $name = $value->name;
                                            $role = stristr($name, 'category');
                                        @endphp
                                        @if ($value->name == $role)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- Post --}}
                                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-post" role="tabpanel"
                                    aria-labelledby="v-pills-post-tab">
                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                        @endphp
                                        @php
                                            $name = $value->name;
                                            $role = stristr($name, 'post');
                                        @endphp
                                        @if ($value->name == $role)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- Page --}}
                                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-page" role="tabpanel"
                                    aria-labelledby="v-pills-page-tab">
                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                        @endphp
                                        @php
                                            $name = $value->name;
                                            $role = stristr($name, 'page');
                                        @endphp
                                        @if ($value->name == $role)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- <button type="submit" class="btn btn-success col-md-6 float-right mr-3 mt-3">Submit</button>
                                @php
                                    die();
                                @endphp --}}
                                {{-- permission --}}
                                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-menu" role="tabpanel"
                                    aria-labelledby="v-pills-menu-tab">
                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                            $name = $value->name;
                                            $menu = stristr($name, 'menu');
                                        @endphp
                                        {{-- {{ $menu }} --}}
                                        @if ($value->name == $menu)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach

                                </div>
                                <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-permission"
                                    role="tabpanel" aria-labelledby="v-pills-permission-tab">

                                    @foreach ($permission as $value)
                                        @php
                                            $checked = '';
                                            $name = $value->name;
                                            $permission = stristr($name, 'permission');
                                        @endphp
                                        @if ($value->name == $permission)
                                            @foreach ($rolePermissions as $rvalue)
                                                @if ($rvalue->permission_id == $value->id)
                                                    @php
                                                        $checked = 'checked = ""';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input class="form-check-input parent" name="permission[]" type="checkbox"
                                                value="{{ $value->id }}" {{ $checked }}>
                                            <input class="form-check-input parent"
                                                style="position: absolute;                                                    display: none;"
                                                name="unpermission[]" type="checkbox" value="{{ $value->id }}"
                                                {{ $checked }}>
                                            <label>{{ $value->name }}</label>
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success col-md-6 float-right mr-3 mt-3">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
