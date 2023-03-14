    @php
        $changelanguage = DB::table('lang_changes')
            ->where('id', '=', $id)
            ->first();
    @endphp
    {{-- <input type="text" lang="{{ $id }}" /> --}}
    <div class="lang">
        @php
            $langs[] = '';
        @endphp
        <br />
        <table class="table table-hover table-bordered">
            <thead>
                {{-- <tr>
                  <th scope="col">English</th>
                  <th scope="col">Bangla</th>
              </tr> --}}
            </thead>
            <tbody>
                @foreach (config('app.multilocale') as $lang)
                    @php
                        $langs[] = $lang;
                    @endphp
                    <tr>
                        <td>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="first-name">Deshboard_{{ $lang }}
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="{{ $changelanguage->{'deshboard_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'about_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'categories_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'comment_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'popular_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'trending_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'latest_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'reletive_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'tags_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'more_' . $lang} }}"
                                        name="more_{{ $lang }}" class="form-control" />
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Sidebar
                                    name_{{ $lang }}
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="{{ $changelanguage->{'sidebar_' . $lang} }}"
                                        name="sidebar_{{ $lang }}" class="form-control" />
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Footer
                                    menu_{{ $lang }}
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" value="{{ $changelanguage->{'footer_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'download_' . $lang} }}"
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
                                    <input type="text" value="{{ $changelanguage->{'subscriber_' . $lang} }}"
                                        name="subscriber_{{ $lang }}" class="form-control" />
                                </div>
                            </div>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
