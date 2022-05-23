@extends('layouts.admin')
@section('content')
  <div class="row">
      <div class="col-xl-3">
          <div class="card overflow-hidden">
              <div class="bg-soft-primary">
                  <div class="row">
                      <div class="col-12">
                          <div class="text-primary p-3">
                              <h5 class="text-primary">Supplier reports</h5>
                             {{-- <p>Supplier </p>--}}
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="offset-7 col-5 align-self-end">
                          <img src="{{asset('contents/admin')}}/assets/images/profile-img.png" alt="" class="img-fluid">
                      </div>
                  </div>
              </div>
              <div class="card-body pt-0">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="avatar-md profile-user-wid mb-4 float-left mar_right_10">
                            @if(isset($supplier->supplier_photo))
                              <img src="{{asset('uploads/supplier/'.$supplier->supplier_photo)}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            @else
                              <img src="{{asset('uploads/avatar/avatar-black.png')}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            @endif
                          </div>
                          <div class="pt-2 float-left user_profile_text">
                            <h5 class="font-size-15 text-truncate">{{$supplier->supplier_name ?: ''}}</h5>
                            <p class="text-muted mb-0 text-truncate"></p>
                          </div>
                      </div>
                  </div>
                  <div class="card-body card_body_menu">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="profile_menu">
                          <div class="profile_heading">
                              Supplier Information
                          </div>
                        {{--  <ul>
                            <li><a href=""><i class="fas fa-address-card"></i>Personal Information</a></li>
                            <li><a href=""><i class="fas fa-graduation-cap"></i>Educaition Information</a></li>
                            <li><a href=""><i class="fas fa-map-marker"></i>Contact Information</a></li>
                            <li><a href=""><i class="fas fa-cloud"></i>Document Information</a></li>
                            <li><a href=""><i class="fas fa-briefcase"></i>Official Information</a></li>
                            <li><a href="#"><i class="fas fa-money-check"></i>Payment Information</a></li>
                            <li><a href=''><i class="fas fa-clipboard-list"></i>Attendance Information</a></li>
                            <li><a href="#"><i class="fas fa-clipboard"></i>Leave Information</a></li>
                            <li><a href="#"><i class="fas fa-box"></i>Others Information</a></li>
                          </ul>--}}

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=" profile_card_footer text-center pt-3">
                      <a href="{{url('dashboard/supplier')}}" class="btn btn-md btn-dark">All Supplier Information</a>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-9">
          <div class="row">
            <div class="col-md-12">
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
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="media">
                                  <div class="media-body">
                                      <p class="text-muted font-weight-medium profile_highlight_heading">Supplier Name</p>
                                      <h4 class="profile_highlight_text">{{ $supplier->supplier_name ?: '' }}</h4>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="media">
                                  <div class="media-body">
                                      <p class="text-muted font-weight-medium profile_highlight_heading">Supplier Email </p>
                                      <h4 class="profile_highlight_text">{{ $supplier->supplier_email ?: '' }}</h4>
                                  </div>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="media">
                                  <div class="media-body">
                                      <p class="text-muted font-weight-medium profile_highlight_heading">Phone Number</p>
                                      <h4 class="profile_highlight_text">{{ $supplier->supplier_phone ?: '' }}</h4>
                                  </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          @yield('supplier')
      </div>
  </div>
@endsection
