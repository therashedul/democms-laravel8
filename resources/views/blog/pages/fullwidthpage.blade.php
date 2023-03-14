    <section>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-title">{{ $page->{'name_' . app()->getLocale()} }}</h1>
                </div>
            </div>

            <div class="row mb-12">
                @if (!empty($page->image))
                    <figure class="">
                        <img src="{{ asset('images/' . $page->image) }}" alt="" class="img-fluid"
                            style="width: 100%; height:450px">
                        {{-- <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, odit?
                                </figcaption> --}}
                    </figure>
                @else
                @endif

                <div class="d-md-flex post-entry-2 half">
                    <div class="ps-md-12 mt-0 mt-md-0">
                        <a href="#" class="thumbnail">
                            <img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid">
                        </a>
                        {{-- <h2 class="mb-4 display-4"></h2> --}}
                        {!! $page->{'content_' . app()->getLocale()} !!}
                    </div>
                </div>

                @if (!empty($page->file))
                    <p><a href="{{ asset('files/' . $page->file) }}" class="btn btn-info"> <i
                                class="fas fa-cloud-download-alt"></i> Download</a>
                    </p>
                @else
                @endif
                @php
                    $video = $page->video;
                    $extention = pathinfo($video, PATHINFO_EXTENSION);
                    
                @endphp
                @if ($extention == 'mp4' && !empty($page->video))
                    <video width="320" height="240" controls>
                        <source src="{{ asset('files/' . $page->video) }}" type="video/mp4">
                        {{-- <source src="movie.ogg" type="video/ogg"> --}}
                    </video>
                @else
                    @if (!empty($page->video))
                        <div class="video-block">
                            <div class="video-page">
                                <iframe width="80%" height="380vh"src="//www.youtube.com/embed/{{ $page->video }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                @endif



            </div>

        </div>
    </section>
