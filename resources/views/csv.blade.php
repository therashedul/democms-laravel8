@extends('layouts.deshboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                @if (\Session::has('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <h2>CSV Upload</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-10">
                            <form action="{{ route('csv.store') }}" accept=".csv" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-5">
                                    <input type="file" name="file" class="form-control" accept=".csv">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('csv.export') }}" class="btn btn-info">Download Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
