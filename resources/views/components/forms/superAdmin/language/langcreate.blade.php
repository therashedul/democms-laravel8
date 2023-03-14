      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
          </div>
      @endif
      @php
          $langs[] = '';
      @endphp
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
                                  <input type="text" name="deshboard_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">about_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="about_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">Category_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="categories_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">Comment_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="comment_{{ $lang }}" class="form-control" />
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
                                  <input type="text" name="popular_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">Trending_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="trending_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">Latest_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="latest_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">Reletive_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="reletive_{{ $lang }}" class="form-control" />
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
                                  <input type="text" name="tags_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">More_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="more_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Sidebar
                                  name_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="sidebar_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Footer
                                  menu_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="footer_{{ $lang }}" class="form-control" />
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
                                  <input type="text" name="download_{{ $lang }}" class="form-control" />
                              </div>
                          </div>
                      </td>
                      <td>
                          <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align"
                                  for="first-name">Subscriber_{{ $lang }}
                              </label>
                              <div class="col-md-9 col-sm-9 ">
                                  <input type="text" name="subscriber_{{ $lang }}"
                                      class="form-control" />
                              </div>
                          </div>
                      </td>


                  </tr>
              @endforeach

          </tbody>
      </table>
      {{-- ============================ --}}
