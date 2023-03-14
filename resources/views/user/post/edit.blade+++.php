@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="{{ route('post/update') }}" method="post" enctype="multipart/form-data">
            @csrf
               <label style="font-weight: bold;">Post Update</label>
                  <input type="hidden" name="id" value="{{ $post->id }}">
                     @foreach($categories as $category)
                        @php
                            $checked = '';
                        @endphp
                        @foreach($postmeta as $meta)
                          @if($meta->cat_id == $category->id)
                            @php
                                $checked = 'checked = ""';
                            @endphp
                          @endif
                        @endforeach
                              <div class="form-check">
                                  <input class="form-check-input parent" name="subcat_id[]" type="checkbox" value="{{ $category->id }}" {{$checked}}>
                                  <p>{{ $category->name }}</p>
                              </div>       
                            @if (count($category->subcategory)>0)
                              @foreach ($category->subcategory as $sub)
                                @php
                                    $checked = '';
                                @endphp
                                @foreach($postmeta as $meta)
                                  @if($meta->cat_id == $sub->id)
                                    @php
                                        $checked = 'checked = ""';
                                    @endphp
                                  @endif
                                @endforeach
                                <div class="form-check">
                                  <input class="form-check-input child" style="margin-left: 7px;" name="subcat_id[]" type="checkbox" value="{{ $sub->id }}" {{$checked}}>
                                    <p class="child-child" style="margin-left: 30px">{{ $sub->name }}</p>
                                </div>
                              @endforeach
                            @endif
                      @endforeach
                  <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" name="title" class="form-control" value="{{ $post->title}}" placeholder="post Title">
                  </div>
                  <div class="mb-3">
                       <label for="desc" class="form-label">Desc</label>
                        <textarea name="body" class="my-editor form-control" id="my-editor" cols="30" rows="10">{!! $post->body !!}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="image" class="form-control">
                        <img src="{{asset($post->image) }}" width="80px" height="60px">
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
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
