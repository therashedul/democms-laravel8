@extends('layouts.deshboard')

@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <p>{{ \Session::get('error') }}</p>
                </div>
            @endif
            <div class="x_title">
                <h2>Black List IP</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="clearfix"></div>

                <a class="btn btn-primary mb-2 ml-2" href="{{ route('superAdmin.black.create') }}">Add IP </a>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">IP</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    @php
                        $blacklists = DB::table('blacklists')
                            ->select('*')
                            ->get();
                        $users = DB::table('users')
                            ->select('*')
                            ->get();
                        // print_r($blacklists);
                        // die();
                    @endphp

                    <tbody>
                        @foreach ($blacklists as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                @if ($value->user_id == '' || $value->user_id == '0')
                                    <td>Empty</td>
                                @else
                                    @foreach ($users as $user)
                                        @if ($value->user_id == $user->id)
                                            <td>{{ $user->name }}</td>
                                        
                                        @endif
                                    @endforeach
                                @endif
                                <td>{{ $value->ip }}</td>
                                <td>
                                    <a href="{{ route('superAdmin.black.edit', $value->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-pencil-square"
                                            aria-hidden="true"></i></a>
                                    <a href="{{ route('superAdmin.black.delete', $value->id) }}"
                                        class="btn btn-info btn-sm  btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
