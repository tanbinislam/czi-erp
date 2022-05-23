@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action="{{url('dashboard/shift/submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Shift Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/shift')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Shift</a>
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
              <div class="form-group row mb-3 {{ $errors->has('title') ? ' has-error' : '' }} justify-content-center">
                <div class="col-sm-6">
                    <label class="col-form-label col_form_label">Shift Title<span class="req_star">*</span>:</label>
                    <input type="text" class="form-control form_control" name="title" value="{{old('title')}}">
                  @if ($errors->has('title'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('title') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('time') ? ' has-error' : '' }} justify-content-center">
               <div class="col-sm-6">
                   <div class="row">
                       <div class="col-sm-6">
                           <label class=" col-form-label col_form_label">Start Time<span class="req_star">*</span>:</label>
                           <input type="time"  class="form-control form_control" name="time" value="{{old('time')}}">
                           @if ($errors->has('time'))
                               <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('time') }}</strong>
                      </span>
                           @endif
                       </div>
                       <div class="col-sm-6">
                           <label class=" col-form-label col_form_label">End Time<span class="req_star">*</span>:</label>
                           <input type="time"  class="form-control form_control" name="to_time" value="{{old('to_time')}}">
                           @if ($errors->has('to_time'))
                               <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('to_time') }}</strong>
                      </span>
                           @endif
                       </div>
                   </div>
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
