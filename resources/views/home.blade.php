@extends('layouts.deshboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @php
                    if (Auth::check()) {
                        $name = Auth::user()->name;
                    }
                @endphp
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3> {{ $name }} </h3>{{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
