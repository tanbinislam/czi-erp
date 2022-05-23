@extends('layouts.admin')
@section('content')
  <div class="row">
      <div class="col-xl-4">
          <div class="card overflow-hidden">
              <div class="bg-soft-primary">
                  <div class="row">
                      <div class="col-7">
                          <div class="text-primary p-3">
                              <h5 class="text-primary">Welcome Back !</h5>
                              <p>You are logged in as {{Auth::user()->roles[0]->name}}</p>
                          </div>
                      </div>
                      <div class="col-5 align-self-end">
                          <img src="{{asset('contents/admin')}}/assets/images/profile-img.png" alt="" class="img-fluid">
                      </div>
                  </div>
              </div>
              <div class="card-body pt-0">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="avatar-md profile-user-wid mb-4 float-left mar_right_10">
                            @if(Auth::user()->photo!='')
                              <img src="{{asset('uploads/users/'.Auth::user()->photo)}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            @else
                              <img src="{{asset('uploads/avatar/avatar-black.png')}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            @endif
                          </div>
                          <div class="pt-2 float-left user_profile_text">
                            <h5 class="font-size-15 text-truncate">{{Auth::user()->name}}</h5>
                            <p class="text-muted mb-0 text-truncate">{{Auth::user()->roles[0]->name}}</p>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="profile_menu">
                            <div class="profile_heading">
                                Navigation
                            </div>
                             <ul>
                              <li><a href="{{ url('/dashboard/account') }}"><i class="fas fa-address-card"></i>Personal Information</a></li>
                              @if (auth()->user()->hasRole('Super Admin'))
                              <li><a href="{{ url('/dashboard/user/edit/'.auth()->user()->slug) }}"><i class="fas fa-clipboard"></i>Update Your Information</a></li>
                              @endif
                              <li><a href="{{ url('/dashboard/account/update-password/'.auth()->user()->slug) }}"><i class="fas fa-key"></i>Update Password</a></li>
                            </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xl-8">
          <div class="row">
              <div class="col-md-4">
                  <div class="card mini-stats-wid">
                      <div class="card-body">
                          <div class="media">
                              <div class="media-body">
                                  <p class="text-muted font-weight-medium">{{ auth()->user()->name }}</p>
                              </div>

                              <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary">
                                  <span class="avatar-title">
                                      <i class="fas fa-user font-size-24"></i>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="card mini-stats-wid">
                      <div class="card-body">
                          <div class="media">
                              <div class="media-body">
                                  <p class="text-muted font-weight-medium">{{ auth()->user()->email }}</p>
                                  
                              </div>

                              <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                  <span class="avatar-title">
                                      <i class="fas fa-at font-size-24"></i>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="card mini-stats-wid">
                      <div class="card-body">
                          <div class="media">
                              <div class="media-body">
                                  <p class="text-muted font-weight-medium">{{ auth()->user()->phone }}</p>
                                  
                              </div>

                              <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                  <span class="avatar-title">
                                      <i class="fas fa-phone font-size-24"></i>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          @if(Session::has('success'))
                <div class="alert alert-success alertsuccess" role="alert">
                   <strong>Success!</strong> {{Session::get('success')}}
                </div>
              @endif
              @if(Session::has('error'))
                <div class="alert alert-danger alerterror" role="alert">
                   <strong>Opps!</strong> {{Session::get('error')}}
                </div>
              @endif
          @yield('account-info')
      </div>
  </div>
@endsection
