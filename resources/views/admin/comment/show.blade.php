@extends('layouts.deshboard')
@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    @php
        $post = DB::table('posts')
            ->where('id', $comment->post_id)
            ->get();
    @endphp
    <a href="{{ route('admin.comments') }}" class="btn btn-sm btn-info d-flax mb-5"><i class="fas fa-arrow-left"></i>
        Back</a>
    <div class="content">
        <div class="row">
            <div class="col-12"> <strong>{{ $post[0]->name }}</strong>
            </div>
            <div class="col-12">
                <p class="mt-4">{!! $post[0]->content !!}</p>
            </div>
            <div class="col-12">
                <h5 class="mt-4">Comment</h5>
                <p>{{ $comment->comment_body }}</p>
            </div>
        </div>
    </div>

    {{-- <a href="{{ route('admin.comments.distroy', $comment->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"
            aria-hidden="true"></i> Delete</a> --}}
@endsection
