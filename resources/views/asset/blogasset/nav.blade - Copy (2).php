<div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="blogassets/img/logo.png" alt=""> -->
        <h1>MyBlog</h1>
    </a>

    @php
        $menu = DB::table('menus')
            ->get()
            ->toArray();
    @endphp
    @if (isset($menu[0]) ? $menu[0]->location == 1 : '')
        @include('menu.header')
    @else
        @if (Route::has('login'))
            <a href="{{ route('superAdmin.menus') }}"
                style="text-align: center;
                    display: block;
                    font-size: 22px;
                    font-weight: bold;
                    text-transform: uppercase;
                    text-decoration: underline;
                    color: red;">
                Add Header Menu</a>
        @endif
    @endif

    <div class="position-relative">
        {{-- <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a> --}}

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
            <form action="#" class="search-form">
                <span class="icon bi-search"></span>
                <input type="text" placeholder="Search" class="form-control" id="search">
                {{-- <button class="btn js-search-close"><span class="bi-x"></span></button> --}}
            </form>
        </div><!-- End Search Form -->
        <p id="result"></p>
    </div>
</div>

<script>
    var search = document.getElementById("search");
    search.onblur = function() {
        var data = document.getElementById("search").value;
        const xhttp = new XMLHttpRequest();
        var serverpage = 'http://127.0.0.1:8000/ajax-check/' + data;
        xhttp.open("GET", serverpage, true);
        xhttp.onreadystatechange = function() {
            // alert(xhttp.status); // check for server connection
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(this.responseText);

                document.getElementById("result").innerHTML =
                    this.responseText;



            }
        };
        xhttp.send(null);
        // xhttp.open("GET", serverpage, true);

    }
</script>
