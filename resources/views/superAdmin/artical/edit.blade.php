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
                {!! Form::model($cat, [
                    'route' => ['superAdmin.artical.update', $cat->id],
                    'method' => 'PATCH',
                    'enctype' => 'multipart/form-data',
                    'id' => 'upload',
                ]) !!}
                @foreach (config('app.multilocale') as $lang)
                    <div class="lang_{{ $lang }}">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Artical
                                Name
                                {{ $lang }}
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="title_{{ $lang }}"
                                    value="{{ $cat->{'title_' . $lang} }}" class="form-control"
                                    placeholder="Artical name" />

                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Detial
                                {{ $lang }}
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="detial_{{ $lang }}"
                                    value="{{ $cat->{'detial_' . $lang} }}" class="form-control" placeholder="Detail">
                            </div>
                        </div>
                    </div>
                @endforeach


                <button type=" submit" class="btn btn-primary pull-right" id="submit-all">Update</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
