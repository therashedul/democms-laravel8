@extends('layouts.deshboard')

@section('content')
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
                <a class="btn btn-primary mb-2 ml-2" href="{{ route('superAdmin.artical.create') }}">Add Artical</a>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Artical Name</th>
                            <th scope="col">Artical Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($categories as $value)
                            {{-- {{ app()->getLocale() }} --}}
                            <tr>
                                <th scope="row">{{ $sl++ }}</th>
                                {{-- <td>{{ $value->title_en }}</td> --}}
                                <td>{{ $value->{'title_' . app()->getLocale()} }}</td>
                                <td>{{ $value->{'detial_' . app()->getLocale()} }}</td>
                                <td> <a href="{{ route('superAdmin.artical.edit', $value->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-pencil-square"
                                            aria-hidden="true"></i></a>
                                    <a href="{{ route('superAdmin.artical.deleted', $value->id) }}"
                                        class="btn btn-sm btn-info  btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                    <br>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
