<header>
<div class="container-fluid position-relative no-side-padding">

  <a href="#" class="logo"><img src="" alt=""><strong><b>BLOG</b></strong></a>

  <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

  <ul class="main-menu visible-on-click" id="main-menu">

    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('post.show') }}">Post</a></li>

    @guest
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>

    @else
      @if (Auth::user()->role->id == 1)
        <li><a href="{{ route('admin.deshboard') }}">deshboard</a></li>

      @endif
      @if (Auth::user()->role->id == 2)
        <li><a href="{{ route('author.deshboard') }}">deshboard</a></li>

      @endif
    @endguest

  </ul><!-- main-menu -->

  <div class="src-area">
    <form action='{{ route('search') }}' method="GET">

      <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
      <input class="src-input" value="{{ isset($query) ? $query : '' }}"  name="query" type="text" placeholder="Type of search">
    </form>
  </div>

</div><!-- conatiner -->
</header>
