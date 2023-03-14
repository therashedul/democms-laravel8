@extends('layouts.deshboard')
@section('content')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="POST" action="{{ route('supeAdmin.category.store') }}">
                        @csrf
                        <x-forms.category.catcreate :categories="$categories" />
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-5 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg " id="submit-all">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <x-forms.category.catcreatemodal />
@endsection
