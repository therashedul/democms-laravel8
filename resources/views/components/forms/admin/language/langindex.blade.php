    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Language change</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="clearfix"></div>
                <table class="table table-hover table-bordered">

                    <thead>
                        <tr>
                            {{-- <th scope="col">English</th>
                            <th scope="col">Bangla</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($languages as $value)
                            @foreach (config('app.multilocale') as $lang)
                                <tr>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Deshboard_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'deshboard_' . $lang} }}"
                                                    name="deshboard_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">about_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled value="{{ $value->{'about_' . $lang} }}"
                                                    name="about_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Category_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'categories_' . $lang} }}"
                                                    name="categories_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Comment_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'comment_' . $lang} }}"
                                                    name="comment_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Popular_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'popular_' . $lang} }}"
                                                    name="popular_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Trending_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'trending_' . $lang} }}"
                                                    name="trending_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Latest_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'latest_' . $lang} }}"
                                                    name="latest_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Reletive_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'reletive_' . $lang} }}"
                                                    name="reletive_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Tag_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled value="{{ $value->{'tags_' . $lang} }}"
                                                    name="tags_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">More_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled value="{{ $value->{'more_' . $lang} }}"
                                                    name="more_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Sidebar
                                                name_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'sidebar_' . $lang} }}"
                                                    name="sidebar_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Footer
                                                menu_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'footer_' . $lang} }}"
                                                    name="footer_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Download_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'download_' . $lang} }}"
                                                    name="download_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="first-name">Subscriber_{{ $lang }}
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <input type="text" disabled
                                                    value="{{ $value->{'subscriber_' . $lang} }}"
                                                    name="subscriber_{{ $lang }}" class="form-control" />
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" style="text-align: center">
                                    <a href="{{ route($admin . '.language.edit', $value->id) }}"
                                        class="btn btn-primary" style="width: 100%;">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
