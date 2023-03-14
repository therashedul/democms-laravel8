@extends('layouts.deshboard')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Black IP</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="POST" action="{{ route('superAdmin.black.store') }}">
                        @csrf

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">User name
                            </label>
                            <select class="custom-select" name="user_id" id="inputGroupSelect01">
                                <option selected value="0">Choose...</option>
                                @if ($users)
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- <input type="text" name="user" value="999999"> --}}
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">IP
                            </label>
                            <input type="text" name="ip" class="form-control" placeholder="Like: 127.0.0.1 ">
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
@endsection
