@extends('layouts.deshboard')
@section('content')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="container">
        <form action="{{ route('superAdmin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @php
                $id = $post->id;
            @endphp
            <x-forms.superAdmin.post.postedit :id="$id" :categories="$categories" :postmeta="$postmeta" />
        </form>
    </div>
    <x-forms.superAdmin.post.posteditmodal />
@endsection
