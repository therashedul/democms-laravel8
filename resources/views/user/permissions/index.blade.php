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
                <div class="card-header">Permissions
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('user.permissions.create') }}"><i class="fas fa-plus"></i>
                            New Permission</a>
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
                            @foreach ($data as $key => $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('user.permissions.show', $permission->id) }}"><i
                                                class="fas fa-eye"></i></a>

                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('user.permissions.edit', $permission->id) }}"><i
                                                class="fas fa-edit"></i></a>

                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['user.permissions.destroy', $permission->id],
                                            'style' => 'display:inline',
                                        ]) !!}
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-danger btn-sm']) }}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
