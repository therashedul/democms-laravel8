 @php
     $langs[] = '';
 @endphp
 @foreach (config('app.multilocale') as $lang)
     @php
         $langs[] = $lang;
     @endphp
     <input type="text" name="{{ $name }}" class="{{ $class }}" id="mySelect_{{ $lang }}"
         onchange="myFunction_{{ $lang }}()" placeholder="" />
 @endforeach
