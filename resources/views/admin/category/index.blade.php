@extends('layouts.deshboard')

@section('content')
    <x-forms.admin.category.catindex :categories="$categories" />
@endsection
