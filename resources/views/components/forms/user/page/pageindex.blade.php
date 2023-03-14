<div class="col-md-12 col-sm-12  ">
    <div class="page-title">
        <div class="title_left">
            <h3>Page Manage</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                <div class="input-group">
                    @php
                        $role_id = Auth::user()->role_id;
                        $rhps = DB::table('role_has_permissions')
                            ->where('role_id', $role_id)
                            ->get();
                        $permissions = DB::table('permissions')->get();
                    @endphp

                    @foreach ($rhps as $rhpsvalue)
                        @php
                            $permissionId = $rhpsvalue->permission_id;
                        @endphp

                        @foreach ($permissions as $pvalue)
                            @php
                                $pid = $pvalue->id;
                            @endphp
                            @if ($permissionId == $pid)
                                @if ($pvalue->name == 'page-create')
                                    <a class="btn btn-primary mb-2 ml-2" href="{{ route('superAdmin.page.create') }}">Add
                                        New Page</a>
                                @endif
                                @if ($pvalue->name == 'page-search')
                                    <input type="text" class="form-controller form-control" id="search"
                                        name="search" placeholder="Search" />
                                @endif
                            @endif
                        @endforeach
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h2>Page List</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="clearfix"></div>
            <div class="table-responsive">
                @php
                    $role_id = Auth::user()->role_id;
                    $rhps = DB::table('role_has_permissions')
                        ->where('role_id', $role_id)
                        ->get();
                    $permissions = DB::table('permissions')->get();
                @endphp
                @foreach ($rhps as $rhpsvalue)
                    @php
                        $permissionId = $rhpsvalue->permission_id;
                    @endphp

                    @foreach ($permissions as $pvalue)
                        @php
                            $pid = $pvalue->id;
                        @endphp
                        @if ($permissionId == $pid)
                            @if ($pvalue->name == 'page-archive')
                                <span class="float-right">
                                    <a href="{{ route('superAdmin.page.archived') }}"
                                        class="btn btn-sm btn-info pull-right">Archive
                                        Page</a>
                                </span>
                            @endif
                        @endif
                    @endforeach
                @endforeach

                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                        <tr>
                            <th class="column-title"> <input type="checkbox" id="checkAll"></th>
                            <th class="column-title" scope="col">Title</th>
                            <th class="column-title" scope="col">Author</th>
                            <th class="column-title" scope="col">Date</th>
                            <th class="column-title" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cat = '';
                            $userName = '';
                        @endphp
                        @foreach ($userdata as $user)
                            @php
                                $userName = $user->name;
                            @endphp
                        @endforeach
                        <form method="post" action="{{ route('superAdmin.page.multipledelete') }}">
                            {{ csrf_field() }}
                            @foreach ($rhps as $rhpsvalue)
                                @php
                                    $permissionId = $rhpsvalue->permission_id;
                                @endphp

                                @foreach ($permissions as $pvalue)
                                    @php
                                        $pid = $pvalue->id;
                                    @endphp
                                    @if ($permissionId == $pid)
                                        @if ($pvalue->name == 'page-multipledelete')
                                            <input class="btn btn-danger" type="submit" name="submit"
                                                value="Delete All" />
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach

                            <br><br>
                            @foreach ($pages as $value)
                                <tr>
                                    <td class="text-left">
                                        <input name='id[]' type="checkbox" id="checkAll"
                                            value="<?php echo $value->id; ?>">
                                    </td>
                                    <td>{{ $value->{'name_' . app()->getLocale()} }}</td>
                                    <td>{{ $userName }}</td>
                                    {{-- <td> {{ $value->status == 1 ? 'Publish' : 'Unpublish' }}</td> --}}
                                    <td> {{ $value->publish_at }}</td>
                                    {{-- <td width="480px" height="100px" style="overflow: hidden;">{!! $value->body !!}</td> --}}
                                    {{-- <td> <img src="{{ asset($value->image) }}" width="120px" height="100px"></td> --}}
                                    <td>
                                        @foreach ($rhps as $rhpsvalue)
                                            @php
                                                $permissionId = $rhpsvalue->permission_id;
                                            @endphp

                                            @foreach ($permissions as $pvalue)
                                                @php
                                                    $pid = $pvalue->id;
                                                @endphp
                                                @if ($permissionId == $pid)
                                                    @if ($pvalue->name == 'page-active')
                                                        @if ($value->status == 1)
                                                            <a href="{{ route('superAdmin.page.publish', $value->id) }}"
                                                                class="btn btn-info btn-sm "><i
                                                                    class="fa fa-arrow-circle-up"
                                                                    aria-hidden="true"></i></a>
                                                        @else
                                                            <a href="{{ route('superAdmin.page.unpublish', $value->id) }}"
                                                                class="btn  btn-sm btn-warning">
                                                                <i class="fa fa-arrow-circle-down "
                                                                    aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                    @if ($pvalue->name == 'page-edit')
                                                        <a href="{{ route('superAdmin.page.edit', $value->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if ($pvalue->name == 'page-deleted')
                                                        <a href="{{ route('superAdmin.page.delete', $value->id) }}"
                                                            class="btn btn-sm   btn-danger"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
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
            url: "{{ route('superAdmin.page.search') }}",
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
