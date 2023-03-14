     {{-- {{ $menus }} --}}
     <div class="col-md-3 left_col">
         <div class="left_col scroll-view">
             <div class="navbar nav_title" style="border: 0;">
                 @php
                     $values = DB::table('users')
                         ->where('role_id', Auth::user()->role_id)
                         ->first();
                     $rolepermissions = DB::table('role_has_permissions')
                         ->where('role_id', $values->role_id)
                         ->get();
                     $roleprms = [];
                     
                     foreach ($rolepermissions as $rolepermission) {
                         $permissions = DB::table('permissions')
                             ->where('id', '=', $rolepermission->permission_id)
                             ->get();
                         foreach ($permissions as $permission) {
                             $roleprms[] = $permission->name;
                         }
                     }
                     
                 @endphp
                 <a href="{{ asset($values->name) }}" class="site_title text-center d-block"><span>Dashaboard</span></a>
             </div>
             <div class="clearfix"></div>
             <br />
             <!-- sidebar menu -->
             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                 <div class="menu_section">
                     <ul class="nav side-menu">
                         <li> <a href="{{ url('/') }}" target="_blank" class="font-page"
                                 style="background: #ff1717;
                                    text-align: center;
                                    display: block;
                                    color: #fff;
                                    padding: 2% 0%">
                                 Display Fornt Page </a>
                         </li>
                         <li><a href="{{ url('/home') }}"> HOME </a> </li>
                         {{-- <li> <a href="{{ route($values->name . '.' . 'language') }}">Language</a></li> --}}
                         @foreach ($roleprms as $roleprm)
                             {{-- <li> {{ $roleprm }}</li> --}}
                             @php
                                 $name = $roleprm;
                                 $value = substr(strstr($name, '-'), 1);
                                 $role_id = Auth::user()->role_id;
                                 $nameRole = DB::table('roles')
                                     ->where('id', '=', $role_id)
                                     ->first();
                                 $role_name = $nameRole->name;
                                 //  print_r($role_name);
                                 //  print_r($value);
                                 //  die();
                             @endphp
                             @if ($value == 'media')
                                 <li> <a class="" href="{{ route($role_name . '.' . $value) }}"
                                         style="text-transform: uppercase;">{{ $value }}</a></li>
                             @elseif ($value == 'category')
                                 <li> <a class="" href="{{ route($role_name . '.' . $value) }}"
                                         style="text-transform: uppercase;">{{ $value }}</a></li>
                             @elseif ($value == 'post')
                                 <li> <a class="" href="{{ route($role_name . '.' . $value) }}"
                                         style="text-transform: uppercase;">{{ $value }}</a></li>
                             @elseif ($value == 'page')
                                 <li> <a class="" href="{{ route($role_name . '.' . $value) }}"
                                         style="text-transform: uppercase;">{{ $value }}</a></li>
                             @elseif ($value == 'comments')
                                 <li> <a class="" href="{{ route($role_name . '.' . $value) }}"
                                         style="text-transform: uppercase;">{{ $value }}</a></li>
                             @endif
                         @endforeach


                         {{-- <li> <a href="{{ route($values->name . '.' . 'media') }}">Media</a></li>
                         <li> <a href="{{ route($values->name . '.' . 'category') }}">category</a></li>
                         <li> <a href="{{ route($values->name . '.' . 'post') }}">Post</a></li>
                         <li> <a href="{{ route($values->name . '.' . 'page') }}">Page</a></li>
                         <li> <a href="{{ route($values->name . '.' . 'menus') }}">Menu</a></li>
                         <li> <a href="{{ route($values->name . '.' . 'comments') }}">Comment</a></li> --}}
                         {{-- <li> <a href="{{ route($values[0]->name . '.' . 'lang') }}">Lang</a></li> --}}
                         {{-- <li> <a href="{{ route($values[0]->name . '.' . 'artical') }}">Aartical</a> --}}
                         {{-- 
                         </li>
                         <li> <a href="{{ route($values->name . '.' . 'csv') }}">Upload Data</a></li>
                         <li> <a href="{{ route($values->name . '.' . 'slider') }}">Slider</a></li> --}}

                         <li><a>SETTING <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a>CONFIGAR<span class="fa fa-chevron-down"></span></a>
                                     <ul class="nav child_menu">
                                         @php
                                             $rhps = DB::table('role_has_permissions')->get();
                                             $permissions = DB::table('permissions')->get();
                                             $roles = DB::table('roles')->get();
                                         @endphp
                                         @foreach ($roles as $role)
                                             @foreach ($rhps as $rhp)
                                                 @foreach ($permissions as $permission)
                                                     @if ($role->id == Auth::user()->role_id && $role->id == $rhp->role_id)
                                                         @if ($rhp->permission_id == $permission->id)
                                                             @php
                                                                 $name = $permission->name;
                                                             @endphp
                                                             @if (stristr($name, 'menu'))
                                                                 @php
                                                                     $value = substr(strstr($name, '-'), 1);
                                                                     $role_id = Auth::user()->role_id;
                                                                     $nameRole = DB::table('roles')
                                                                         ->where('id', $role_id)
                                                                         ->get();
                                                                     $role_name = $nameRole[0]->name;
                                                                     //  print_r($role_name);
                                                                     //  print_r($value);
                                                                 @endphp
                                                                 <li>
                                                                     @if ($value == 'users')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'roles')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'permissions')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'white')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'black')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'menus')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'csv')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'slider')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'loginhistory')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'language')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @elseif ($value == 'databasebackup')
                                                                         <a class=""
                                                                             href="{{ route($role_name . '.' . $value) }}"
                                                                             style="text-transform: uppercase;">{{ $value }}</a>
                                                                     @else
                                                                     @endif
                                                                 </li>
                                                             @endif
                                                         @endif
                                                     @endif
                                                 @endforeach
                                             @endforeach
                                         @endforeach
                                     </ul>
                                 </li>
                             </ul>
                         </li>
                     </ul>
                     {{-- language change --}}

                     <div class="lang-change text-white mt-2">
                         <label>Language Chagne : </label>
                         @foreach (config('app.multilocale') as $lang)
                             <a class="pl-2 pt-2 pb-2 text-white @if (app()->getLocale() == $lang) border-bottom @endif"
                                 href="{{ request()->url() }}?language={{ $lang }}">
                                 {{ $lang == 'en' ? 'Enlish' : 'Bangla' }}
                             </a>
                         @endforeach
                         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                         <script type="text/javascript">
                             var url = "{{ request()->url() }}";
                             $('.lang-change').change(function() {
                                 let lang_code = $(this).val();
                                 window.location.href = url + "?language=" + lang_code;
                             });
                         </script>
                     </div>
                 </div>
             </div>
             <!-- /sidebar menu -->

             <!-- /menu footer buttons -->
             <div class="sidebar-footer hidden-small">
                 <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                     style="width:100%;">
                     <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </div>
             <!-- /menu footer buttons -->
         </div>
     </div>
