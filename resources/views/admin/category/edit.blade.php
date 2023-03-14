@extends('layouts.deshboard')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::model($cat, [
                        'route' => ['admin.category.update', $cat->id],
                        'method' => 'PATCH',
                        'enctype' => 'multipart/form-data',
                        'id' => 'upload',
                    ]) !!}
                    @php
                        $id = $cat->id;
                    @endphp
                    <x-forms.admin.category.catedit :id="$id" :categories="$categories" />
                    <button type=" submit" class="btn btn-primary pull-right" id="submit-all">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <x-forms.admin.category.cateditmodal :id="$id" />
@endsection
