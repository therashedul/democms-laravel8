<div class="col-md-12 col-sm-12  ">
    <div class="page-title">
        <div class="title_left">
            <h3>Post Manage</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                <div class="input-group">
                    {{-- <a class="btn btn-primary mb-2 ml-2" href="{{ route('superAdmin.post.create') }}">
                        Add New Post
                    </a> --}}
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
                                @if ($pvalue->name == 'post-create')
                                    <span class="float-right">
                                        <a class="btn btn-primary btn-sm" href="{{ route('superAdmin.post.create') }}"><i
                                                class="fas fa-plus"></i> Add New Post</a>
                                    </span>
                                @endif
                                @if ($pvalue->name == 'post-search')
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
            <h2>Post List</h2>
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
                @foreach ($rhps as $rhpsvalue)
                    @php
                        $permissionId = $rhpsvalue->permission_id;
                    @endphp

                    @foreach ($permissions as $pvalue)
                        @php
                            $pid = $pvalue->id;
                        @endphp
                        @if ($permissionId == $pid)
                            @if ($pvalue->name == 'post-archive')
                                <span class="float-right">
                                    <a href="{{ route('superAdmin.post.archive') }}"
                                        class="btn btn-sm btn-info pull-right">Archive
                                        Post</a>
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
                            <th class="column-title" scope="col">Categories</th>
                            <th class="column-title" scope="col">Date</th>
                            <th class="column-title" scope="col">Slider</th>
                            <th class="column-title" scope="col" style="text-align: center;">Action</th>
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
                        @foreach ($categories as $cvalue)
                            @php
                                
                                // {{ $cat->{'name_' . app()->getLocale()} }}
                                $cat = $cvalue->{'name_' . app()->getLocale()};
                                // print_r($cat);
                                // die();
                            @endphp
                        @endforeach
                        <form method="post" action="{{ route('superAdmin.post.multipledelete') }}">
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
                                        @if ($pvalue->name == 'post-multipledelete')
                                            <input class="btn btn-danger" type="submit" name="submit"
                                                value="Delete All" />
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            <br><br>
                            @foreach ($posts as $value)
                                <tr>
                                    <td class="text-left">
                                        <input name='id[]' type="checkbox" id="checkAll"
                                            value="<?php echo $value->id; ?>">
                                    </td>
                                    <td>{{ $value->{'name_' . app()->getLocale()} }}</td>
                                    <td>{{ $userName }}</td>
                                    <td>
                                        @php
                                            $metas = DB::table('postmetas')
                                                ->where('post_id', $value->id)
                                                ->get();
                                        @endphp
                                        @foreach ($metas as $meta)
                                            @php
                                                $cat = DB::table('categories')
                                                    ->where('id', $meta->cat_id)
                                                    ->get()
                                                    ->first();
                                                // $catname = explode(',', $cat->name);
                                                // $catas = implode(',', $cat->name);
                                                
                                                // print_r($cat->{'name_' . app()->getLocale()});
                                            @endphp
                                            <a
                                                href="{{ route('category.single', $cat->{'slug_' . app()->getLocale()}) }}">{{ $cat->{'name_' . app()->getLocale()} }}</a>
                                        @endforeach
                                    </td>

                                    <td> {{ $value->publish_at }}</td>
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
                                                    @if ($pvalue->name == 'post-slider')
                                                        {{ $value->slider == '1' ? 'Active' : '' }}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    {{-- <td width="480px" height="100px" style="overflow: hidden;">{!! $value->body !!}</td> --}}
                                    {{-- <td> <img src="{{ asset($value->image) }}" width="120px" height="100px"></td> --}}
                                    @php
                                        $rhps = DB::table('role_has_permissions')->get();
                                        $permissions = DB::table('permissions')->get();
                                        $roles = DB::table('roles')->get();
                                    @endphp
                                    <td>
                                        @foreach ($roles as $role)
                                            @foreach ($rhps as $rhp)
                                                @foreach ($permissions as $permission)
                                                    @if ($role->id == Auth::user()->role_id && $role->id == $rhp->role_id)
                                                        @if ($rhp->permission_id == $permission->id)
                                                            @php
                                                                $name = $permission->name;
                                                                // print_r($name);
                                                            @endphp
                                                            {{-- ============== --}}
                                                            @if (stristr($name, 'post'))
                                                                @php
                                                                    $valuename = substr(strstr($name, '-'), 1);
                                                                    // echo $value;
                                                                @endphp
                                                                @if ($valuename == 'show')
                                                                    <a class="btn btn-success btn-sm"
                                                                        href="{{ route('superAdmin.post.show', $value->id) }}"><i
                                                                            class="fas fa-eye"></i></a>
                                                                @elseif ($valuename == 'create')
                                                                    {{-- <a class="btn btn-primary"
                                                                    href="{{ route('superAdmin.post.create') }}">New
                                                                    value</a> --}}
                                                                @elseif ($valuename == 'active')
                                                                    @if ($value->status == 1)
                                                                        <a href="{{ route('superAdmin.post.publish', $value->id) }}"
                                                                            class="btn btn-info btn-sm"><i
                                                                                class="fa fa-arrow-circle-up"
                                                                                aria-hidden="true"></i></a>
                                                                    @else
                                                                        <a href="{{ route('superAdmin.post.unpublish', $value->id) }}"
                                                                            class="btn btn-info btn-warning btn-sm">
                                                                            <i class="fa fa-arrow-circle-down "
                                                                                aria-hidden="true"></i></a>
                                                                    @endif
                                                                @elseif ($valuename == 'edit')
                                                                    <a class="btn btn-primary btn-sm"
                                                                        href="{{ route('superAdmin.post.edit', $value->id) }}"><i
                                                                            class="fas fa-edit"></i></a>
                                                                @elseif ($valuename == 'delete')
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="{{ route('superAdmin.post.delete', $value->id) }}">
                                                                        <i class="fa fa-trash"></i></a>
                                                                    {{-- {!! Form::open([
                                                                        'method' => 'DELETE',
                                                                        'route' => ['superAdmin.post.destroy', $value->id],
                                                                        'style' => 'display:inline',
                                                                    ]) !!}
                                                                    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn btn-danger btn-sm']) }}
                                                                    {!! Form::close() !!} --}}
                                                                    {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                                                                @else
                                                                @endif
                                                            @endif

                                                            {{-- ================ --}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach

                                        {{-- @if ($value->status == 1)
                                            <a href="{{ route('superAdmin.post.publish', $value->id) }}"
                                                class="btn btn-sm btn-info "><i class="fa fa-arrow-circle-up"
                                                    aria-hidden="true"></i></a>
                                        @else
                                            <a href="{{ route('superAdmin.post.unpublish', $value->id) }}"
                                                class="btn btn-sm btn-info btn-warning">
                                                <i class="fa fa-arrow-circle-down " aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('superAdmin.post.show', $value->id) }}"
                                            class="btn btn-sm btn-success"><i class="fa fa-eye"
                                                aria-hidden="true"></i></a>

                                        <a href="{{ route('superAdmin.post.edit', $value->id) }}"
                                            class="btn btn-sm btn-primary"><i class="fa fa-pencil-square"
                                                aria-hidden="true"></i></a>
                                        <a href="{{ route('superAdmin.post.delete', $value->id) }}"
                                            class="btn btn-sm btn-info  btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
                {!! $posts->links() !!}
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

        // alert($value);

        $.ajax({
            type: 'get',
            url: "{{ route('superAdmin.post.search') }}",
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
