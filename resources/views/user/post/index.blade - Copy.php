@extends('layouts.deshboard')

@section('content')
    <a class="btn btn-primary mb-2 ml-2" href="{{ url('post/create') }}">Add post</a>
    <input type="text" class="form-controller" id="search" name="search" placeholder="Search"></input>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th class="text-center"> <input type="checkbox" id="checkAll"> Select All</th>
                <th scope="col">title</th>
                <th scope="col">Detail</th>
                <th scope="col">images</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <form method="post" action="{{ url('post/multipledelete') }}">
                {{ csrf_field() }}
                <br>
                <input class="btn btn-success" type="submit" name="submit" value="Delete All Users" />
                <br><br>
                @php
                    $sl = 1;
                @endphp
                @foreach ($data as $value)
                    <tr>
                        <th scope="row">{{ $sl }}</th>
                        <td class="text-center">
                            <input name='id[]' type="checkbox" id="checkAll" value="<?php echo $value->id; ?>">
                        </td>
                        <td>{{ $value->title }}</td>
                        <td width="480px" height="100px" style="overflow: hidden;">{!! $value->body !!} </td>
                        <td> <img src="{{ asset($value->image) }}" width="120px" height="100px"></td>
                        <td>
                            <a href="{{ url('post/edit', $value->id) }}">Edit</a> /
                            <a href="{{ url('post/delete', $value->id) }}">Delete</a>
                        </td>
                    </tr>
                    @php $sl++; @endphp
                @endforeach

        </tbody>
        </form>
    </table>
    {!! $data->links() !!}
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
