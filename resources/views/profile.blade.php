@extends('layouts.Frontend.app')

@section('title','profile-')

@push('css')

  <link href="{{ asset('assets/Frontend/css/profile/styles.css') }}" rel="stylesheet">

  <link href="{{ asset('assets/Frontend/css/profile/responsive.css') }}" rel="stylesheet">
  <style>
    .favorite-post{
      color:blue;
    }
  </style>
@endpush

@section('content')
  <div class="slider display-table center-text">
  		<h1 class="title display-table-cell"><b>{{$author->name}}</b></h1>
  	</div><!-- slider -->

  	<section class="blog-area section">
  		<div class="container">

  			<div class="row">

  				<div class="col-lg-8 col-md-12">
  					<div class="row">
              @if ($posts->count() > 0)
                @foreach ($posts as $post)
                  <div class="col-lg-6 col-md-12">
                    <div class="card h-100">
                      <div class="single-post post-style-1">
                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/').$post->image }}" alt="{{$post->name}}"></div>

                        <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('Profile/').$post->user->image }}" alt="Profile Image"></a>

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
                <!-- col-lg-4 col-md-6 -->
                @endforeach
              @else
                <div class="col-lg-12 col-md-12">
                  <div class="card h-100">
                    <div class="single-post post-style-1">

                      <div class="blog-info">
                        <h4 class="title"><b>Nothing Author Post</b></a></h4>
                      </div><!-- blog-info -->
                    </div><!-- single-post -->
                  </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
              @endif




  					</div><!-- row -->



  				</div><!-- col-lg-8 col-md-12 -->

  				<div class="col-lg-4 col-md-12 ">

  					<div class="single-post info-area ">

  						<div class="about-area">
  							<h4 class="title"><b>{{ $author->name }}</b></h4>
  							 <p>{{ $author->about }}</p><br>
                 <strong>Author Sinece: {{ $author->created_at->toDateString() }}</strong><br>
                 <strong>Total Post: {{ $author->posts->count() }}</strong>

  						</div>



  					</div><!-- info-area -->

  				</div><!-- col-lg-4 col-md-12 -->

  			</div><!-- row -->

  		</div><!-- container -->
  	</section><!-- section -->

@endsection

@push('js')

@endpush
