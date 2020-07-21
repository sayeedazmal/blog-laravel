@extends('layouts.Frontend.app')

@section('title','Home-')

@push('css')
  <link href="{{ asset('assets/Frontend/css/home/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/Frontend/css/home/responsive.css') }}" rel="stylesheet">

  <style>
    .favorite-post{
      color:blue;
    }
  </style>
@endpush

@section('content')
  <div class='container-fluid'>
  <div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
      data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
      data-swiper-breakpoints="true" data-swiper-loop="true" >
      <div class="swiper-wrapper">

        @foreach ($categories as $categories)
          <div class="swiper-slide">
            <a class="slider-category" href="{{ route('category.post', $categories->slug) }}">
              <div class="blog-image"><img src="{{ Storage::disk('public')->url('category/slider/'.$categories->image)  }}" alt="{{ $categories->name }}"></div>
              <div class="category">
                <div class="display-table center-text">
                  <div class="display-table-cell">
                    <h3><b>{{$categories->name}}</b></h3>
                  </div>
                </div>
              </div>
            </a>
          </div><!-- swiper-slide -->
        @endforeach
      </div><!-- swiper-wrapper -->
    </div><!-- swiper-container -->
  </div><!-- slider -->
  </div>

  <section class="blog-area section">
    <div class="container">
      <div class="row">
        @foreach ($posts as $post)
          <div class="col-lg-4 col-md-6">
            <div class="card h-100">
              <div class="single-post post-style-1">
                <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/').$post->image }}" alt="{{$post->name}}"></div>

                <a class="avatar" href="{{ route('author.profile', $post->user->username) }}"><img src="{{ Storage::disk('public')->url('Profile/').$post->user->image }}" alt="Profile Image"></a>

                <div class="blog-info">

                  <h4 class="title"><a href="{{ route('post.details',$post->slug  ) }}"><b>{{ $post->title }}</b></a></h4>

                  <ul class="post-footer">
                    <li>
                      @guest
                          <a href="javascript:void(0);" onclick="toastr.info('to add favorite list. You need to login first','info',{
                            closeButton:true,
                            progressBar:true,
                          })"><i class="ion-heart"></i>
                          {{ $post->favourite_to_users->count() }}
                          </a>
                        @else
                          <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                            class="{{ !Auth::user()->favorite_to_post->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite-post' : ''}}"
                            ><i class="ion-heart"></i>
                          {{ $post->favourite_to_users->count() }}
                          </a>
                          <form id="favorite-form-{{ $post->id }}" style="display: none" class="" action="{{ route('post.favorite', $post->id) }}" method="post">
                            @csrf
                          </form>

                      @endguest
                    </li>
                    <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                  </ul>

                </div><!-- blog-info -->
              </div><!-- single-post -->
            </div><!-- card -->
          </div><!-- col-lg-4 col-md-6 -->
        @endforeach


      </div><!-- row -->

       {{$posts->links()}}

    </div><!-- container -->
  </section><!-- section -->

@endsection

@push('js')

@endpush
