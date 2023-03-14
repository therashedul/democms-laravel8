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
                <h2>Page Archive List</h2>

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
                    {{-- <a href="{{ route('admin.page.archive') }}" class="btn btn-sm btn-info pull-right">Archive
                        page</a> --}}
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr>
                                {{-- <th class="column-title"> <input type="checkbox" id="checkAll"></th> --}}
                                <th class="column-title" scope="col">Title</th>
                                <th class="column-title" scope="col">Date</th>
                                <th class="column-title" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="post" action="{{ route('admin.page.archivemultipledelete') }}">
                                {{ csrf_field() }}
                                {{-- <input class="btn btn-danger" type="submit" name="submit" value="Delete All" /> --}}
                                <br><br>
                                @foreach ($pages as $value)
                                    <tr>
                                        <td>{{ $value->{'name_' . app()->getLocale()} }}</td>
                                        <td> {{ $value->publish_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.page.archivereturn', $value->id) }}"
                                                class="btn btn-sm btn-success"><i class="fas fa-window-restore"></i></a>
                                            <a href="{{ route('admin.page.archivedistroy', $value->id) }}"
                                                class="btn btn-sm btn-info  btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                    {!! $pages->links() !!}
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
                url: '{{ URL::to('page/search') }}',
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
