@extends('layouts.deshboard')
@section('title', 'Page index')
@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    <x-forms.admin.page.pageindex :userdata="$userData" :pages="$pages" />
@endsection
