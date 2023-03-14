<!DOCTYPE html>


<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
{{-- <html lang="en"> --}}

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title> {{ env('SITE_URL', 'Myblog') }} - @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="7 days">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="author" content="@yield('title')">
    <meta name="url" content="{{ url('/') }}/@yield('name')/@yield('slug')/@yield('id')">
    <meta name="rating" content="General">
    <link rel="image_src" href=@yield('image')>
    <meta property='article:published_time' content="@yield('publish')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:url" content="{{ url('/') }}/@yield('name')/@yield('slug')/@yield('id')" />
    <meta property="og:locale" content="utf-8" />
    <meta property="og:locale:alternate" content="utf-8" />
    <meta property="og:site_name" content="{{ url('/') }}" />
    <meta property="og:image:url" content="@yield('image')" />

    <!-- Favicons -->
    <link href="{{ asset('blogassets/img/favicon.png') }} " rel="icon">
    <link href="blogassets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @include('asset.blogasset.header')
</head>

{{-- disable right button click --}}
{{-- <body oncontextmenu="return false;"> --}}

<body>
    <div class="bg-warning py-2">
        <div class="container-fluid container-xl ">
            <div class="row">
                <div class="col-md-4 col-sm-3"> <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="blogassets/img/logo.png" alt=""> -->
                        <h1>MyBlog</h1>
                    </a>
                </div>
                <div class="col-md-4 col-sm-1"></div>
                <div class="col-md-2 col-sm-2">
                    <div class="d-block float-right">
                        @if (Route::has('login'))
                            <div class="d-block" style="text-align: right; margin-top: 10px;">
                                @auth
                                    <a href="{{ url('/home') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Deshboard</a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-1 col-sm-2">
                    <div class="language-panel">
                        <select class="form-control lang-change mx-2 pull-right">
                            @foreach (config('app.multilocale') as $lang)
                                <option value="{{ $lang }}"
                                    {{ $lang == app()->getLocale() ? 'selected' : '' }}>
                                    {{ $lang == 'bn' ? 'Bangla' : 'English' }}
                                </option>
                            @endforeach
                        </select>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script type="text/javascript">
                            var url = "{{ url('/') }}";
                            //   var url = "{{ request()->url('/') }}";
                            $('.lang-change').change(function() {
                                let lang_code = $(this).val();
                                window.location.href = url + "?language=" + lang_code;
                            });
                        </script>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1">
                    <button id="darkbutton" class="darkmode"
                        style="background-color: white;
                            color: #181818;
                            border-radius: 10px;
                            border: 1px solid #ccc;
                            margin-top: 5px;"><i
                            class='fas fa-sun'></i></button>
                </div>
            </div>
        </div>

    </div>
    <header id="navbar_top" class="header align-items-center  ">
        @include('asset.blogasset.nav')
    </header>


    <!-- ======= Header ======= -->
    {{-- <header id="header" class="header d-flex align-items-center fixed-top mt-5">
         @include('asset.blogasset.nav')
    </header> --}}
    <!-- End Header -->
    <main id="main">
        @yield('content')
    </main><!-- End #main -->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('asset.blogasset.footer')

</body>

</html>
