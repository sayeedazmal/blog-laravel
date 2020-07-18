
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ Storage::disk('public')->url('profile/'. Auth::user()->image)}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>

                    <li><a class="dropdown-item"  href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>Sign out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if (Request::is('admin*'))
              <li class="{{ Request:: is('admin/deshboard')? 'active' : '' }}">
                  <a href="{{ route('admin.deshboard') }}">
                      <i class="material-icons">home</i>
                      <span>Deshboard</span>
                  </a>
              </li>
              <li class="{{ Request:: is('admin/tag*')? 'active' : '' }}">
                  <a href="{{ route('admin.tag.index') }}">
                      <i class="material-icons">label</i>
                      <span>Tags</span>
                  </a>
              </li>
              <li class="{{ Request:: is('admin/catagory*')? 'active' : '' }}">
                  <a href="{{ route('admin.catagory.index') }}">
                      <i class="material-icons">label</i>
                      <span>Catagory</span>
                  </a>
              </li>
              <li class="{{ Request:: is('admin/post*')? 'active' : '' }}">
                  <a href="{{ route('admin.post.index') }}">
                      <i class="material-icons">book</i>
                      <span>Post</span>
                  </a>
              </li>

               <li class="{{ Request:: is('admin/authors')? 'active' : '' }}">
                  <a href="{{ route('admin.author') }}">
                      <i class="material-icons">label</i>
                      <span>Author</span>
                  </a>
               </li>

              <li class="{{ Request:: is('admin/panding/post')? 'active' : '' }}">
                  <a href="{{ route('admin.post.panding') }}">
                      <i class="material-icons">book</i>
                      <span>PandingPost</span>
                  </a>
              </li>

              <li class="{{ Request:: is('admin/subscribe')? 'active' : '' }}">
                  <a href="{{ route('admin.subscribe.index') }}">
                      <i class="material-icons">book</i>
                      <span>Subscriber</span>
                  </a>
              </li>
              <li class="{{ Request:: is('admin/favorite')? 'active' : '' }}">
                  <a href="{{ route('admin.favorite.index') }}">
                      <i class="material-icons">favorite</i>
                      <span>Favorite</span>
                  </a>
              </li>
              <li class="{{ Request:: is('admin/comments')? 'active' : '' }}">
                  <a href="{{ route('admin.comment.index') }}">
                      <i class="material-icons">comment</i>
                      <span>Comments</span>
                  </a>
              </li>

              <li class="header">
                Syestem
              </li>
              <li class="{{ Request:: is('admin/settings')? 'active' : '' }}">
                  <a href="{{ route('admin.settings') }}">
                      <i class="material-icons">settings</i>
                      <span>Settings</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('admin.deshboard') }}">

                      <li><a class="dropdown-item"  href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <i class="material-icons">input</i><span>LogOut</span>
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
                  </a>
              </li>

            @endif
            @if (Request::is('author*'))
              <li class="{{ Request:: is('author/deshboard')? 'active' : '' }}">
                  <a href="{{ route('author.deshboard') }}">
                      <i class="material-icons">home</i>
                      <span>Deshboard</span>
                  </a>
              </li>
              <li class="{{ Request:: is('author/post*')? 'active' : '' }}">
                  <a href="{{ route('author.post.index') }}">
                      <i class="material-icons">book</i>
                      <span>Post</span>
                  </a>
              </li>

              <li class="{{ Request:: is('author/favorite')? 'active' : '' }}">
                  <a href="{{ route('author.favorite.index') }}">
                      <i class="material-icons">favorite</i>
                      <span>Favorite</span>
                  </a>
              </li>
              <li class="{{ Request:: is('author/comments')? 'active' : '' }}">
                  <a href="{{ route('author.comment.index') }}">
                      <i class="material-icons">comment</i>
                      <span>Comments</span>
                  </a>
              </li>
              <li class="header">
                Syestem
              </li>
              <li class="{{ Request:: is('author/settings')? 'active' : '' }}">
                  <a href="{{ route('author.settings') }}">
                      <i class="material-icons">settings</i>
                      <span>Settings</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('author.deshboard') }}">

                      <li><a class="dropdown-item"  href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <i class="material-icons">input</i><span>LogOut</span>
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
                  </a>
              </li>

            @endif



        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2020 - 2021 <a href="javascript:void(0);">Admin</a>.
        </div>
        <div class="version">
            <b>Verson: </b> Beta
        </div>
    </div>
    <!-- #Footer -->
</aside>
