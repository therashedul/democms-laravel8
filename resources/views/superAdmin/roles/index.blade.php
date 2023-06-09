@extends('layouts.deshboard')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Roles
                    <span class="float-right">
                        {{-- <a class="btn btn-primary" href="{{ route('superAdmin.roles.create') }}">New Role</a> --}}
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rhps = DB::table('role_has_permissions')->get();
                                $permissions = DB::table('permissions')->get();
                                $roles = DB::table('roles')->get();
                            @endphp

                            @foreach ($data as $key => $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        {{-- <a class="btn btn-success" href="{{ route('superAdmin.roles.show', $role->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('superAdmin.roles.edit', $role->id) }}">Edit</a> --}}
                                        @foreach ($rhps as $rhp)
                                            @foreach ($permissions as $permission)
                                                @if ($role->id == Auth::user()->role_id && $role->id == $rhp->role_id)
                                                    @if ($rhp->permission_id == $permission->id)
                                                        @php
                                                            $name = $permission->name;
                                                        @endphp
                                                        @if (stristr($name, 'role'))
                                                            @php
                                                                $value = substr(strstr($name, '-'), 1);
                                                                // echo $value;
                                                            @endphp
                                                            @if ($value == 'list')
                                                                <a class="btn btn-info btn-sm"
                                                                    href="{{ route('superAdmin.roles.show', $role->id) }}"><i
                                                                        class="fas fa-eye"></i></a>
                                                            @elseif ($value == 'create')
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('superAdmin.roles.create') }}"><i
                                                                        class="fas fa-plus"></i></a>
                                                            @elseif ($value == 'edit')
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="{{ route('superAdmin.roles.edit', $role->id) }}"><i
                                                                        class="fas fa-edit"></i></a>
                                                            @elseif ($value == 'delete')
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['superAdmin.roles.destroy', $role->id],
                                                                    'style' => 'display:inline',
                                                                ]) !!}
                                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-danger btn-sm']) }}
                                                                {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!} --}}
                                                                {!! Form::close() !!}
                                                            @else
                                                            @endif
                                                        @endif
                                                    @endif
                                                @elseif($role->id == '2' && $role->id == $rhp->role_id)
                                                    @if ($rhp->permission_id == $permission->id)
                                                        @php
                                                            $name = $permission->name;
                                                        @endphp
                                                        @if (stristr($name, 'role'))
                                                            @php
                                                                $value = substr(strstr($name, '-'), 1);
                                                            @endphp
                                                            @if ($value == 'list')
                                                                <a class="btn btn-info btn-sm"
                                                                    href="{{ route('superAdmin.roles.show', $role->id) }}"><i
                                                                        class="fas fa-eye"></i></a>
                                                            @elseif ($value == 'create')
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('superAdmin.roles.create') }}"><i
                                                                        class="fas fa-plus"></i></a>
                                                            @elseif ($value == 'edit')
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="{{ route('superAdmin.roles.edit', $role->id) }}"><i
                                                                        class="fas fa-edit"></i></a>
                                                            @elseif ($value == 'delete')
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['superAdmin.roles.destroy', $role->id],
                                                                    'style' => 'display:inline',
                                                                ]) !!}
                                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn  btn-danger btn-sm']) }}
                                                                {!! Form::close() !!}
                                                            @else
                                                            @endif
                                                        @endif
                                                    @endif
                                                @elseif($role->id == '3' && $role->id == $rhp->role_id)
                                                    @if ($rhp->permission_id == $permission->id)
                                                        @php
                                                            $name = $permission->name;
                                                        @endphp
                                                        @if (stristr($name, 'role'))
                                                            @php
                                                                $value = substr(strstr($name, '-'), 1);
                                                                // print_r($value);
                                                            @endphp
                                                            @if ($value == 'list')
                                                                <a class="btn btn-info btn-sm"
                                                                    href="{{ route('superAdmin.roles.show', $role->id) }}"><i
                                                                        class="fas fa-eye"></i></a>
                                                            @elseif ($value == 'create')
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('superAdmin.roles.create') }}"><i
                                                                        class="fas fa-plus"></i></a>
                                                            @elseif ($value == 'edit')
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="{{ route('superAdmin.roles.edit', $role->id) }}"><i
                                                                        class="fas fa-edit"></i></a>
                                                            @elseif ($value == 'delete')
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['superAdmin.roles.destroy', $role->id],
                                                                    'style' => 'display:inline',
                                                                ]) !!}
                                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                                                                {!! Form::close() !!}
                                                            @else
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                        {{-- {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['superAdmin.roles.destroy', $role->id],
                                            'style' => 'display:inline',
                                        ]) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!} --}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection
