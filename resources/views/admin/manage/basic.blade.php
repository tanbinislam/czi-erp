@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/manage/basic/update')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Basic Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/manage/contact')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>Contact Information</a>
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
                  <label class="col-sm-3 col-form-label col_form_label">Company Name<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="name" value="{{$basic->basic_company}}"/>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Company Title:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="title" value="{{$basic->basic_title}}"/>
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Main Logo:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="pic" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id="img-upload"/>
                  </div>
                  <div class="col-md-2">
                    @if($basic->basic_logo!='')
                      <img class="img-thumbnail img100" src="{{asset('uploads/basic/'.$basic->basic_logo)}}"/>
                    @else
                      <img class="img-thumbnail img100" src="{{asset('uploads/avatar/noimg.jpg')}}"/>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Favicon:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="favicon" id="imgInpFavicon">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id="img-upload-favicon"/>
                  </div>
                  <div class="col-md-2">
                    @if($basic->basic_favicon!='')
                      <img class="img-thumbnail img100" src="{{asset('uploads/basic/'.$basic->basic_favicon)}}"/>
                    @else
                      <img class="img-thumbnail img100" src="{{asset('uploads/avatar/noimg.jpg')}}"/>
                    @endif
                  </div>
              </div>
              <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Footer Logo:</label>
                  <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file btnu_browse">
                                Browse… <input type="file" name="flogo" id="imgInpFlogo">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id="img-upload-flogo"/>
                  </div>
                  <div class="col-md-2">
                    @if($basic->basic_flogo!='')
                      <img class="img-thumbnail img100" src="{{asset('uploads/basic/'.$basic->basic_flogo)}}"/>
                    @else
                      <img class="img-thumbnail img100" src="{{asset('uploads/avatar/noimg.jpg')}}"/>
                    @endif
                  </div>
              </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
