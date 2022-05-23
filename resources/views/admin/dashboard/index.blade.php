@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-4">
                      <div class="media">
                          <div class="mr-3">
                            @if(Auth::user()->photo!='')
                              <img src="{{asset('uploads/users/'.Auth::user()->photo)}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            @else
                              <img src="{{asset('uploads/avatar/avatar-black.png')}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            @endif
                          </div>
                          <div class="media-body align-self-center">
                              <div class="text-muted">
                                  <p class="mb-2">Welcome to Dashboard</p>
                                  <h5 class="mb-1">{{Auth::user()->name}}</h5>
                                  <p class="mb-0">{{Auth::user()->roles[0]->name}}</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 align-self-center">
                      <div class="text-lg-center mt-4 mt-lg-0">
                          <div class="row">
                              <div class="col-6">
                                  <div>
                                      <p class="text-muted text-truncate mb-2">Email</p>
                                      <h5 class="mb-0 custom_h5">{{Auth::user()->email}}</h5>
                                  </div>
                              </div>
                              <div class="col-6">
                                  <div>
                                      <p class="text-muted text-truncate mb-2">Phone</p>
                                      <h5 class="mb-0 custom_h5">{{Auth::user()->phone}}</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-2 d-none d-lg-block">
                      <div class="clearfix  mt-3 text-right">
                          <a href="{{url('dashboard/account')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-passport label-icon"></i>Profile</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
