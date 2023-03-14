  @php
      $sliders = DB::table('sliders')
          ->where('status', '=', '1')
          ->get();
      $posts = DB::table('posts')
          ->where('status', '=', '1')
          ->where('slider', '=', '1')
          ->get();
  @endphp
  <!-- ======= Hero Slider Section ======= -->
  <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
          <div class="row">
              <div class="col-12">
                  <div class="swiper sliderFeaturedPosts">
                      <div class="swiper-wrapper">
                          {{-- for slider table --}}
                          @if (!empty($sliders))
                              @foreach ($sliders as $slider)
                                  <div class="swiper-slide">
                                      <span class="img-bg d-flex img-fluid align-items-end"
                                          style="background-image: url('{{ asset('images/' . $slider->image) }}');background-repeat: no-repeat; background-size: 100% 100%; background-position: top center;">
                                      </span>
                                  </div>
                              @endforeach
                          @endif
                          @if (!empty($posts))
                              @foreach ($posts as $slider)
                                  <div class="swiper-slide">
                                      <a href="{{ url('/') . '/' }}post.single/{{ $slider->{'slug_' . app()->getLocale()} }}/{{ $slider->id }}"
                                          class="img-bg d-flex img-fluid align-items-end"
                                          style="background-image: url('{{ asset('images/' . $slider->image) }}');background-repeat: no-repeat; background-size: 100% 100%; background-position: top center;">
                                          <div class="img-bg-inner">
                                              <h2>{{ $slider->{'name_' . app()->getLocale()} }}</h2>
                                          </div>
                                      </a>
                                  </div>
                              @endforeach
                          @endif
                      </div>
                      <div class="custom-swiper-button-next">
                          <span class="bi-chevron-right"></span>
                      </div>
                      <div class="custom-swiper-button-prev">
                          <span class="bi-chevron-left"></span>
                      </div>
                      <div class="swiper-pagination"></div>
                  </div>
              </div>
          </div>
      </div>
  </section><!-- End Hero Slider Section -->
  <!-- ======= Post Grid Section ======= -->

  @php
      $post1 = DB::table('posts')
          ->latest()
          ->first();
  @endphp
  @if (!empty($post1))
      <section id="posts" class="posts">
          <div class="container" data-aos="fade-up">
              <div class="row g-5">
                  <div class="col-lg-4">
                      <div class="post-entry-1 lg">
                          @php
                              $post1 = DB::table('posts')
                                  ->latest()
                                  ->first();
                              
                              $postment1 = DB::table('postmetas')
                                  ->where('post_id', '=', $post1->id)
                                  ->first();
                              $cat1 = DB::table('categories')
                                  ->where('id', '=', $postment1->cat_id)
                                  ->first();
                              //   print_r($cat1->{'name_' . app()->getLocale()});
                          @endphp
                          <a
                              href="{{ route('post.single', ['slug' => $post1->{'slug_' . app()->getLocale()}, 'id' => $post1->id]) }}">
                               @if (!empty($post1->image))
                                <figure>
                                    <img src="{{ asset('images/' . $post1->image) }}" alt="" class="img-fluid">
                                </figure>
                            @else
                                No Image
                            @endif
                              </a>
                          <div class="post-meta"><span class="date">
                                  <a
                                      href="{{ url('/') }}/category.single/{{ $cat1->{'slug_' . app()->getLocale()} }}">
                                      {{ $cat1->{'name_' . app()->getLocale()} }} </a></span> <span
                                  class="mx-1">&bullet;</span>
                              <span>{{ date('d-M-y', strtotime($post1->created_at)) }}</span>
                          </div>
                          <h2><a
                                  href="{{ route('post.single', ['slug' => $post1->{'slug_' . app()->getLocale()}, 'id' => $post1->id]) }}">{{ $post1->{'name_' . app()->getLocale()} }}</a>
                          </h2>
                          @php
                              $link = route('post.single', ['slug' => $post1->{'slug_' . app()->getLocale()}, 'id' => $post1->id]);
                              // $file = $post1->{'content_' . app()->getLocale()};
                          @endphp
                          <p class="mb-4 d-block">

                              {!! substr($post1->{'content_' . app()->getLocale()}, 0, 500) !!}

                              <a href="{{ $link }}">Read more</a>
                              {{-- {!! substr_replace($post1->{'content_' . app()->getLocale()}, '...', 200) !!} --}}
                          </p>
                          <div class="d-flex align-items-center author">
                              <div class="photo">
                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="col-lg-8">
                      <div class="row g-5">
                          <div class="col-lg-4 border-start custom-border">

                              <div class="post-entry-1">
                                  @php
                                      $cat2 = DB::table('categories')
                                          ->where('slug_en', 'Education')
                                          ->Orwhere('slug_bn', 'শিক্ষ  ')
                                          ->first();
                                      $postment2 = DB::table('postmetas')
                                          ->where('cat_id', '=', $cat2->id)
                                          ->orderBy('id', 'DESC')
                                          ->first();
                                      $post2 = DB::table('posts')
                                          ->where('id', '=', $postment2->post_id)
                                          ->first();
                                      
                                          
                                    
                                  @endphp
                                  <a
                                      href="{{ route('post.single', ['slug' => $post2->{'slug_' . app()->getLocale()}, 'id' => $post2->id]) }}">
                                       @if (!empty($post2->image))
                                                <figure>
                                                    <img src="{{ asset('images/' . $post2->image) }}" alt="" class="img-fluid">
                                                </figure>
                                            @else
                                                No Image
                                            @endif
                                          
                                          </a>
                                  <div class="post-meta"><span class="date">
                                          <a
                                              href="{{ url('/') }}/category.single/{{ $cat2->{'slug_' . app()->getLocale()} }}">
                                              {{ $cat2->{'name_' . app()->getLocale()} }} </a></span> <span
                                          class="mx-1">&bullet;</span>
                                      <span>{{ date('d-M-y', strtotime($post2->created_at)) }}</span>
                                  </div>
                                  <h2>
                                      <a
                                          href="{{ route('post.single', ['slug' => $post2->{'slug_' . app()->getLocale()}, 'id' => $post2->id]) }}">{{ $post2->{'name_' . app()->getLocale()} }}</a>
                                  </h2>
                              </div>
                              <div class="post-entry-1">
                                  @php
                                      $cat3 = DB::table('categories')
                                           ->where('slug_en', 'Business')
                                           ->Orwhere('slug_bn', 'ব্যবসা  ')
                                           ->first();
                                      $postment3 = DB::table('postmetas')
                                          ->where('cat_id', '=', $cat3->id)
                                          ->orderBy('id', 'DESC')
                                          ->first();
                                      $post3 = DB::table('posts')
                                          ->where('id', '=', $postment3->post_id)
                                          ->first();
                                          
                                   
                                  @endphp
                                  <a
                                      href="{{ route('post.single', ['slug' => $post2->{'slug_' . app()->getLocale()}, 'id' => $post2->id]) }}">
                                      
                                       @if (!empty($post3->image))
                                                <figure>
                                                    <img src="{{ asset('images/' . $post3->image) }}" alt="" class="img-fluid">
                                                </figure>
                                            @else
                                                No Image
                                            @endif
                                      
                                  </a>
                                  <div class="post-meta"><span class="date">
                                          <a
                                              href="{{ url('/') }}/category.single/{{ $cat3->{'slug_' . app()->getLocale()} }}">
                                              {{ $cat3->{'name_' . app()->getLocale()} }} </a></span> <span
                                          class="mx-1">&bullet;</span>
                                      <span>{{ date('d-M-y', strtotime($post3->created_at)) }}</span>
                                  </div>
                                  <h2>
                                      <a
                                          href="{{ route('post.single', ['slug' => $post3->{'slug_' . app()->getLocale()}, 'id' => $post3->id]) }}">{{ $post3->{'name_' . app()->getLocale()} }}</a>
                                  </h2>
                              </div>
                              <div class="post-entry-1">
                                  @php
                                      $cat4 = DB::table('categories')
                                          ->where('slug_en', "Islam_and_life")
                                          ->Orwhere('slug_bn', "ইসলাম_ও_জীবন")            
                                          ->first();
                                      $postment4 = DB::table('postmetas')
                                          ->where('cat_id', '=', $cat4->id)
                                          ->orderBy('id', 'DESC')
                                          ->first();
                                      $post4 = DB::table('posts')
                                          ->where('id', '=', $postment4->post_id)
                                          ->first();
                                         
                                  
                                       
                                  @endphp
                                  <a
                                      href="{{ url('/') }}/category.single/{{ $cat4->{'slug_' . app()->getLocale()} }}">
                                      
                                       @if (!empty($post4->image))
                                                <figure>
                                                    <img src="{{ asset('images/' . $post4->image) }}" alt="" class="img-fluid">
                                                </figure>
                                            @else
                                                No Image
                                            @endif
                                      
                                  </a>
                                  <div class="post-meta"><span class="date">
                                          <a
                                              href="{{ url('/') }}/category.single/{{ $cat4->{'slug_' . app()->getLocale()} }}">
                                              {{ $cat4->{'name_' . app()->getLocale()} }} </a></span> <span
                                          class="mx-1">&bullet;</span>
                                      <span>{{ date('d-M-y', strtotime($post4->created_at)) }}</span>
                                  </div>
                                  <h2>
                                      <a
                                          href="{{ route('post.single', ['slug' => $post4->{'slug_' . app()->getLocale()}, 'id' => $post4->id]) }}">{{ $post4->{'name_' . app()->getLocale()} }}</a>
                                  </h2>
                              </div>
                          </div>
                          <div class="col-lg-4 border-start custom-border">
                              <div class="post-entry-1">
                                  @php
                                      $cat5 = DB::table('categories')
                                            ->where('slug_en', "Agricultural_technology")
                                          ->Orwhere('slug_bn', "কৃষি_প্রযুক্তি")  
                                          ->first();
                                      $postment5 = DB::table('postmetas')
                                          ->where('cat_id', '=', $cat5->id)
                                          ->orderBy('id', 'DESC')
                                          ->first();
                                      $post5 = DB::table('posts')
                                          ->where('id', '=', $postment5->post_id)
                                          ->first();
                                          
                                      
                                  @endphp
                                  <a
                                      href="{{ url('/') }}/category.single/{{ $cat5->{'slug_' . app()->getLocale()} }}">
                                      @if (!empty($post5->image))
                                                <figure>
                                                    <img src="{{ asset('images/' . $post5->image) }}" alt="" class="img-fluid">
                                                </figure>
                                            @else
                                                No Image
                                            @endif
                                          
                                          </a>

                                  <div class="post-meta"><span class="date">
                                          <a
                                              href="{{ url('/') }}/category.single/{{ $cat5->{'slug_' . app()->getLocale()} }}">
                                              {{ $cat5->{'name_' . app()->getLocale()} }} </a></span> <span
                                          class="mx-1">&bullet;</span>
                                      <span>{{ date('d-M-y', strtotime($post5->created_at)) }}</span>
                                  </div>
                                  <h2>
                                      <a
                                          href="{{ route('post.single', ['slug' => $post5->{'slug_' . app()->getLocale()}, 'id' => $post5->id]) }}">{{ $post5->{'name_' . app()->getLocale()} }}</a>
                                  </h2>
                              </div>
                              <div class="post-entry-1">
                                  @php
                                      $cat6 = DB::table('categories')
                                          ->where('slug_en', "Health_and_treatment")
                                          ->Orwhere('slug_bn', "স্বাস্থ্য_এবং_চিকিত্সা")
                                          ->first();
                                      $postment6 = DB::table('postmetas')
                                          ->where('cat_id', '=', $cat6->id)
                                          ->orderBy('id', 'DESC')
                                          ->first();
                                      $post6 = DB::table('posts')
                                          ->where('id', '=', $postment6->post_id)
                                          ->first();
                                  @endphp
                                  <a
                                      href="{{ url('/') }}/category.single/{{ $cat6->{'slug_' . app()->getLocale()} }}">
                                      
                                       @if (!empty($post6->image))
                                                <figure>
                                                    <img src="{{ asset('images/' . $post6->image) }}" alt="" class="img-fluid">
                                                </figure>
                                            @else
                                                No Image
                                            @endif
                                      
                                  </a>
                                  <div class="post-meta"><span class="date">
                                          <a
                                              href="{{ url('/') }}/category.single/{{ $cat6->{'slug_' . app()->getLocale()} }}">
                                              {{ $cat6->{'name_' . app()->getLocale()} }} </a></span> <span
                                          class="mx-1">&bullet;</span>
                                      <span>{{ date('d-M-y', strtotime($post6->created_at)) }}</span>
                                  </div>
                                  <h2>
                                      <a
                                          href="{{ route('post.single', ['slug' => $post6->{'slug_' . app()->getLocale()}, 'id' => $post6->id]) }}">{{ $post6->{'name_' . app()->getLocale()} }}</a>
                                  </h2>
                              </div>
                              <div class="post-entry-1">
                                  @php
                                      $cat7 = DB::table('categories')
                                          ->where('name_en', 'Science_and_Technology')
                                          ->Orwhere('slug_bn', "বিজ্ঞান_ও_প্রযুক্তি   ")                                
                                          ->first();
                                      $postment7 = DB::table('postmetas')
                                          ->where('cat_id', '=', $cat7->id)
                                          ->orderBy('id', 'DESC')
                                          ->first();
                                      $post7 = DB::table('posts')
                                          ->where('id', '=', $postment7->post_id)
                                          ->first();
                                       
                                     
                                  @endphp
                                  <a
                                      href="{{ url('/') }}/category.single/{{ $cat7->{'slug_' . app()->getLocale()} }}">
                                      
                                       @if (!empty($post7->image))
                                                <figure>
                                                    <img src="{{ asset('images/' . $post7->image) }}" alt="" class="img-fluid">
                                                </figure>
                                            @else
                                                No Image
                                            @endif
                                          
                                          </a>

                                  <div class="post-meta"><span class="date">
                                          <a
                                              href="{{ url('/') }}/category.single/{{ $cat7->{'slug_' . app()->getLocale()} }}">
                                              {{ $cat7->{'name_' . app()->getLocale()} }} </a></span> <span
                                          class="mx-1">&bullet;</span>
                                      <span>{{ date('d-M-y', strtotime($post7->created_at)) }}</span>
                                  </div>
                                  <h2>
                                      <a
                                          href="{{ route('post.single', ['slug' => $post7->{'slug_' . app()->getLocale()}, 'id' => $post7->id]) }}">{{ $post7->{'name_' . app()->getLocale()} }}</a>
                                  </h2>
                              </div>
                          </div>

                          <!-- Popular Section -->
                          <div class="col-lg-4">
                              <div class="trending front-popular-panel">
                                  <h3 class="text-center d-block front-popular-title">
                                        @php
                                            $languagechange = DB::table('lang_changes')->first();
                                        @endphp
                                      @if (!empty($languagechange))
                                          {{ $languagechange->{'popular_' . app()->getLocale()} }} :
                                      @else
                                          popular
                                      @endif
                                  </h3>
                                  <ul class="trending-post">
                                      @php
                                          $popularPosts = DB::table('posts')
                                              ->where('status', '1')
                                              ->offset(0)
                                              ->limit(5)
                                              ->orderBy('views', 'DESC')
                                              ->get();
                                      @endphp
                                      @foreach ($popularPosts as $latestPost)
                                          @php
                                              $latestMeta = DB::table('postmetas')
                                                  ->where('post_id', $latestPost->id)
                                                  ->first();
                                          @endphp
                                          @if (!empty($latestMeta))
                                              @php
                                                  $latestCategoryName = DB::table('categories')
                                                      ->where('id', $latestMeta->cat_id)
                                                      ->orWhere('id', '!=', '')
                                                      ->first();
                                                  
                                              @endphp
                                              <li>
                                                  <a
                                                      href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">

                                                      <h3>{{ $latestPost->{'name_' . app()->getLocale()} }}</h3>

                                                  </a>
                                              </li>
                                          @else
                                          @endif
                                      @endforeach


                                  </ul>
                              </div>

                          </div> <!-- End Popular Section -->
                      </div>
                  </div>

              </div> <!-- End .row -->
          </div>
      </section> <!-- End Post Grid Section -->


  @else
      <h1 class="my-5 text-center d-block">Please Insert Data</h1>
  @endif
  
  
  
      <!-- ======= Culture Category Section ======= -->
      <section class="category-section">
          <div class="container" data-aos="fade-up">
              @php
                  $cat20 = DB::table('categories')
                      ->where('name_en', 'Education')
                      ->first();
                  $postment20 = DB::table('postmetas')
                      ->where('cat_id', '=', $cat20->id)
                      ->offset(0)
                      ->limit(10)
                      ->orderBy('id', 'DESC')
                      ->get();
                  // $post20 = DB::table('posts')
                  //     ->where('id', '=', $postment20[0]->post_id)
                  //     ->first();
                  // print_r($post20);
              @endphp

              <div class="section-header d-flex justify-content-between align-items-center mb-5">
                  <h2> {{ $cat20->{'name_' . app()->getLocale()} }} </h2>
                  <div>
                      <a href="{{ url('/') }}/category.single/{{ $cat20->{'slug_' . app()->getLocale()} }}">
                          More ...</a>

                      {{-- <a href="category.html" class="more">See All Culture</a> --}}
                  </div>
              </div>
            

              <div class="row">
                <div class="col-md-9">
                      <div class="d-lg-flex post-entry-2">
                          @php
                              $post20 = DB::table('posts')
                                  ->where('id', '=', $postment20[0]->post_id)
                                  ->first();
                                  /*
                                  if(empty($post20))
                                  {
                                  echo "empty";
                                  }else{
                                  echo "have";
                                  }
                                  
                                  die();
                                  */
                          @endphp
                          @if(empty($post20))
                          <p>No post</p>
                          @else
                          <a href="{{ route('post.single', ['slug' => $post20->{'slug_' . app()->getLocale()}, 'id' => $post20->id]) }}"
                              class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                              
                                @if (!empty($post20->image))
                                                <figure>
                                                    <img src="{{ asset('images/' . $post20->image) }}" alt="" class="img-fluid">
                                                </figure>
                                            @else
                                                No Image
                                            @endif
                              
                          </a>
                          <div>
                              <h3>
                                  <a
                                      href="{{ route('post.single', ['slug' => $post20->{'slug_' . app()->getLocale()}, 'id' => $post20->id]) }}">{{ $post20->{'name_' . app()->getLocale()} }}</a>
                              </h3>
                              @php
                                  $link20 = route('post.single', ['slug' => $post20->{'slug_' . app()->getLocale()}, 'id' => $post20->id]);
                              @endphp
                              <p>
                                  {!! substr($post20->{'content_' . app()->getLocale()}, 0, 300) !!} ...
                                  <a href="{{ $link20 }}" style="color:cadetblue">Read more</a>
                              </p>
                              <div class="d-flex align-items-center author">
                                  <div class="photo">
                                  </div>
                                  <div class="name">
                                      <h3 class="m-0 p-0"> </h3>
                                  </div>
                              </div>
                          </div>
                          
                          @endif
                          
                      </div>
                      <div class="row">
                          <div class="col-lg-4">
                              {{-- <div class="post-entry-1 border-bottom">
                                @php
                                    $post201 = DB::table('posts')
                                        ->where('id', '=', $postment20[1]->post_id)
                                        ->first();
                                @endphp
                                @if(!empty($post201))
                                  <p>No post</p>
                                @else
                                <a
                                    href="{{ route('post.single', ['slug' => $post201->{'slug_' . app()->getLocale()}, 'id' => $post201->id]) }}">
                                    <img src="blogassets/img/post-landscape-1.jpg" alt="" class="img-fluid">
                                </a>
                                <h2 class="mb-2">
                                    <a
                                        href="{{ route('post.single', ['slug' => $post201->{'slug_' . app()->getLocale()}, 'id' => $post201->id]) }}">{{ $post201->{'name_' . app()->getLocale()} }}</a>
                                </h2>
                                @php
                                    $link201 = route('post.single', ['slug' => $post201->{'slug_' . app()->getLocale()}, 'id' => $post201->id]);
                                @endphp
                                <p class="mb-4 d-block">
                                    {!! substr($post201->{'content_' . app()->getLocale()}, 0, 200) !!} ...
                                    <a href="{{ $link201 }}" style="color:cadetblue">Read more</a>
                                </p>
                                @endif
                            </div> --}}
                              {{-- <div class="post-entry-1">
                                @php
                                    $post202 = DB::table('posts')
                                        ->where('id', '=', $postment20[2]->post_id)
                                        ->first();
                                @endphp
                                @if(empty($post202))
                                  <p>No post</p>
                                @else
                                <h2 class="mb-2">
                                    <a
                                        href="{{ route('post.single', ['slug' => $post202->{'slug_' . app()->getLocale()}, 'id' => $post202->id]) }}">
                                        {{ $post202->{'name_' . app()->getLocale()} }}</a>
                                </h2>
                                @endif
                            </div> --}}
                          </div>
                          <div class="col-lg-8">
                              {{-- <div class="post-entry-1">
                                @php
                                    $post203 = DB::table('posts')
                                        ->where('id', '=', $postment20[3]->post_id)
                                        ->first();
                                @endphp
                                  @if(empty($post203))
                                  <p>No post</p>
                                 @else
                                <a
                                    href="{{ route('post.single', ['slug' => $post203->{'slug_' . app()->getLocale()}, 'id' => $post203->id]) }}">
                                    <img src="blogassets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>

                                <h2 class="mb-2">
                                    <a
                                        href="{{ route('post.single', ['slug' => $post203->{'slug_' . app()->getLocale()}, 'id' => $post203->id]) }}">
                                        {{ $post203->{'name_' . app()->getLocale()} }}</a>
                                </h2>
                                @endif
                                <p class="mb-4 d-block"></p>
                            </div> --}}
                          </div>
                      </div>
                  </div>

                  <div class="col-md-3">
                      <div class="post-entry-1 border-bottom">
                          @php
                              $post204 = DB::table('posts')
                                  ->where('id', '=', $postment20[4]->post_id)
                                  ->first();
                          @endphp
                            @if(empty($post204))
                              <p>No post</p>
                             @else
                          <h2 class="mb-2">
                              <a
                                  href="{{ route('post.single', ['slug' => $post204->{'slug_' . app()->getLocale()}, 'id' => $post204->id]) }}">
                                  {{ $post204->{'name_' . app()->getLocale()} }}</a>
                          </h2>
                          @endif
                      </div>

                      <div class="post-entry-1 border-bottom">
                          @php
                              $post205 = DB::table('posts')
                                  ->where('id', '=', $postment20[5]->post_id)
                                  ->first();
                          @endphp
                          @if(empty($post205))
                            <p>No post</p>
                          @else
                          <h2 class="mb-2">
                              <a
                                  href="{{ route('post.single', ['slug' => $post205->{'slug_' . app()->getLocale()}, 'id' => $post205->id]) }}">
                                  {{ $post205->{'name_' . app()->getLocale()} }}</a>
                              </a>
                          </h2>
                          @endif
                      </div>

                      <div class="post-entry-1 border-bottom">
                          @php
                              $post206 = DB::table('posts')
                                  ->where('id', '=', $postment20[6]->post_id)
                                  ->first();
                          @endphp
                          @if(empty($post206))
                            <p>No post</p>
                          @else
                          <h2 class="mb-2">
                              <a
                                  href="{{ route('post.single', ['slug' => $post206->{'slug_' . app()->getLocale()}, 'id' => $post206->id]) }}">
                                  {{ $post206->{'name_' . app()->getLocale()} }}</a>
                              </a>
                          </h2>
                        @endif
                      </div>

                      <div class="post-entry-1 border-bottom">
                          @php
                              $post207 = DB::table('posts')
                                  ->where('id', '=', $postment20[7]->post_id)
                                  ->first();
                          @endphp
                          @if(empty($post207))
                            <p>No post</p>
                          @else
                          <h2 class="mb-2">
                              <a
                                  href="{{ route('post.single', ['slug' => $post207->{'slug_' . app()->getLocale()}, 'id' => $post207->id]) }}">
                                  {{ $post207->{'name_' . app()->getLocale()} }}</a>
                              </a>
                          </h2>
                        @endif
                      </div>

                      <div class="post-entry-1 border-bottom">

                          @php
                              $post208 = DB::table('posts')
                                  ->where('id', '=', $postment20[8]->post_id)
                                  ->first();
                          @endphp
                          @if(empty($post208))
                          <p>No post</p>
                          @else
                          <h2 class="mb-2">
                              <a
                                  href="{{ route('post.single', ['slug' => $post208->{'slug_' . app()->getLocale()}, 'id' => $post208->id]) }}">
                                  {{ $post208->{'name_' . app()->getLocale()} }}</a>
                              </a>
                          </h2>
                          @endif
                      </div>
                      {{-- <div class="post-entry-1 border-bottom">
                        @php
                            $post209 = DB::table('posts')
                                ->where('id', '=', $postment20[9]->post_id)
                                ->first();
                        @endphp
                        <h2 class="mb-2">
                            <a
                                href="{{ route('post.single', ['slug' => $post209->{'slug_' . app()->getLocale()}, 'id' => $post209->id]) }}">
                                {{ $post209->{'name_' . app()->getLocale()} }}</a>
                            </a>
                        </h2>
                    </div> --}}
                  </div>
              </div>
          </div>
      </section><!-- End Culture Category Section -->
