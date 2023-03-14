@php
    $posts = [];
@endphp
@foreach ($postmeta as $meta)
    @php
        $posts[] = DB::table('posts')
            ->where('id', $meta->post_id)
            ->orderBy('id', 'DESC')
            ->first();
        // print_r($postmeta);
        // die();
    @endphp
@endforeach

<section>
    <div class="container">
        <div class="row">
            @php
                $languagechange = DB::table('lang_changes')->first();
            @endphp
            <div class="col-md-9" data-aos="fade-up">
                <h3 class="category-title">
                    @if (!empty($languagechange))
                        {{ $languagechange->{'categories_' . app()->getLocale()} }} :
                    @else
                        category:
                    @endif
                    {{ $category[0]->{'name_' . app()->getLocale()} }}
                </h3>
                @foreach ($posts as $post)
                    <div class="d-md-flex post-entry-2 half">
                        <a href="{{ route('post.single', ['slug' => $post->{'slug_' . app()->getLocale()}, 'id' => $post->id]) }}"
                            class="me-4 thumbnail">
                            @if (!empty($post->image))
                                <figure>
                                    <img src="{{ asset('images/' . $post->image) }}" alt="" class="img-fluid">
                                    {{-- <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo,
                                            odit?
                                        </figcaption> --}}
                                </figure>
                            @else
                                No Image
                            @endif
                        </a>
                        <div>
                            <div class="post-meta">
                                <span>{{ date('d-M-y', strtotime($post->created_at)) }}</span>
                            </div>
                            <h3 style="font-size:2rem;"><a
                                    href="{{ route('post.single', ['slug' => $post->{'slug_' . app()->getLocale()}, 'id' => $post->id]) }}">{{ $post->{'title_' . app()->getLocale()} }}</a>
                            </h3>
                            <p>
                                {!! strlen($post->{'content_' . app()->getLocale()}) >= 500
                                    ? substr_replace($post->{'content_' . app()->getLocale()}, '....', 400)
                                    : $post->{'content_' . app()->getLocale()} !!}
                            </p>
                            {{-- {!! substr_replace($post->content, '...', 20) !!} --}}
                            <div class="d-flex align-items-center author">
                                <div class="photo">
                                    <img src="assets/img/person-2.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $postmeta->links() }} {{-- check for page --}}
            </div>
            <div class="col-md-3">
                <!-- ======= Sidebar ======= -->
                <div class="aside-block">

                    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-popular" type="button" role="tab"
                                aria-controls="pills-popular" aria-selected="true">
                                @if (!empty($languagechange))
                                    {{ $languagechange->{'popular_' . app()->getLocale()} }} :
                                @else
                                    popular
                                @endif
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-trending" type="button" role="tab"
                                aria-controls="pills-trending" aria-selected="false">
                                @if (!empty($languagechange))
                                    {{ $languagechange->{'trending_' . app()->getLocale()} }} :
                                @else
                                    trending
                                @endif
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-latest" type="button" role="tab"
                                aria-controls="pills-latest" aria-selected="false">
                                @if (!empty($languagechange))
                                    {{ $languagechange->{'latest_' . app()->getLocale()} }} :
                                @else
                                    latest
                                @endif
                            </button>
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
                                        <div class="post-meta">
                                            {{-- <span class="date"> {{ $latestCategoryName->title }}
                                                </span> <span class="mx-1">&bullet;</span> --}}
                                            <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                        </div>
                                        <h2 class="mb-2"><a
                                                href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'title_' . app()->getLocale()} }}</a>
                                        </h2>
                                        <span class="d-block"> {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}</span>
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
                                            {{-- <span class="date"> {{ $latestCategoryName->title }}
                                                </span> <span class="mx-1">&bullet;</span> --}}
                                            <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                        </div>
                                        <h2 class="mb-2"><a
                                                href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'title_' . app()->getLocale()} }}</a>
                                        </h2>
                                        <span class="d-block"> {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}</span>
                                    </div>
                                @else
                                    <p>please, post add in categories </p>
                                @endif
                            @endforeach


                        </div> <!-- End Trending -->

                        <!-- Latest -->
                        <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
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
                                        <div class="post-meta">
                                            {{-- <span class="date"> {{ $latestCategoryName->title }}
                                                </span> <span class="mx-1">&bullet;</span> --}}
                                            <span>{{ date('d-M-y', strtotime($latestPost->created_at)) }}</span>
                                        </div>
                                        <h2 class="mb-2"><a
                                                href="{{ route('post.single', ['slug' => $latestPost->{'slug_' . app()->getLocale()}, 'id' => $latestPost->id]) }}">{{ $latestPost->{'title_' . app()->getLocale()} }}</a>
                                        </h2>
                                        <span class="d-block"> {!! substr_replace($latestPost->{'content_' . app()->getLocale()}, '...', 120) !!}</span>
                                    </div>
                                @else
                                    <p>please, post add in categories </p>
                                @endif
                            @endforeach
                        </div> <!-- End Latest -->
                    </div>
                </div>

                {{-- {{ $category }} --}}

                <div class="aside-block">
                    <h3 class="aside-title">
                        @if (!empty($languagechange))
                            {{ $languagechange->{'categories_' . app()->getLocale()} }} :
                        @else
                            category
                        @endif
                    </h3>
                    <ul class="aside-links list-unstyled">
                        @foreach ($categoryies as $cat)
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
                </div>

                <!-- End Categories -->
                <div class="aside-block">
                    <h3 class="aside-title">
                        @if (!empty($languagechange))
                            {{ $languagechange->{'tags_' . app()->getLocale()} }} :
                        @else
                            tag
                        @endif
                    </h3>
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
                </div>


                <!-- End Tags -->

            </div>

        </div>
    </div>
</section>
