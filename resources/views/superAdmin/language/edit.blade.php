@extends('layouts.deshboard')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Language</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::model($lang, [
                        'route' => ['superAdmin.language.update', $lang->id],
                        'method' => 'PATCH',
                        'enctype' => 'multipart/form-data',
                        'id' => 'upload',
                    ]) !!}
                    @php
                        $id = $lang->id;
                    @endphp
                    <x-forms.superAdmin.language.langedit :id="$id" />
                    <button type=" submit" class="btn btn-primary pull-right" style="width: 100%;">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
