@extends('layouts.deshboard')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bootstrap-iso">
                <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
                    {{-- {!! Form::open(['route' => 'admin.post.store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!} --}}
                    @csrf
                    <x-forms.admin.post.postcreate :categories="$categories" :user="$user" />
                    {{-- {!! Form::close() !!} --}}
                </form>
            </div>
        </div>
    </div>
    <x-forms.admin.post.postcreatemodal />
@endsection
