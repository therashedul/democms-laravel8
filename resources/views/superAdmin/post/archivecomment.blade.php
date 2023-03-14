@extends('layouts.deshboard')


@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    @if (\Session::has('denger'))
        <div class="alert alert-denger">
            <p>{{ \Session::get('error') }}</p>
        </div>
    @endif
    <div class="col-md-12 col-sm-12  ">
        <div class="page-title">
            <div class="title_left">
                <h3>Soft delete comment</h3>
            </div>


        </div>

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
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr>
                                <th class="column-title"> <input type="checkbox" id="checkAll"></th>
                                <th class="column-title" scope="col">Comment</th>
                                <th class="column-title" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="post" action="{{ route('superAdmin.comment.multipledelete') }}">
                                {{ csrf_field() }}
                                <input class="btn btn-danger" type="submit" name="delete" value="Delete All" />
                                @foreach ($comment as $value)
                                    <tr>
                                        <td class="text-left">
                                            <input name='id[]' type="checkbox" id="checkAll"
                                                value="<?php echo $value->id; ?>">
                                        </td>
                                        <td>{{ $value->comment_body }}</td>


                                        {{-- <td width="480px" height="100px" style="overflow: hidden;">{!! $value->body !!}</td> --}}
                                        {{-- <td> <img src="{{ asset($value->image) }}" width="120px" height="100px"></td> --}}
                                        <td>

                                            <a href="{{ route('superAdmin.comment.return', $value->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-folder-minus"></i>
                                                Recover</a>
                                            <a href="{{ route('superAdmin.comment.delete', $value->id) }}"
                                                class="btn btn-sm btn-info  btn-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                    {{-- {!! $comment->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script language="javascript">
        // Multy Data delete
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        // Ajex search 
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('post/search') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('table').html(data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection
