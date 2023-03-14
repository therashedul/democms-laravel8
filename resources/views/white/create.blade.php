@extends('layouts.blog')
@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    @php
                        $getip = DB::table('hitlogs')->first();
                        $whitefirst = DB::table('whitelists')->first();
                    @endphp
                    @if (empty($whitefirst->id))
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Add White List</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form method="POST" action="{{ route('white.store') }}">
                                    @csrf
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">User ID
                                        </label>
                                        <select class="custom-select" name="user_id" id="inputGroupSelect01">
                                            @if ($users)
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="item form-group">
                                        <input type="hidden" name="ip" value="{{ $getip->ip }}"
                                            class="form-control">
                                    </div>
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-5 mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg mb-5">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <h2 style="" class="text-danger text-center d-block my-5">Just One IP added to the list</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
