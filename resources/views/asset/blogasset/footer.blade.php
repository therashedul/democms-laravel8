<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">About MyBlog</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem
                        deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis
                    </p>
                    <p><a href="about.html" class="footer-link-more">Learn More</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Navigation</h3>
                    @php
                        $menu = DB::table('menus')
                            ->get()
                            ->toArray();
                    @endphp
                    @if (isset($menu[1]) ? $menu[1]->location == 2 : '')
                        @include('menu.footer')
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
                                Add Footer Menu</a>
                        @endif
                    @endif
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Inportant Link</h3>
                    {{-- @php
                        $menu = DB::table('menus')
                            ->get()
                            ->toArray();
                    @endphp
                    @if (isset($menu[2]) ? $menu[2]->location == 3 : '')
                        @include('menu.sidebar')
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
                                Add Footer Menu</a>
                        @endif
                    @endif --}}
                    <ul class="footer-links list-unstyled">
                        <li><a href="https://www.prothomalo.com/" target="_blank"><i class="bi bi-chevron-right"></i>
                                Prothom alo</a>
                        </li>
                        <li><a href="https://www.bbc.com/bengali" target="_blank"><i class="bi bi-chevron-right"></i>
                                BBC Bangla</a>
                        </li>
                        <li><a href="https://www.aljazeera.com/" target="_blank"><i class="bi bi-chevron-right"></i>
                                Al Jazeera</a></li>
                        <li><a href="https://www.bbc.com/" target="_blank"><i class="bi bi-chevron-right"></i> BBC</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h3 class="footer-heading">Subscribe</h3>

                    {!! Form::open(['route' => 'submail', 'method' => 'POST']) !!}
                    <input type="text" name="email" placeholder="Email">
                    <button type="submit" class="btn btn-sm btn-success ">Submit</button>
                    {!! Form::close() !!}

                </div>


            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright">
                        © Copyright <strong><span>webexpert</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="https://webexpertaz.com/">webexpert</a>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="{{ asset('blogassets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('blogassets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('blogassets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('blogassets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('blogassets/vendor/php-email-form/validate.js') }}"></script>


<!-- Template Main JS File -->
<script src="{{ asset('blogassets/js/main.js') }}"></script>

<script>
    // =======================Right button click disable ===========
    // With jQuery
    // https://stackoverflow.com/questions/737022/how-do-i-disable-right-click-on-my-web-page
       @php
        if (Auth::check()) {
            $email = Auth::user()->email;
            $role_id = Auth::user()->role_id;
        }
      
        if(empty($role_id)){
        @endphp
                $(document).on({
                    "contextmenu": function (e) {
                        console.log("ctx menu button:", e.which); 
                        // Stop the context menu
                        e.preventDefault();
                        alert("Stop click right button");
                    },
                    "mousedown": function(e) { 
                        // alert("Stop click right button", e.which);
                        console.log("normal mouse down:", e.which); 
                    },
                    "mouseup": function(e) { 
                        // alert("Stop click right button", e.which);
                        console.log("normal mouse up:", e.which); 
                    }
                });
        @php
            }else if(($role_id == '1') || ($role_id == '2')) {
        @endphp
        @php
            }
        @endphp
</script>
