<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <h5>(Header Menu)</h5>
    <a class="navbar-brand" href="#">Brand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">home</a></li>
             @foreach ($topNavItems3 as $nav)
                @if (!empty($nav->children[0]))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            @if ($nav->name == null)
                                {{ $nav->title }}
                            @else
                                {{ $nav->name }}
                            @endif
                        </a>
                        <ul class="dropdown-menu">

                            @foreach ($nav->children[0] as $child)
                                <li>
                                    @if ($child->type == 'category')
                                        <a class="dropdown-item" href="{{ $child->slug }}"
                                            target="{{ $child->target }}">
                                            @if ($child->name == null)
                                                {{ $child->title }}
                                            @else
                                                {{ $child->name }}
                                            @endif
                                        </a>
                                    @elseif ($child->type == 'page')
                                        <a class="dropdown-item" href="{{ route('pages', $child->slug) }}">
                                            @if ($child->name == null)
                                                {{ $child->title }}
                                            @else
                                                {{ $child->name }}
                                            @endif
                                        </a>
                                    @elseif ($child->type == 'post')
                                        <a class="dropdown-item" href="{{ $child->slug }}"
                                            target="{{ $child->target }}">
                                            @if ($child->name == null)
                                                {{ $child->title }}
                                            @else
                                                {{ $child->name }}
                                            @endif
                                        </a>
                                    @elseif ($child->type == 'custom')
                                        <a class="dropdown-item" href="{{ $child->slug }}"
                                            target="{{ $child->target }}">
                                            @if ($child->name == null)
                                                {{ $child->title }}
                                            @else
                                                {{ $child->name }}
                                            @endif
                                        </a>
                                    @endif
                                    {{-- ======================== --}}
                                    @if (isset($child->children))
                                        @foreach ($child->children as $value)
                                            <ul class="submenu dropdown-menu">
                                                @foreach ($value as $val)
                                                    <li>
                                                        @if ($val->type == 'category')
                                                            <a class="dropdown-item" href="{{ $val->slug }}"
                                                                target="{{ $val->target }}">
                                                                @if ($val->name == null)
                                                                    {{ $val->title }}
                                                                @else
                                                                    {{ $val->name }}
                                                                @endif
                                                            </a>
                                                        @elseif ($val->type == 'page')
                                                            <a class="dropdown-item" href="{{ $val->slug }}"
                                                                target="{{ $val->target }}">
                                                                @if ($val->name == null)
                                                                    {{ $val->title }}
                                                                @else
                                                                    {{ $val->name }}
                                                                @endif
                                                            </a>
                                                        @elseif ($val->type == 'post')
                                                            <a class="dropdown-item" href="{{ $val->slug }}"
                                                                target="{{ $val->target }}">
                                                                @if ($val->name == null)
                                                                    {{ $val->title }}
                                                                @else
                                                                    {{ $val->name }}
                                                                @endif
                                                            </a>
                                                        @elseif ($val->type == 'custom')
                                                            <a class="dropdown-item" href="{{ $val->slug }}"
                                                                target="{{ $val->target }}">
                                                                @if ($val->name == null)
                                                                    {{ $val->title }}
                                                                @else
                                                                    {{ $val->name }}
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
                        <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}"
                                target="{{ $nav->target }}">
                                @if ($nav->name == null)
                                    {{ $nav->title }}
                                @else
                                    {{ $nav->name }}
                                @endif
                            </a>
                        </li>
                    @elseif ($nav->type == 'page')
                        {{-- {{ route('page/unpublish', $value->id) }} --}}
                        <li class="nav-item">
                            <a class="nav-link" href=" {{ route('pages', $nav->slug) }}"
                                target="{{ $nav->target }}">
                                @if ($nav->name == null)
                                    {{ $nav->title }}
                                @else
                                    {{ $nav->name }}
                                @endif
                            </a>
                        </li>
                    @elseif ($nav->type == 'post')
                        <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}"
                                target="{{ $nav->target }}">
                                @if ($nav->name == null)
                                    {{ $nav->title }}
                                @else
                                    {{ $nav->name }}
                                @endif
                            </a>
                        </li>
                    @elseif ($nav->type == 'custom')
                        <li class="nav-item"><a class="nav-link" href="{{ $nav->slug }}"
                                target="{{ $nav->target }}">
                                @if ($nav->name == null)
                                    {{ $nav->title }}
                                @else
                                    {{ $nav->name }}
                                @endif
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach


        </ul>



    </div> <!-- navbar-collapse.// -->

</nav>
