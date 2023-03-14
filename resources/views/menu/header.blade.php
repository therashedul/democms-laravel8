                <nav id="navbar" class="navbar">
                    <ul>
                        <li class="nav-item"><a href="{{ url('/') }}"><i class="fas fa-home"
                                    style="font-size:1.2rem !important; padding: 14px 15px 10px 8px; text-align:center;"></i></a>
                        </li>
                        @foreach ($topNavItems as $nav)
                            @if (!empty($nav->children[0]))
                                <li class="dropdown">
                                    <a
                                        href="  
                                @if ($nav->type == 'category') {{ route('category.single', ['slug' => $nav->{'slug_' . app()->getLocale()}]) }} @endif
                                @if ($nav->type == 'page') @php
                                                $pageid = DB::table('pages')
                                                    ->where('slug_' . app()->getLocale(), $nav->{'slug_' . app()->getLocale()})
                                                    ->first();
                                            @endphp
                                {{ route('page.single', ['slug' => $nav->{'slug_' . app()->getLocale()}, 'id' => $pageid->id]) }} @endif
                                @if ($nav->type == 'post') @php
                                $postid = DB::table('posts')
                                    ->where('slug_' . app()->getLocale(), $nav->{'slug_' . app()->getLocale()})
                                    ->first();
                            @endphp                          
                                {{ route('post.single', ['slug' => $nav->{'slug_' . app()->getLocale()}, 'id' => $postid->id]) }} @endif
                                
                                @if ($nav->type == 'cusotm') {{ $nav->slug }} @endif "><span>
                                            @if ($nav->{'name_' . app()->getLocale()} == null)
                                                {{ $nav->{'title_' . app()->getLocale()} }}
                                            @else
                                                {{ $nav->{'name_' . app()->getLocale()} }}
                                            @endif
                                        </span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul class="dropdown-menu">
                                        @foreach ($nav->children[0] as $child)
                                            <li @if (isset($child->children)) class="dropdown" @else @endif>
                                                @if ($child->type == 'category')
                                                    <a
                                                        href="{{ route('category.single', ['slug' => $child->{'slug_' . app()->getLocale()}]) }}"><span>
                                                            @if ($child->{'name_' . app()->getLocale()} == null)
                                                                {{ $child->{'title_' . app()->getLocale()} }}
                                                            @else
                                                                {{ $child->{'name_' . app()->getLocale()} }}
                                                            @endif
                                                        </span>
                                                        @if (isset($child->children))
                                                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                                                        @else
                                                        @endif
                                                    </a>
                                                @elseif ($child->type == 'page')
                                                    @php
                                                        $pageid = DB::table('pages')
                                                            ->where('slug_' . app()->getLocale(), $child->{'slug_' . app()->getLocale()})
                                                            ->first();
                                                    @endphp
                                                    <a
                                                        href="{{ route('page.single', ['slug' => $child->{'slug_' . app()->getLocale()}, 'id' => $pageid->id]) }}"><span>
                                                            @if ($child->{'name_' . app()->getLocale()} == null)
                                                                {{ $child->{'title_' . app()->getLocale()} }}
                                                            @else
                                                                {{ $child->{'name_' . app()->getLocale()} }}
                                                            @endif
                                                        </span>
                                                        @if (isset($child->children))
                                                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                                                        @else
                                                        @endif
                                                    </a>
                                                @elseif ($child->type == 'post')
                                                    @php
                                                        $postid = DB::table('posts')
                                                            ->where('slug_' . app()->getLocale(), $child->{'slug_' . app()->getLocale()})
                                                            ->first();
                                                    @endphp
                                                    <a
                                                        href="{{ route('post.single', ['slug' => $child->{'slug_' . app()->getLocale()}, 'id' => $postid->id]) }}"><span>
                                                            @if ($child->{'name_' . app()->getLocale()} == null)
                                                                {{ $child->{'title_' . app()->getLocale()} }}
                                                            @else
                                                                {{ $child->{'name_' . app()->getLocale()} }}
                                                            @endif
                                                        </span>
                                                        @if (isset($child->children))
                                                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                                                        @else
                                                        @endif

                                                    </a>
                                                @elseif ($child->type == 'custom')
                                                    <a href="{{ $child->{'slug_' . app()->getLocale()} }}"><span>
                                                            @if ($child->{'name_' . app()->getLocale()} == null)
                                                                {{ $child->{'title_' . app()->getLocale()} }}
                                                            @else
                                                                {{ $child->{'name_' . app()->getLocale()} }}
                                                            @endif
                                                        </span>
                                                        <i class="bi bi-chevron-down dropdown-indicator"></i>
                                                    </a>
                                                @endif

                                                {{-- ======================== --}}
                                                @if (isset($child->children))
                                                    @foreach ($child->children as $value)
                                                        <ul class="submenu dropdown-menu">
                                                            @foreach ($value as $val)
                                                                <li>
                                                                    @if ($val->type == 'category')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('category.single', ['slug' => $val->{'slug_' . app()->getLocale()}]) }}"
                                                                            target="{{ $val->target }}">
                                                                            @if ($val->{'name_' . app()->getLocale()} == null)
                                                                                {{ $val->{'title_' . app()->getLocale()} }}
                                                                            @else
                                                                                {{ $val->{'name_' . app()->getLocale()} }}
                                                                            @endif
                                                                        </a>
                                                                    @elseif ($val->type == 'page')
                                                                        @php
                                                                            $pageid = DB::table('pages')
                                                                                ->where('slug_' . app()->getLocale(), $val->{'slug_' . app()->getLocale()})
                                                                                ->first();
                                                                        @endphp
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('page.single', ['slug' => $val->{'slug_' . app()->getLocale()}, 'id' => $pageid->id]) }}"
                                                                            target="{{ $val->target }}">
                                                                            @if ($val->{'name_' . app()->getLocale()} == null)
                                                                                {{ $val->{'title_' . app()->getLocale()} }}
                                                                            @else
                                                                                {{ $val->{'name_' . app()->getLocale()} }}
                                                                            @endif
                                                                        </a>
                                                                    @elseif ($val->type == 'post')
                                                                        @php
                                                                            $postid = DB::table('posts')
                                                                                ->where('slug_' . app()->getLocale(), $child->{'slug_' . app()->getLocale()})
                                                                                ->first();
                                                                            
                                                                        @endphp
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('post.single', ['slug' => $val->{'slug_' . app()->getLocale()}, 'id' => $postid->id]) }}"
                                                                            target="{{ $val->target }}">
                                                                            @if ($val->{'name_' . app()->getLocale()} == null)
                                                                                {{ $val->{'title_' . app()->getLocale()} }}
                                                                            @else
                                                                                {{ $val->{'name_' . app()->getLocale()} }}
                                                                            @endif
                                                                        </a>
                                                                    @elseif ($val->type == 'custom')
                                                                        <a class="dropdown-item"
                                                                            href="{{ $val->{'slug_' . app()->getLocale()} }}"
                                                                            target="{{ $val->target }}">
                                                                            @if ($val->{'name_' . app()->getLocale()} == null)
                                                                                {{ $val->{'title_' . app()->getLocale()} }}
                                                                            @else
                                                                                {{ $val->{'name_' . app()->getLocale()} }}
                                                                            @endif
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endforeach
                                                @endif
                                                {{-- ========================= --}}
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @else
                                @if ($nav->type == 'category')
                                    <li class="nav-item">
                                        <a href="{{ route('category.single', ['slug' => $nav->{'slug_' . app()->getLocale()}]) }}"
                                            target="{{ $nav->target }}">
                                            @if ($nav->{'name_' . app()->getLocale()} == null)
                                                {{ $nav->{'title_' . app()->getLocale()} }}
                                            @else
                                                {{ $nav->{'name_' . app()->getLocale()} }}
                                            @endif
                                        </a>
                                    </li>
                                @elseif ($nav->type == 'page')
                                    @php
                                        $pageid = DB::table('pages')
                                            ->where('slug_' . app()->getLocale(), $nav->{'slug_' . app()->getLocale()})
                                            ->first();
                                        // print_r($nav->{'slug_' . app()->getLocale()});
                                        // die();
                                    @endphp
                                    <li class="nav-item">
                                        <a href=" {{ route('page.single', ['slug' => $nav->{'slug_' . app()->getLocale()}, 'id' => $pageid->id]) }}"
                                            target="{{ $nav->target }}">
                                            @if ($nav->{'name_' . app()->getLocale()} == null)
                                                {{ $nav->{'title_' . app()->getLocale()} }}
                                            @else
                                                {{ $nav->{'name_' . app()->getLocale()} }}
                                            @endif
                                        </a>
                                    </li>
                                @elseif ($nav->type == 'post')
                                    @php
                                        $postid = DB::table('posts')
                                            ->where('slug_' . app()->getLocale(), $nav->{'slug_' . app()->getLocale()})
                                            ->first();
                                        // print_r($postid->id);
                                    @endphp
                                    <li class="nav-item"><a
                                            href=" {{ route('post.single', ['slug' => $nav->{'slug_' . app()->getLocale()}, 'id' => $postid->id]) }}"
                                            target="{{ $nav->target }}">
                                            @if ($nav->{'name_' . app()->getLocale()} == null)
                                                {{ $nav->{'title_' . app()->getLocale()} }}
                                            @else
                                                {{ $nav->{'name_' . app()->getLocale()} }}
                                            @endif
                                        </a>
                                    </li>
                                @elseif ($nav->type == 'custom')
                                    <li class="nav-item"><a href="{{ $nav->{'slug_' . app()->getLocale()} }}"
                                            target="{{ $nav->target }}">
                                            @if ($nav->{'name_' . app()->getLocale()} == null)
                                                {{ $nav->{'title_' . app()->getLocale()} }}
                                            @else
                                                {{ $nav->{'name_' . app()->getLocale()} }}
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endif

                        @endforeach
                </nav><!-- .navbar -->
