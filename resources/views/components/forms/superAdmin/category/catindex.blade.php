    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Category List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="clearfix"></div>
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
                            @if ($pvalue->name == 'category-create')
                                <span class="float-right">
                                    <a class="btn btn-primary mb-2 ml-2"
                                        href="{{ route('superAdmin.category.create') }}">Add
                                        category</a>
                                </span>
                            @endif
                        @endif
                    @endforeach
                @endforeach


                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($categories as $value)
                            <tr>
                                <th scope="row">{{ $sl++ }}
                                </th>
                                <td>{{ $value->{'name_' . app()->getLocale()} }}
                                    &nbsp; &nbsp;

                                    @foreach ($rhps as $rhpsvalue)
                                        @php
                                            $permissionId = $rhpsvalue->permission_id;
                                        @endphp

                                        @foreach ($permissions as $pvalue)
                                            @php
                                                $pid = $pvalue->id;
                                            @endphp
                                            @if ($permissionId == $pid)
                                                @if ($pvalue->name == 'category-status')
                                                    <div class="pull-right">
                                                        @if ($value->status == 1)
                                                            <a style=""
                                                                href="{{ route('superAdmin.category.publish', $value->id) }}"
                                                                class="btn btn-sm btn-info "><i
                                                                    class="fa fa-arrow-circle-up"
                                                                    aria-hidden="true"></i></a>
                                                        @else
                                                            <a href="{{ route('superAdmin.category.unpublish', $value->id) }}"
                                                                class="btn btn-sm btn-warning ">
                                                                <i class="fa fa-arrow-circle-down "
                                                                    aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                                @if ($pvalue->name == 'category-edit')
                                                    <a href="{{ route('superAdmin.category.edit', $value->id) }}"
                                                        class="btn btn-sm btn-primary pull-right"><i
                                                            class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                                @endif
                                                @if ($pvalue->name == 'category-deleted')
                                                    <a href="{{ route('superAdmin.category.deleted', $value->id) }}"
                                                        class="btn btn-sm btn-info  btn-danger pull-right"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <br>
                                    @if (count($value->subcategory) > 0)
                                        <table class="table table-hover" style="margin-bottom: 0px">
                                            @foreach ($value->subcategory as $sub)
                                                <tr>
                                                    <td>
                                                        <span
                                                            style="margin-left: 25px;">{{ $sub->{'name_' . app()->getLocale()} }}</span>
                                                        @foreach ($rhps as $rhpsvalue)
                                                            @php
                                                                $permissionId = $rhpsvalue->permission_id;
                                                            @endphp
                                                            @foreach ($permissions as $pvalue)
                                                                @php
                                                                    $pid = $pvalue->id;
                                                                @endphp
                                                                @if ($permissionId == $pid)
                                                                    @if ($pvalue->name == 'category-status')
                                                                        <div class="pull-right">
                                                                            @if ($sub->status == 1)
                                                                                <a style=""
                                                                                    href="{{ route('superAdmin.category.publish', $sub->id) }}"
                                                                                    class="btn btn-sm btn-info "><i
                                                                                        class="fa fa-arrow-circle-up"
                                                                                        aria-hidden="true"></i></a>
                                                                            @else
                                                                                <a href="{{ route('superAdmin.category.unpublish', $sub->id) }}"
                                                                                    class="btn btn-sm btn-warning">
                                                                                    <i class="fa fa-arrow-circle-down "
                                                                                        aria-hidden="true"></i>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                    @if ($pvalue->name == 'category-edit')
                                                                        <a href="{{ route('superAdmin.category.edit', $sub->id) }}"
                                                                            class="btn btn-sm btn-primary  pull-right"><i
                                                                                class="fa fa-pencil-square"
                                                                                aria-hidden="true"></i></a>
                                                                    @endif
                                                                    @if ($pvalue->name == 'category-deleted')
                                                                        <a href="{{ route('superAdmin.category.deleted', $sub->id) }}"
                                                                            class="btn btn-sm btn-danger  pull-right"><i
                                                                                class="fa fa-trash"
                                                                                aria-hidden="true"></i></a>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                        <br>
                                                        @if (count($sub->subcategory) > 0)
                                                            @include('superAdmin.category.subcategories', [
                                                                'category' => $sub->subcategory,
                                                            ])
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
    {{-- @include('components.forms.superAdmin.category.catcreatemodal') --}}
