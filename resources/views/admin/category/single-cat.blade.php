<div class="col-md-12 col-sm-12  ">
    <div class="page-title">
        <ul>
            {{-- {{ $categories }} --}}
            @foreach ($postmetas as $postmeta)
                <li>
                    @foreach ($posts as $post)
                        @if ($post->id == $postmeta->post_id)
                            <a href="{{ route('posts', $post->slug) }}">{{ $post->title }}</a>
                        @endif
                    @endforeach
                </li>
            @endforeach
        </ul>

    </div>
</div>
