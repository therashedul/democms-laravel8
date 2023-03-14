<ul class="footer-links list-unstyled">


    @foreach ($topNavItems2 as $nav)
        @if (!empty($nav->children[0]))
            <li><a href="{{ $nav->{'slug_' . app()->getLocale()} }}" target="{{ $nav->target }}">
                    <i class="bi bi-chevron-right"></i>
                    @if ($nav->{'name_' . app()->getLocale()} == null)
                        {{ $nav->{'title_' . app()->getLocale()} }}
                    @else
                        {{ $nav->{'name_' . app()->getLocale()} }}
                    @endif
                </a>
            </li>
        @else
            @if ($nav->type == 'category')
                <li><a class="nav-link" href="{{ $nav->{'slug_' . app()->getLocale()} }}" target="{{ $nav->target }}">
                        <i class="bi bi-chevron-right"></i>
                        @if ($nav->{'name_' . app()->getLocale()} == null)
                            {{ $nav->{'title_' . app()->getLocale()} }}
                        @else
                            {{ $nav->{'name_' . app()->getLocale()} }}
                        @endif
                    </a>
                </li>
            @elseif ($nav->type == 'page')
                {{-- {{ route('page/unpublish', $value->id) }} --}}
                <li>
                    <a class="nav-link" href=" {{ route('pages', $nav->{'slug_' . app()->getLocale()}) }}"
                        target="{{ $nav->target }}">
                        <i class="bi bi-chevron-right"></i>
                        @if ($nav->{'name_' . app()->getLocale()} == null)
                            {{ $nav->{'title_' . app()->getLocale()} }}
                        @else
                            {{ $nav->{'name_' . app()->getLocale()} }}
                        @endif
                    </a>
                </li>
            @elseif ($nav->type == 'post')
                <li><a class="nav-link" href="{{ $nav->{'slug_' . app()->getLocale()} }}"
                        target="{{ $nav->target }}">
                        <i class="bi bi-chevron-right"></i>
                        @if ($nav->{'name_' . app()->getLocale()} == null)
                            {{ $nav->{'title_' . app()->getLocale()} }}
                        @else
                            {{ $nav->{'name_' . app()->getLocale()} }}
                        @endif
                    </a>
                </li>
            @elseif ($nav->type == 'custom')
                <li><a class="nav-link" href="{{ $nav->{'slug_' . app()->getLocale()} }}"
                        target="{{ $nav->target }}">
                        <i class="bi bi-chevron-right"></i>
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
</ul>
