@extends('layouts.backend.app')

@section('title','Deshboard-')

@push('css')

@endpush

@section('content')

<div class="container-fluid">
          <div class="block-header">
              <h2>DASHBOARD</h2>
          </div>

          <!-- Widgets -->
          <div class="row clearfix">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box bg-pink hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">playlist_add_check</i>
                      </div>
                      <div class="content">
                          <div class="text">Total Post</div>
                          <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="15" data-fresh-interval="20"></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box bg-cyan hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">help</i>
                      </div>
                      <div class="content">
                          <div class="text">Total Favorite</div>
                          <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favorite_to_post()->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box bg-light-green hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">library_books</i>
                      </div>
                      <div class="content">
                          <div class="text">Panding Post</div>
                          <div class="number count-to" data-from="0" data-to="{{ $total_panding_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box bg-orange hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">person_add</i>
                      </div>
                      <div class="content">
                          <div class="text">All Views</div>
                          <div class="number count-to" data-from="0" data-to="{{$all_views}}" data-speed="1000" data-fresh-interval="20"></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row clearfix">
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box bg-blue hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">playlist_add_check</i>
                      </div>
                      <div class="content">
                          <div class="text">Total Category</div>
                          <div class="number count-to" data-from="0" data-to="{{$all_category}}" data-speed="15" data-fresh-interval="20"></div>
                      </div>
                  </div>
                  <div class="info-box bg-red hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">playlist_add_check</i>
                      </div>
                      <div class="content">
                          <div class="text">Total Tag</div>
                          <div class="number count-to" data-from="0" data-to="{{$all_tags}}" data-speed="15" data-fresh-interval="20"></div>
                      </div>
                  </div>
                  <div class="info-box bg-yellow hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">playlist_add_check</i>
                      </div>
                      <div class="content">
                          <div class="text">Author</div>
                          <div class="number count-to" data-from="0" data-to="{{$author_count}}" data-speed="15" data-fresh-interval="20"></div>
                      </div>
                  </div>
                  <div class="info-box bg-gray hover-expand-effect">
                      <div class="icon">
                          <i class="material-icons">playlist_add_check</i>
                      </div>
                      <div class="content">
                          <div class="text">New Author</div>
                          <div class="number count-to" data-from="0" data-to="{{$new_authors_today}}" data-speed="15" data-fresh-interval="20"></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Populer Post</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Ranking List</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Favorite</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($populer_posts as $key => $posts)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{str_limit($posts->title)}}</td>
                                        <td>{{$posts->user->name }}</td>
                                        <td>{{$posts->view_count }}</td>
                                        <td>{{$posts->favourite_to_users_count }}</td>
                                        <td>{{$posts->comments_count }}</td>
                                        <td>
                                          @if ($posts->status == true)
                                            <label class="label bg-green">Published</label>
                                          @else
                                            <label class="label bg-red">Published</label>

                                          @endif
                                        </td>
                                        <td>
                                          <a href="{{ route('post.details',$posts->slug) }}" class="btn btn-sm btn-primary waves-effect" target="_blank">View</a>
                                        </td>


                                    </tr>
                                  @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
          </div>
          <!-- #END# Widgets -->
        <div class="row clearfix">
               <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <div class="card">
                       <div class="header">
                           <h2>Top 10 Active Author</h2>
                       </div>
                       <div class="body">
                           <div class="table-responsive">
                               <table class="table table-hover dashboard-task-infos">
                                   <thead>
                                       <tr>
                                           <th>Ranking List</th>
                                           <th>Name</th>
                                           <th>Post</th>
                                           <th>Comment</th>
                                           <th>Favorite</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                     @foreach ($active_user as $key => $user)
                                       <tr>
                                           <td>{{$key + 1}}</td>
                                           <td>{{$user->name}}</td>
                                           <td>{{$user->posts->count()}}</td>
                                           <td>{{$user->comments->count()}}</td>
                                           <td>{{$user->favorite_to_post->count()}}</td>

                                       </tr>
                                     @endforeach


                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- #END# Task Info -->
        </div>
</div>
@endsection

@push('js')
  <!-- Jquery CountTo Plugin Js -->
  <script src="{{ asset('assets/Backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>

  <!-- Morris Plugin Js -->
  <script src="{{ asset('assets/Backend/plugins/raphael/raphael.min.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/morrisjs/morris.js')}}"></script>

  <!-- ChartJs -->
  <script src="{{ asset('assets/Backend/plugins/chartjs/Chart.bundle.js')}}"></script>

  <!-- Flot Charts Plugin Js -->
  <script src="{{ asset('assets/Backend/plugins/flot-charts/jquery.flot.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

  <!-- Sparkline Chart Plugin Js -->
  <script src="{{ asset('assets/Backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
  <script src="{{ asset('assets/Backend/js/pages/index.js')}}"></script>
@endpush
