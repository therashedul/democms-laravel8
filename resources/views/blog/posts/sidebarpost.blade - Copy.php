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
                  <div class="comments">
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
                                  $latestPosts = DB::table('posts')
                                      ->where('status', '1')
                                      ->offset(0)
                                      ->limit(5)
                                      ->orderBy('views', 'DESC')
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
                                          <div class="post-meta"><span class="date">
                                                  {{-- {{ $latestCategoryName->title }} --}}
                                              </span> <span class="mx-1">&bullet;</span>
                                              <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                          </div>

                                          <h2 class="mb-2"><a
                                                  href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'title_' . app()->getLocale()} }}</a>
                                          </h2>
                                          {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}
                                      </div>
                                  @else
                                      <p>View post after get popular post </p>
                                  @endif
                              @endforeach
                          </div> <!-- End Popular -->

                          <!-- Trending -->
                          <div class="tab-pane fade" id="pills-trending" role="tabpanel"
                              aria-labelledby="pills-trending-tab">

                              @php
                                  $latestPosts = DB::table('posts')
                                      ->orderBy('id', 'DESC')
                                      ->where('trending', '1')
                                      ->offset(0)
                                      ->limit(5)
                                      ->get();
                                  // print_r($latestPosts);
                              @endphp
                              @foreach ($latestPosts as $latestPost)
                                  @php
                                      $latestMeta = DB::table('postmetas')
                                          ->where('post_id', $latestPost->id)
                                          ->first();
                                      // print_r($latestMeta->cat_id);
                                  @endphp
                                  @if (!empty($latestMeta))
                                      @php
                                          $latestCategoryName = DB::table('categories')
                                              ->where('id', $latestMeta->cat_id)
                                              ->orWhere('id', '!=', '')
                                              ->first();
                                          // print_r($latestCategoryName);
                                      @endphp
                                      <div class="post-entry-1 border-bottom">
                                          <div class="post-meta"><span class="date">
                                                  {{ $latestCategoryName->{'name_' . app()->getLocale()} }}
                                              </span> <span class="mx-1">&bullet;</span>
                                              <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                          </div>
                                          <h2 class="mb-2"><a
                                                  href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'title_' . app()->getLocale()} }}</a>
                                          </h2>
                                          {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}
                                      </div>
                                  @else
                                      <p>please, post add in categories </p>
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
                                      // print_r($latestMeta->cat_id);
                                  @endphp
                                  @if (!empty($latestMeta))
                                      @php
                                          $latestCategoryName = DB::table('categories')
                                              ->where('id', $latestMeta->cat_id)
                                              ->orWhere('id', '!=', '')
                                              ->first();
                                          // print_r($latestMeta);
                                      @endphp
                                      <div class="post-entry-1 border-bottom">
                                          <div class="post-meta"><span class="date">
                                                  {{ $latestCategoryName->{'name_' . app()->getLocale()} }}
                                              </span> <span class="mx-1">&bullet;</span>
                                              <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                          </div>
                                          <h2 class="mb-2"><a
                                                  href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'title_' . app()->getLocale()} }}</a>
                                          </h2>
                                          {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}
                                      </div>
                                  @else
                                      <p>please, post add in categories </p>
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
                  <div class="aside-block">
                      <h3 class="aside-title">Categories</h3>
                      @foreach ($categories as $category)
                          @php
                              $checked = '';
                          @endphp
                          @foreach ($postmeta as $meta)
                              @if ($meta->cat_id == $category->id)
                                  @php
                                      $checked = 'checked = ""';
                                  @endphp
                              @endif
                          @endforeach
                          <ul class="aside-links list-unstyled">
                              <li> <a href="{{ route('category.single', $category->{'slug_' . app()->getLocale()}) }}"
                                      style="font-size: calc(calc(0.4rem + 0.8vw));">
                                      {{ $category->{'name_' . app()->getLocale()} }}</a>
                              </li>
                          </ul>
                          @if (count($category->subcategory) > 0)
                              @foreach ($category->subcategory as $sub)
                                  @php
                                      $checked = '';
                                  @endphp
                                  @foreach ($postmeta as $meta)
                                      @if ($meta->cat_id == $sub->id)
                                          @php
                                              $checked = 'checked = ""';
                                          @endphp
                                      @endif
                                  @endforeach
                                  <ul class="aside-links list-unstyled"
                                      @if ($sub->name) style="margin-right: 15px;" @endif>
                                      <li> <a href="" style="font-size: calc(calc(0.4rem + 0.8vw));">
                                              {{ $sub->{'name_' . app()->getLocale()} }}</a>
                                      </li>
                                  </ul>
                              @endforeach
                          @endif
                      @endforeach
                  </div><!-- End Categories -->

                  <div class="aside-block">
                      <h3 class="aside-title">Tags</h3>
                      @if (!empty($post->tag))
                          @php
                              $tags = explode(',', $post->tag);
                          @endphp
                          <ul class="aside-tags list-unstyled">
                              @foreach ($tags as $tag)
                                  <li><a
                                          href="{{ route('post.single', ['slug' => $post->{'slug_' . app()->getLocale()}, 'id' => $post->id]) }}">{{ $tag }}</a>
                                  </li>
                              @endforeach
                          </ul>
                      @endif
                  </div><!-- End Tags -->
              </div>
          </div>
      </div>
  </section>
