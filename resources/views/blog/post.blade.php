@extends('layouts.blog')
@section('title', $post->{'name_' . app()->getLocale()})
@section('slug', $post->{'slug_' . app()->getLocale()})
@section('name', 'post.single')
@section('publish', $post->created_at)
@php    $image = asset('images/' . $post->image); @endphp
@section('image', $image)
@section('id', $post->id)
@php
    $limited = $post->{'content_' . app()->getLocale()};
    $contents = substr($limited, 0, 200);
    $keywords = substr($limited, 0, 150);
    $keyword = explode(' ', $keywords);
    $content = implode(', ', (array) $keyword);
@endphp
@section('description', $post->{'name_' . app()->getLocale()} . $contents)
@section('keywords', $post->{'name_' . app()->getLocale()} . $contents)


@section('content')
    {{-- @if ($post->template == 1 || $post->template == 2)
        @include('blog.posts.sidebarpost')
    @else
        @include('blog.posts.fullwidthpost')
    @endif --}}

    @php
        if (Auth::check()) {
            $email = Auth::user()->email;
            $role_id = Auth::user()->role_id;
        }
        $privatepost = DB::table('posts')
            ->where('id', '=', $post->id)
            ->first();
    @endphp
    @if (!empty($email))
        {{-- must be producting label off  --}}
        @if (($email == 'superadmin@gmail.com' && $privatepost->privateshow == '1') || $privatepost->privateshow == '0')
            @if ($post->template == 1 || $post->template == 2)
                <x-forntend.posts.sidebarpost :post="$post" :categories="$categories" :postmeta="$postmeta" :reletedpost="$reletedpost" />
            @else
                <x-forntend.posts.fullwidthpost :post="$post" :categories="$categories" :postmeta="$postmeta" :reletedpost="$reletedpost" />
            @endif
            {{-- must be producting label on  --}}
        @elseif(($role_id == '2' && $privatepost->privateshow == '1') || $privatepost->privateshow == '0')
            @if ($post->template == 1 || $post->template == 2)
                <x-forntend.posts.sidebarpost :post="$post" :categories="$categories" :postmeta="$postmeta" :reletedpost="$reletedpost" />
            @else
                <x-forntend.posts.fullwidthpost :post="$post" :categories="$categories" :postmeta="$postmeta"
                    :reletedpost="$reletedpost" />
            @endif
        @endif
    @elseif($privatepost->privateshow == '0')
        @if ($post->template == 1 || $post->template == 2)
            <x-forntend.posts.sidebarpost :post="$post" :categories="$categories" :postmeta="$postmeta" :reletedpost="$reletedpost" />
        @else
            <x-forntend.posts.fullwidthpost :post="$post" :categories="$categories" :postmeta="$postmeta" :reletedpost="$reletedpost" />
        @endif
    @else
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <h1 class="modal-title fs-5" id="myModalLabel">Modal title</h1> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h3>Display for only Admin</h3>
                    </div>
                </div>
            </div>
        </div>
        <script type='text/javascript'>
            $(window).on('load', function() {
                var delayMs = 100; // delay in milliseconds

                setTimeout(function() {
                    $('#myModal').modal('show');
                }, delayMs);

                // Set a timeout to hide the element again
                setTimeout(function() {
                    $('#myModal').modal('hide');
                    window.location = "{{ url('/') }}"

                }, 1500);

            });
        </script>
    @endif
@endsection
