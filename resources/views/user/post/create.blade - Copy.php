@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('post/store') }}" enctype="multipart/form-data">
                @csrf


                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  @foreach($cat as $value)
                           <input class="form-check-input" name="cat_id" type="checkbox" value="{{ $value->id }}" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                   {{ $value->cat_name}}
                  </label>
                  @endforeach
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  @foreach($subcat as $value)
                           <input class="form-check-input" name="cat_id" type="checkbox" value="{{ $value->id }}" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                   {{ $value->sub_cat_name}}
                  </label>
                  @endforeach
                </div>
             
                <div class="mb-3">
                  <label for="title" class="form-label">Category</label>
                    <select class="custom-select" name="cat_id" id="inputGroupSelect01">
                      <option selected value="0">Choose...</option>
                        @foreach($cat as $value)
                          <option value="{{ $value->id }}">{{ $value->cat_name }}</option>
                        @endforeach
                    </select>
                </div>   

                <div class="mb-3">
                  <label for="title" class="form-label">Sub Category</label>
                    <select class="custom-select" name="subcat_id" id="inputGroupSelect01">
                      <option selected value="0">Choose...</option>
                        @foreach($subcat as $value)
                          <option value="{{ $value->id }}">{{ $value->sub_cat_name }}</option>
                        @endforeach
                    </select>
                </div>   
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" placeholder="post Title">
                </div>
                <div class="mb-3">
                  <label for="desc" class="form-label">Desc</label>
                  <textarea name="body" class="my-editor form-control" id="my-editor" cols="30" rows="10"></textarea>
                </div>
                <div class="row">
                 <div class="form-group col-md-4">
                         <input type="file" name="image" class="form-control">
                      </div>
                  </div>
            <!--     <div class="row">
                        <div class="col-md-4">
                        <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-success" style="margin-top:10px">Upload Image</button>
                        </div>
                        </div>
                      </div>  -->
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div> 
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
</script>
<script>
    CKEDITOR.replace('my-editor', options);
    </script>
@endsection

