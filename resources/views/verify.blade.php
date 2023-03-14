@extends('layouts.appLogin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        <strong>{{ $email }}</strong>
                        {{ __('If you did not receive the email') }},
                        @if ($id == true)
                            <form class="d-inline" method="POST" action="{{ route('verification.resend', $id) }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        @else
                            Null
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
