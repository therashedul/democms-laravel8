<!-- ======= Header ======= -->
<div class="container-fluid container-xl d-flex align-items-center justify-content-between">
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

        <a href="#" class="mx-2 js-search-open  pull-left"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>
        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap pull-left">
            <form action="{{ url('/') }}" method="post" class="search-form">
                @csrf
                <span class="icon bi-search"></span>
                <input type="text" placeholder="Search" class="form-control" id="searchField">
                <button class="btn js-search-close"><span class="bi-x"></span></button>
                <p class="" id="result"></p>
            </form>
        </div><!-- End Search Form -->
        {{-- <div class="clearfix"> </div> --}}
    </div>

</div>
<script>
    var searchField = document.getElementById("searchField");
    searchField.onkeyup = function() {
        var data = document.getElementById("searchField").value;
        const xhttp = new XMLHttpRequest();
        var serverpage = "{{ url('ajax-check') }}" + '/' + data;
        xhttp.open("GET", serverpage, true);
        xhttp.onreadystatechange = function() {
            //   alert(xhttp.status); // check for server connection
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                document.getElementById("result").innerHTML =
                    this.responseText;
            }
        };
        xhttp.send(null);
        // xhttp.open("GET", serverpage, true);

    }
</script>
