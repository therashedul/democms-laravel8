@extends('layouts.deshboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ __('Wellcome') }} {{ Auth::user()->name }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('success') }}
                            </div>
                        @endif

                        {{ __('You are logged Successfully') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
