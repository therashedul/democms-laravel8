@extends('layouts.blog')
@section('content')
    <div class="container">
        <div class="row">
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
                        <h2>White List IP</h2>
                    </div>
                    <div class="x_content">
                        <div class="clearfix"></div>
                        <a class="btn btn-primary mb-2 ml-2" href="{{ route('white.create') }}">Add IP </a>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">IP</th>
                                </tr>
                            </thead>
                            @php
                                $getip = DB::table('hitlogs')
                                    ->select('*')
                                    ->first();
                                
                                $whitelists = DB::table('whitelists')
                                    ->select('*')
                                    ->get();
                                $users = DB::table('users')
                                    ->select('*')
                                    ->get();
                                
                            @endphp
                            <tbody>
                                @foreach ($whitelists as $value)
                                    <tr>
                                        <td>{{ $value->user_id }}</td>
                                        @foreach ($users as $user)
                                            @if ($value->user_id == $user->id)
                                                <td>{{ $user->name }}</td>
                                            @endif
                                        @endforeach

                                        <td>{{ $value->ip }}</td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
