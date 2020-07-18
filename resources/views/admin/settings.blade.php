@extends('layouts.backend.app')

@section('title','Profile-')


@push('css')

@endpush

@section('content')
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
            <h2>
                                  Settings
            </h2>
            <ul class="header-dropdown m-r--5">
                                  <li class="dropdown">
                                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                          <i class="material-icons">more_vert</i>
                                      </a>
                                      <ul class="dropdown-menu pull-right">
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                          <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                      </ul>
                                  </li>
                              </ul>
      </div>
         <div class="body">
          <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
                                      <a href="#update_profile" data-toggle="tab">
                                          <i class="material-icons">face</i> Update Profile
                                      </a>
                                  </li>
          <li role="presentation">
                                      <a href="#update_password" data-toggle="tab">
                                          <i class="material-icons">face</i> Password
                                      </a>
                                  </li>
          </ul>
              <!-- Tab panes -->
             <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="update_profile">
                <div class="body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}" class="form-horizontal">
                          @csrf
                          @method('PUT')
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name: </label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name = 'name' value='{{ Auth::user()->name }}' id="name" class="form-control" placeholder="name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email_address">Email Address</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name='email' value='{{ Auth::user()->email }}' id="email_address" class="form-control" placeholder="Enter your email address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="about">Profile Image:</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name = 'image' class="form-control-file" id="image"></div>                                       </div>
                                 </div>
                              </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="about">About:</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                             <textarea name ='about' class="form-control" id="about" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="update_password">
              <form method="POST" action="{{ route('admin.password.update') }}" class="form-horizontal">
                @csrf
                @method('PUT')

                  <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                          <label for="old_password">Old Password</label>
                      </div>
                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                          <div class="form-group">
                              <div class="form-line">
                                  <input type="password" name='old_password' id="old_password" class="form-control" placeholder="old email address">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                          <label for="password">New Password</label>
                      </div>
                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                          <div class="form-group">
                              <div class="form-line">
                                  <input type="password" name='password' id="password" class="form-control" placeholder="New Password">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                          <label for="confirmation_password">Confirm Password</label>
                      </div>
                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                          <div class="form-group">
                              <div class="form-line">
                                  <input type="password" name='password_confirmation' id="confirm_password" class="form-control" placeholder="confirm email address">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row clearfix">
                      <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                          <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
       </div>
  </div>
</div>

@endsection


@push('css')

@endpush
