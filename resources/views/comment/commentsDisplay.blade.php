@php
    // print_r($post_id);
    // die();
@endphp
@foreach ($comments as $comment)
    @if ($comment->status == '1')
        <div class="display-comment" @if ($comment->parent_id != null) style="margin-left:40px;" @endif>
            @php
                $usr = DB::table('users')
                    ->where('id', $comment->user_id)
                    ->get();
                
                // print_r($usr);
                
            @endphp
            {{-- <strong> {{ optional($comment->user)->name }}</strong> --}}
            @foreach ($usr as $value)
                <strong> {{ $value->name }}</strong>
            @endforeach
            <strong> {{ $comment->commentname }}</strong>
            @php
                $diffInDays = \Carbon\Carbon::parse($comment->created_at)->diffInDays();
                $showDiff = \Carbon\Carbon::parse($comment->created_at)->diffForHumans();
                $showHour = \Carbon\Carbon::parse($comment->created_at)->diffInHours();
                $monthdate = \Carbon\Carbon::parse($comment->created_at)->addMinute(5);
                $dateDiff = \Carbon\Carbon::now()->diffInMinutes($monthdate, true);
                
            @endphp
            @if ($diffInDays > 0)
                @php
                    $showDiff .=
                        'Day' .
                        \Carbon\Carbon::parse($comment->created_at)
                            ->addDays($diffInDays)
                            ->diffInHours() .
                        ' Hours' .
                        $dateDiff .
                        ' Secund';
                @endphp
            @endif


            @php
                // print_r($this->info($dateDiff));
            @endphp


            <span class="text-muted">{{ date('d-M-Y', strtotime($comment->created_at)) }}</span>
            @if ($comment->parent_id != null)
                <div class="has-parent-panel" style="margin-bottom: 20px; border-bottom: #ccc solid 1px; padding: 5px 0;">
                    <p style="margin-bottom: 5px">{{ $comment->comment_body }}</p>
                    <span id="text{{ $comment->id }}"></span>
                    <a href="" id="reply"></a>
                    {{-- <a href="{{ route('soft.delete', $comment->id) }}" class="btn btn-sm btn-info  btn-danger"><i
                        class="fa fa-trash" aria-hidden="true"></i></a> --}} {{-- display delete btn --}}
                    <a href="#"
                        onclick="showStuff('answer{{ $comment->id }}', 'text{{ $comment->id }}', this); return false;"
                        class="text-info">Reply</a>
                </div>
            @else
                <div class="has-parent-panel"
                    style="margin-bottom: 20px; border-bottom: #ccc solid 1px; padding: 5px 0;">
                    <p style="margin-bottom: 5px">{{ $comment->comment_body }}</p>
                    <span id="text{{ $comment->id }}"></span>
                    <a href="" id="reply"></a>
                    {{-- <a href="{{ route('soft.delete', $comment->id) }}" class="btn btn-sm btn-info  btn-danger"><i
                        class="fa fa-trash" aria-hidden="true"></i></a> --}} {{-- display delete btn --}}
                    <a href="#"
                        onclick="showStuff('answer{{ $comment->id }}', 'text{{ $comment->id }}', this); return false;"
                        class="text-info">Reply
                    </a>
                </div>
            @endif
            <div class="play-comment-box" id="answer{{ $comment->id }}" style="display: none">
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf
                    @if (Route::has('login'))
                        @auth
                            <div class="col-lg-12 mb-1 ">
                                <div class="form-group">
                                    <input type="text" name="comment_body" class="form-control"
                                        placeholder="Type message" />
                                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12 mb-1">
                                <input type="text" name="commentname" class="form-control" id="comment-name"
                                    placeholder="Enter your name">
                            </div>
                            <div class="col-lg-12 mb-1 ">
                                <input type="text" name="commentemail" class="form-control" id="comment-email"
                                    placeholder="Enter your email">
                            </div>
                            <div class="col-lg-12 mb-1 ">
                                <div class="form-group">
                                    <input type="text" name="comment_body" class="form-control"
                                        placeholder="Type message" />
                                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                </div>
                            </div>
                        @endauth
                    @endif
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="Reply" />
                    </div>
                </form>
            </div>
            @include('comment.commentsDisplay', ['comments' => $comment->replies])
            {{-- <span id="answer1" style="display: none;">
            <textarea rows="10" cols="115"></textarea>
        </span> --}}
            {{-- <span id="text1">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</span> --}}
        </div>
    @endif
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
