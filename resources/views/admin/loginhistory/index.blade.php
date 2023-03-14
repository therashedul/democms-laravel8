@extends('layouts.deshboard')

@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Login History</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="clearfix"></div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IP</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Last login date time</th>
                            <th scope="col">Reason</th>


                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $users = DB::table('users')
                                ->select('*')
                                ->get();
                            $sl = 1;
                        @endphp
                        @foreach ($loginhistories as $value)
                            {{-- {{ app()->getLocale() }} --}}
                            <tr>
                                <th scope="row">{{ $sl++ }}</th>
                                <td>{{ $value->ip }}</td>
                                   @if ($value->user_id == '' || $value->user_id == '0')
                                    <td>Empty</td>
                                @else
                                    @foreach ($users as $user)
                                        @if ($value->user_id == $user->id)
                                            <td>{{ $user->name }}</td>
                                        
                                        @endif
                                    @endforeach
                                @endif

                                {{-- <td>{{ $value->user_id }}</td> --}}
                                {{-- @foreach ($users as $user)
                                        @if ($value->user_id == $user->id)
                                            <td>{{ $user->name }}</td>
                                        
                                        @endif
                                    @endforeach --}}
                                <td>
                                    <span>{{ date('d-M-y -- H:i:s', strtotime($value->created_at)) }}</span>
                                </td>
                                <td>
                                    @if ($value->reason == 'Ipwhitelisted')
                                        <div class="btn btn-success btn-sm"> Login Success
                                        </div>
                                    @elseif($value->reason == 'invalid credentials')
                                        <div class="btn btn-danger btn-sm"> {{ $value->reason }}
                                        </div>
                                    @else
                                        <div class="btn btn-info btn-sm"> {{ $value->reason }}
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $loginhistories->links() !!}
            </div>
        </div>
    </div>
@endsection
