    @extends('layouts.blog')
    @section('title', $page->{'name_' . app()->getLocale()})
    @section('slug', $page->{'slug_' . app()->getLocale()})
    @section('name', 'page.single')
    @section('publish', $page->created_at)
    @php        $image = asset('images/' . $page->image);    @endphp
    @section('image', $image)
    @section('id', $page->id)
    @php
        $limited = $page->{'content_' . app()->getLocale()};
        $contents = substr($limited, 0, 200);
        $keywords = substr($limited, 0, 150);
        $keyword = explode(' ', $keywords);
        $content = implode(', ', (array) $keyword);
        // print_r($content);
    @endphp
    @section('description', $page->{'name_' . app()->getLocale()} . $contents)
    @section('keywords', $page->{'name_' . app()->getLocale()} . $content)

    @section('content')
        @php
            if (Auth::check()) {
                $email = Auth::user()->email;
            }
            $privatepage = DB::table('pages')
                ->where('id', '=', $page->id)
                ->first();
            
        @endphp
        @if (!empty($email))
            @if (($email == 'superadmin@gmail.com' && $privatepage->privatepage == '1') || $privatepage->privatepage == '0')
                @if ($page->template == 1 || $page->template == 2)
                    <x-forntend.pages.fullwidthpage :page="$page" />
                @else
                    <x-forntend.pages.sidebarpage :page="$page" />
                @endif
            @endif
        @elseif($privatepage->privatepage == '0')
            @if ($page->template == 1 || $page->template == 2)
                <x-forntend.pages.fullwidthpage :page="$page" />
            @else
                <x-forntend.pages.sidebarpage :page="$page" />
            @endif
        @else
            <!-- Modal -->
            <div class="modal fade" id="myModalpage" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <h3>Display for only Admin</h3>
                        </div>
                    </div>
                </div>
            </div>
            <script type='text/javascript'>
                $(window).on('load', function() {
                    var delayMs = 100; // delay in milliseconds

                    setTimeout(function() {
                        $('#myModalpage').modal('show');
                    }, delayMs);

                    // Set a timeout to hide the element again
                    setTimeout(function() {
                        $('#myModalpage').modal('hide');
                        window.location = "{{ url('/') }}"

                    }, 1500);

                });
            </script>
        @endif
    @endsection
