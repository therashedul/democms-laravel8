@extends('layouts.deshboard')

@section('content')
    <x-forms.superAdmin.category.catindex :categories="$categories" />
@endsection
