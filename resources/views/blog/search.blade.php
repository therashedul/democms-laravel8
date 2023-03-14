 <style>
     .search-panel {
         position: absolute;
         top: 100%;
         left: 0px;
         width: 100%;
         margin: 0 auto;
     }
 </style>
 <div class="search-panel">
     <table class="table table-hover table-bordered bg-info">
         <tbody>
             @foreach ($posts as $item)
                 <tr>
                     <td class="align-middle">
                         <a
                             href=" {{ route('post.single', ['slug' => $item->{'slug_' . app()->getLocale()}, 'id' => $item->id]) }}">
                             @if (!empty($item->image))
                                 <img src="{{ asset('thumbnail/' . $item->image) }}" width="50px" height="40px"
                                     alt="" title="">
                             @else
                                 <img src="{{ asset('img/profile/blank-img.jpg') }}" width="50px" height="40px"
                                     alt="" title="">
                             @endif
                         </a>
                     </td>
                     <td>
                         <a
                             href=" {{ route('post.single', ['slug' => $item->{'slug_' . app()->getLocale()}, 'id' => $item->id]) }}">{{ $item->{'name_' . app()->getLocale()} }}</a>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
