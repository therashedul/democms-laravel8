@extends('layouts.deshboard')

@section('content')
    <form action="{{ route('superAdmin.white.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="  {{ $white->id }}">
        <div class="x_panel">
            <div class="x_title">
                <h2>IP</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">User ID
                    </label>
                    <select class="custom-select" name="user_id" id="inputGroupSelect01">
                        <option selected value="0">Choose...</option>
                        @if ($users)
                            @foreach ($users as $user)
                                <option {{ $user->id == $white->user_id ? 'selected=""' : '' }} value="{{ $user->id }}">
                                    {{ $user->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">IP
                    </label>
                    <input type="text" name="ip" class="form-control" value="{{ $white->ip }}" placeholder="IP">
                </div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-5 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
