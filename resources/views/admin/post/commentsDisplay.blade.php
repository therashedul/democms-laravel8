@foreach ($comments as $comment)
    <div class="display-comment" @if ($comment->parent_id != null) style="margin-left:40px;" @endif>
        @php
            $usr = DB::table('users')
                ->where('id', $comment->user_id)
                ->get();
        @endphp
        <strong> {{ optional($comment->user)->name }}</strong>
        <strong> {{ $usr[0]->name }}</strong>
        @if ($comment->parent_id != null)
            <div class="has-parent-panel" style="margin-bottom: 20px; border-bottom: #ccc solid 1px; padding: 5px 0;">
                <p style="margin-bottom: 5px">{{ $comment->comment_body }}</p>
                <span id="text{{ $comment->id }}"></span>
                <a href="" id="reply"></a>
                {{-- <a href="{{ route('admin.soft.delete', $comment->id) }}" class="btn btn-sm btn-info  btn-danger"><i
                        class="fa fa-trash" aria-hidden="true"></i></a> --}} {{-- display delete btn --}}
                <a href="#"
                    onclick="showStuff('answer{{ $comment->id }}', 'text{{ $comment->id }}', this); return false;"
                    class="text-info">Reply</a>
            </div>
        @else
            <div class="has-parent-panel" style="margin-bottom: 20px; border-bottom: #ccc solid 1px; padding: 5px 0;">
                <p style="margin-bottom: 5px">{{ $comment->comment_body }}</p>
                <span id="text{{ $comment->id }}"></span>
                <a href="" id="reply"></a>
                {{-- <a href="{{ route('admin.soft.delete', $comment->id) }}" class="btn btn-sm btn-info  btn-danger"><i
                        class="fa fa-trash" aria-hidden="true"></i></a> --}} {{-- display delete btn --}}
                <a href="#"
                    onclick="showStuff('answer{{ $comment->id }}', 'text{{ $comment->id }}', this); return false;"
                    class="text-info">Reply
                </a>
            </div>
        @endif
        <div class="play-comment-box" id="answer{{ $comment->id }}" style="display: none">
            <form method="post" action="{{ route('admin.comments.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="comment_body" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Reply" />
                </div>
            </form>
        </div>
        @include('admin.post.commentsDisplay', ['comments' => $comment->replies])
        {{-- <span id="answer1" style="display: none;">
            <textarea rows="10" cols="115"></textarea>
        </span> --}}
        {{-- <span id="text1">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</span> --}}
    </div>
    <script>
        function showStuff(id, text, btn) {
            document.getElementById(id).style.display = 'block';
            // hide the lorem ipsum text
            document.getElementById(text).style.display = 'none';
            // hide the link
            btn.style.display = 'none';
        }
    </script>
@endforeach
