@extends('layouts.blog')
@section('title', $category[0]->{'name_' . app()->getLocale()})
@section('slug', $category[0]->{'slug_' . app()->getLocale()})
@section('name', 'category.single')
@section('publish', $category[0]->created_at)
@php    $image = asset('images/' . $category[0]->image); @endphp
@section('image', $image)
@php
    $limited = $category[0]->{'name_' . app()->getLocale()};
    $contents = substr($limited, 0, 200);
    $keywords = substr($limited, 0, 150);
    $keyword = explode(' ', $keywords);
    $content = implode(', ', (array) $keyword);
    // print_r($content);
@endphp
@section('description', $category[0]->{'name_' . app()->getLocale()} . ' ' . $contents)
@section('keywords', $category[0]->{'name_' . app()->getLocale()} . ',' . $content)


@section('content')
    @php
        if (Auth::check()) {
            $email = Auth::user()->email;
        }
        $privatecat = DB::table('categories')
            ->where('id', '=', $category[0]->id)
            ->first();
    @endphp

    @if (!empty($email))
        @if (($email == 'superadmin@gmail.com' && $privatecat->privatecat == '1') || $privatecat->privatecat == '0')
            <x-forntend.category.category :postmeta="$postmeta" :category="$category" :categoryies="$categoryies" />
        @endif
    @elseif($privatecat->privatecat == '0')
        <x-forntend.category.category :postmeta="$postmeta" :category="$category" :categoryies="$categoryies" />
    @else
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    $('#myModal').modal('show');
                }, delayMs);

                // Set a timeout to hide the element again
                setTimeout(function() {
                    $('#myModal').modal('hide');
                    window.location = "{{ url('/') }}"

                    // $('body').addClass('modal-open');
                }, 1500);

            });
        </script>
    @endif

@endsection
