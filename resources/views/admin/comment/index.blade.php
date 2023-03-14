@extends('layouts.deshboard')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Comment List</h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <a href="{{ route('admin.comment.archive') }}" class="btn btn-sm btn-primary pull-right">Archive
                        comment</a>
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr>
                                <th class="column-title"> <input type="checkbox" id="checkAll"></th>
                                <th class="column-title" scope="col">post ID</th>
                                <th class="column-title text-center" scope="col">Comment</th>
                                <th class="column-title" scope="col">Author</th>
                                <th class="column-title" scope="col">Date</th>
                                <th class="column-title" scope="col">Status</th>
                                <th class="column-title text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cat = '';
                                $userName = '';
                            @endphp
                            <form method="post" action="{{ route('admin.post.multipledelete') }}">
                                {{ csrf_field() }}
                                <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete All" />
                                <br><br>
                                @foreach ($comment as $value)
                                    @php
                                        $postTitle = DB::table('posts')
                                            ->where('id', $value->post_id)
                                            ->get();
                                        // $userName = DB::table('users')
                                        //     ->where('id', $value->user_id)
                                        //     ->get();
                                    @endphp
                                    <tr>
                                        <td class="text-left">
                                            <input name='id[]' type="checkbox" id="checkAll"
                                                value="<?php echo $value->id; ?>">
                                        </td>
                                        <td>
                                            {{ $postTitle[0]->{'name_' . app()->getLocale()} }}
                                        </td>
                                        <td width="60%">{{ $value->comment_body }}</td>
                                        @php
                                            $usr = DB::table('users')
                                                ->where('id', $value->user_id)
                                                ->get();
                                        @endphp

                                        <td>
                                            {{-- {{ $value->user_id }} --}}
                                            @foreach ($usr as $val)
                                                {{ $val->name }}
                                            @endforeach
                                            {{ $value->commentname }}

                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($value->created_at)) }}

                                        </td>
                                        <td> {{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        {{-- <td width="480px" height="100px" style="overflow: hidden;">{!! $value->body !!}</td> --}}
                                        {{-- <td> <img src="{{ asset($value->image) }}" width="120px" height="100px"></td> --}}
                                        <td>
                                            @if ($value->status == 1)
                                                <a href="{{ route('admin.comments.publish', $value->id) }}"
                                                    class="btn btn-sm btn-info "><i class="fa fa-arrow-circle-up"
                                                        aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{ route('admin.comments.unpublish', $value->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fa fa-arrow-circle-down " aria-hidden="true"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('admin.comments.view', $value->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fa fa-eye" aria-hidden="true"></i></a>

                                            <a href="{{ route('admin.comments.distroy', $value->id) }}"
                                                class="btn btn-sm btn-info  btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                    {!! $comment->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
