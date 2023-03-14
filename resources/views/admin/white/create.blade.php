@extends('layouts.deshboard')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>White IP</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <!-- Button trigger modal -->
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Get Ip list
                </button>
                @php
                    $getips = DB::table('getips')
                        ->Orderby('id', 'DESC')
                        ->first();
                @endphp
                <div class="x_content">
                    <form method="POST" action="{{ route('admin.white.store') }}">
                        @csrf

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">User ID
                            </label>
                            <select class="custom-select" name="user_id" id="inputGroupSelect01">
                                <option selected value="0">Choose...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">IP
                            </label>
                            @if (empty($getips->setip))
                                <input type="text" name="ip" class="form-control" placeholder="Like: 127.0.0.1">
                            @else
                                <input type="text" name="ip" value="{{ $getips->setip }}" class="form-control">
                            @endif
                        </div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-5 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.getip.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">IP List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select class="custom-select" name="setip" id="inputGroupSelect01">
                            <option selected value="0">Choose...</option>
                            @foreach ($distinks as $distink)
                                <option value="{{ $distink->ip }}">{{ $distink->ip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
