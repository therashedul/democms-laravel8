@extends('layouts.deshboard')
@section('content')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="container">
        <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @php
                $id = $post->id;
            @endphp
            <x-forms.admin.post.postedit :id="$id" :categories="$categories" :postmeta="$postmeta" />
        </form>
    </div>
    <x-forms.admin.post.posteditmodal />
@endsection
