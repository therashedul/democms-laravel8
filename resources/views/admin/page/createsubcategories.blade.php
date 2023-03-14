   @foreach ($category as $cats)
   
        <input class="form-check-input child-to-child" name="subcat_id[]" type="checkbox" value="{{ $cats->id }}" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            {{ $cats->name}}
        </label>

   @endforeach




