@extends('layouts.deshboard')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    <x-forms.superAdmin.post.postindex :userdata="$userData" :categories="$categories" :posts="$posts" />
@endsection
