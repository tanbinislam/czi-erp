@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/supplier/update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Edit Supplier Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/supplier')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Supplier</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-7">
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
                  <div class="col-md-2"></div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Supplier Name<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="hidden" name="id" value="{{$data->supplier_id}}">
                  <input type="text" class="form-control form_control" name="name" value="{{$data->supplier_name}}">
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Phone Number<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="phone" value="{{$data->supplier_phone}}">
                  @if ($errors->has('phone'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Email Address:</label>
                <div class="col-sm-7">
                  <input type="email" class="form-control form_control" name="email" value="{{$data->supplier_email}}">
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('company') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label"> Company Name:<span class="req_star"></span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="company" value="{{$data->supplier_company}}">
                  @if ($errors->has('company'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('company') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('website') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label"> Website:<span class="req_star"></span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="website" value="{{$data->supplier_website}}">
                  @if ($errors->has('website'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('website') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('preadd') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label"> Address:<span class="req_star"></span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="preadd" value="{{$data->supplier_address}}">
                  @if ($errors->has('preadd'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('preadd') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-3 {{ $errors->has('previous_due_amount') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label"> Previous Due Amount:<span class="req_star"></span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="previous_due_amount" value="{{ $data->previous_due_amount }}">
                  @if ($errors->has('previous_due_amount'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('previous_due_amount') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="pic" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    @if($data->supplier_photo!='')
                    <img height="100" class="img-thumbnail img100" src="{{asset('uploads/supplier/'.$data->supplier_photo)}}"/>
                    @else
                    <img id="img-upload"/>
                    @endif
                  </div>
              </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">SUBMIT</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
