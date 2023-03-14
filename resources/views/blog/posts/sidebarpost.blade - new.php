  <section class="single-post-content">
      <div class="container">
          <div class="row">
              <div class="col-md-9 post-content" data-aos="fade-up">

                  <!-- ======= Single Post Content ======= -->
                  <div class="single-post">
                      <div class="post-meta">
                      </div>
                      <h1 class="mb-5">{{ $post->{'title_' . app()->getLocale()} }} </h1>
                      @if (!empty($post->image))
                          <figure class="my-4">
                              <img src="{{ asset('images/' . $post->image) }}" alt="" class="img-fluid"
                                  style="width: 92%;">
                              {{-- <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, odit?
                                </figcaption> --}}
                          </figure>
                      @else
                      @endif
                      @php
                          $frstl = mb_substr($post->{'content_' . app()->getLocale()}, 3, 1, 'UTF-8');
                      @endphp
                      @php
                          $fullcont = substr($post->{'content_' . app()->getLocale()}, 4);
                      @endphp
                      <p><span class="firstcharacter">{{ $frstl }}</span>
                          {!! $fullcont !!}
                      </p>

                      @if (!empty($post->file))
                          <p><a href="{{ asset('files/' . $post->file) }}" class="btn btn-info"> <i
                                      class="fas fa-cloud-download-alt"></i> Download</a>
                          </p>
                      @else
                      @endif
                      @php
                          $video = $post->video;
                          $extention = pathinfo($video, PATHINFO_EXTENSION);
                          
                      @endphp
                      @if ($extention == 'mp4' && !empty($post->video))
                          <video width="320" height="240" controls>
                              <source src="{{ asset('files/' . $post->video) }}" type="video/mp4">
                              {{-- <source src="movie.ogg" type="video/ogg"> --}}
                          </video>
                      @else
                          @if (!empty($post->video))
                              <div class="video-block">
                                  <div class="video-post">
                                      <iframe width="50%"
                                          height="auto"src="//www.youtube.com/embed/{{ $post->video }}"
                                          frameborder="0"
                                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                          allowfullscreen></iframe>
                                  </div>
                              </div>
                          @endif
                      @endif
                  </div><!-- End Single Post Content -->

                  <!-- ======= Comments Form ======= -->
                  <div class="row justify-content-center mt-5">
                      <div class="col-lg-12">
                          <h5 class="comment-title">Leave a Comment</h5>
                          <form action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                  @if (Route::has('login'))
                                      @auth
                                          <div class="col-12 mb-3">

                                              <textarea class="form-control" name="comment_body" id="comment-message" placeholder=" Message" cols="30"
                                                  rows="4"></textarea>
                                              <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                          </div>
                                          <div class="col-12">
                                              <input type="submit" class="btn btn-primary" value="Add Comment">
                                          </div>
                                      @else
                                          <div class="col-lg-6 mb-3">
                                              <input type="text" name="commentname" class="form-control"
                                                  id="comment-name" placeholder="Enter your name">
                                          </div>
                                          <div class="col-lg-6 mb-3">

                                              <input type="text" name="commentemail" class="form-control"
                                                  id="comment-email" placeholder="Enter your email">
                                          </div>
                                          <div class="col-12 mb-3">
                                              <textarea class="form-control" name="comment_body" id="comment-message" placeholder="Message" cols="30"
                                                  rows="4"></textarea>
                                              <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                              <input type="hidden" name="user_id" value="{{ $post->user_id }}" />
                                          </div>
                                          <div class="col-12">
                                              <input type="submit" class="btn btn-success" style="width: 100%;"
                                                  value="Add Comment">
                                          </div>
                                      @endauth
                                  @endif
                              </div>
                          </form>
                      </div>
                  </div>
                  <!-- End Comments Form -->
                  <!-- ======= Comments ======= -->
                  <div class="comments" style="margin-bottom:20%;">
                      @php
                          $comentcount = DB::table('comments')
                              ->select(DB::raw('count(*) as comment'))
                              ->where('post_id', $post->id)
                              ->get();
                      @endphp
                      <h5 class="comment-title py-4">@php echo $comentcount[0]->comment == true ? $comentcount[0]->comment : '0'; @endphp Comments</h5>
                      @include('comment.commentsDisplay', [
                          'comments' => $post->comments,
                          'post_id' => $post->id,
                      ])
                  </div>
                  <!-- End Comments -->

                  @foreach ($reletedpost as $posts)
                      @php
                          $showposts = DB::table('posts')
                              ->where('id', '=', $posts->post_id)
                              ->orderBy('id', 'DESC')
                              ->get();
                      @endphp

                      @foreach ($showposts as $showpost)
                          <!-- ======= Single Post Content ======= -->
                          <div class="single-post">
                              <div class="post-meta">
                              </div>
                              <h1 class="mb-5">{{ $showpost->{'title_' . app()->getLocale()} }} </h1>
                              @if (!empty($showpost->image))
                                  <figure class="my-4">
                                      <img src="{{ asset('images/' . $showpost->image) }}" alt=""
                                          class="img-fluid" style="width: 92%;">
                                      {{-- <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, odit?
                                </figcaption> --}}
                                  </figure>
                              @else
                              @endif
                              @php
                                  $frstl = mb_substr($showpost->{'content_' . app()->getLocale()}, 3, 1, 'UTF-8');
                              @endphp
                              @php
                                  $fullcont = substr($showpost->{'content_' . app()->getLocale()}, 4);
                              @endphp
                              <p><span class="firstcharacter">{{ $frstl }}</span>
                                  {!! $fullcont !!}
                              </p>

                              @if (!empty($showpost->file))
                                  <p><a href="{{ asset('files/' . $post->file) }}" class="btn btn-info"> <i
                                              class="fas fa-cloud-download-alt"></i> Download</a>
                                  </p>
                              @else
                              @endif
                              @php
                                  $video = $post->video;
                                  $extention = pathinfo($video, PATHINFO_EXTENSION);
                                  
                              @endphp
                              @if ($extention == 'mp4' && !empty($showpost->video))
                                  <video width="320" height="240" controls>
                                      <source src="{{ asset('files/' . $showpost->video) }}" type="video/mp4">
                                      {{-- <source src="movie.ogg" type="video/ogg"> --}}
                                  </video>
                              @else
                                  @if (!empty($showpost->video))
                                      <div class="video-block">
                                          <div class="video-post">
                                              <iframe width="50%"
                                                  height="auto"src="//www.youtube.com/embed/{{ $showpost->video }}"
                                                  frameborder="0"
                                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                  allowfullscreen></iframe>
                                          </div>
                                      </div>
                                  @endif
                              @endif
                          </div><!-- End Single Post Content -->

                          <!-- ======= Comments Form ======= -->
                          <div class="row justify-content-center mt-5">
                              <div class="col-lg-12">
                                  <h5 class="comment-title">Leave a Comment</h5>
                                  <form action="{{ route('comments.store') }}" method="post"
                                      enctype="multipart/form-data">
                                      @csrf
                                      <div class="row">
                                          @if (Route::has('login'))
                                              @auth
                                                  <div class="col-12 mb-3">
                                                      <textarea class="form-control" name="comment_body" id="comment-message" placeholder=" Message" cols="30"
                                                          rows="4"></textarea>
                                                      <input type="hidden" name="post_id"
                                                          value="{{ $showpost->id }}" />
                                                  </div>
                                                  <div class="col-12">
                                                      <input type="submit" class="btn btn-primary" value="Add Comment">
                                                  </div>
                                              @else
                                                  <div class="col-lg-6 mb-3">
                                                      <input type="text" name="commentname" class="form-control"
                                                          id="comment-name" placeholder="Enter your name">
                                                  </div>
                                                  <div class="col-lg-6 mb-3">

                                                      <input type="text" name="commentemail" class="form-control"
                                                          id="comment-email" placeholder="Enter your email">
                                                  </div>
                                                  <div class="col-12 mb-3">
                                                      <textarea class="form-control" name="comment_body" id="comment-message" placeholder="Message" cols="30"
                                                          rows="4"></textarea>
                                                      <input type="hidden" name="post_id"
                                                          value="{{ $showpost->id }}" />
                                                      <input type="hidden" name="user_id"
                                                          value="{{ $showpost->user_id }}" />
                                                  </div>
                                                  <div class="col-12">
                                                      <input type="submit" class="btn btn-success" style="width: 100%;"
                                                          value="Add Comment">
                                                  </div>
                                              @endauth
                                          @endif
                                      </div>
                                  </form>
                              </div>
                          </div>
                          <!-- End Comments Form -->
                          <!-- ======= Comments ======= -->
                          <div class="comments" style="margin-bottom:20%;">
                              @php
                                  $comentcount = DB::table('comments')
                                      ->select(DB::raw('count(*) as comment'))
                                      ->where('post_id', $post->id)
                                      ->get();
                              @endphp
                              <h5 class="comment-title py-4">@php echo $comentcount[0]->comment == true ? $comentcount[0]->comment : '0'; @endphp Comments</h5>
                              @include('comment.commentsDisplay', [
                                  'comments' => $post->comments,
                                  'post_id' => $post->id,
                              ])
                          </div>
                          <!-- End Comments -->
                      @endforeach
                  @endforeach
              </div>
              <div class="col-md-3">
                  <!-- ======= Sidebar ======= -->
                  <div class="aside-block">

                      <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                                  data-bs-target="#pills-popular" type="button" role="tab"
                                  aria-controls="pills-popular" aria-selected="true">Popular</button>
                          </li>
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill"
                                  data-bs-target="#pills-trending" type="button" role="tab"
                                  aria-controls="pills-trending" aria-selected="false">Trending</button>
                          </li>
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                  data-bs-target="#pills-latest" type="button" role="tab"
                                  aria-controls="pills-latest" aria-selected="false">Latest</button>
                          </li>
                      </ul>

                      <div class="tab-content" id="pills-tabContent">

                          <!-- Popular -->
                          <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                              aria-labelledby="pills-popular-tab">
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
                                      <div class="post-entry-1 border-bottom">
                                          <div class="post-meta">
                                              <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                          </div>
                                          <h2 class="mb-2">
                                              <a
                                                  href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'name_' . app()->getLocale()} }}</a>
                                          </h2>
                                          <span class="d-block"> {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}</span>
                                      </div>
                                  @else
                                  @endif
                              @endforeach



                          </div> <!-- End Popular -->

                          <!-- Trending -->
                          <div class="tab-pane fade" id="pills-trending" role="tabpanel"
                              aria-labelledby="pills-trending-tab">
                              @php
                                  $trandingPosts = DB::table('posts')
                                      ->where('trending', '1')
                                      ->offset(0)
                                      ->limit(5)
                                      ->orderBy('id', 'DESC')
                                      ->get();
                              @endphp
                              @foreach ($trandingPosts as $latestPost)
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
                                      <div class="post-entry-1 border-bottom">
                                          <div class="post-meta">
                                              <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                          </div>
                                          <h2 class="mb-2">
                                              <a
                                                  href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'name_' . app()->getLocale()} }}</a>
                                          </h2>
                                          <span class="d-block"> {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}</span>
                                      </div>
                                  @else
                                  @endif
                              @endforeach

                          </div> <!-- End Trending -->

                          <!-- Latest -->
                          <div class="tab-pane fade" id="pills-latest" role="tabpanel"
                              aria-labelledby="pills-latest-tab">
                              @php
                                  $latestPosts = DB::table('posts')
                                      ->orderBy('id', 'DESC')
                                      ->offset(0)
                                      ->limit(5)
                                      ->get();
                              @endphp
                              @foreach ($latestPosts as $latestPost)
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
                                      <div class="post-entry-1 border-bottom">
                                          <div class="post-meta">
                                              <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                          </div>
                                          <h2 class="mb-2">
                                              <a
                                                  href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'name_' . app()->getLocale()} }}</a>
                                          </h2>
                                          <span class="d-block"> {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}</span>
                                      </div>
                                  @else
                                  @endif
                              @endforeach

                          </div> <!-- End Latest -->

                      </div>
                  </div>

                  {{-- <div class="aside-block">
                        <h3 class="aside-title">Video</h3>
                        <div class="video-post">
                            <iframe width="100%" height="auto"src="//www.youtube.com/embed/{{ $post->video }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div> --}}
                  <!-- End Video -->
                  {{-- {{ $category }} --}}
                  <div class="aside-block">
                      <h3 class="aside-title">Categories</h3>
                      <ul class="aside-links list-unstyled">
                          @foreach ($categories as $cat)
                              <li><a href="{{ route('category.single', $cat->{'slug_' . app()->getLocale()}) }}"><i
                                          class="bi bi-chevron-right"></i>{{ $cat->{'title_' . app()->getLocale()} }}</a>
                              </li>
                              @if (count($cat->subcategory) > 0)
                                  @foreach ($cat->subcategory as $sub)
                                      @if ($sub->parent_id == $cat->id)
                                          <li style="margin-left:8%;"><a
                                                  href="{{ route('category.single', $sub->{'slug_' . app()->getLocale()}) }}"><i
                                                      class="bi bi-chevron-right"></i>{{ $sub->{'title_' . app()->getLocale()} }}</a>
                                          </li>
                                      @endif
                                  @endforeach
                              @endif
                          @endforeach
                      </ul>
                  </div><!-- End Categories -->

                  <div class="aside-block">
                      <h3 class="aside-title">Tags</h3>
                      @php
                          $tages = DB::table('posts')
                              ->where('tag', '!=', '')
                              ->get();
                      @endphp

                      <ul class="aside-tags list-unstyled">
                          @foreach ($tages as $tage)
                              @php
                                  $pieces = explode(',', $tage->tag);
                                  
                              @endphp
                              @foreach ($pieces as $tag)
                                  <li>
                                      <a
                                          href="{{ route('post.single', ['slug' => $tage->{'slug_' . app()->getLocale()}, 'id' => $tage->id]) }}">{{ $tag }}</a>
                                  </li>
                              @endforeach
                          @endforeach
                      </ul>
                  </div><!-- End Tags -->

              </div>


          </div>
      </div>
  </section>
