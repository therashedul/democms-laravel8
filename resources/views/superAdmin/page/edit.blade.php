@extends('layouts.deshboard')
@section('content')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="container">
        <form action="{{ route('superAdmin.page.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @php
                $id = $page->id;
            @endphp
            <x-forms.superAdmin.page.pageedit :id="$id" :user="$user" :pages="$pages" />
        </form>
        <x-forms.superAdmin.page.pageeditmodel />
    @endsection
