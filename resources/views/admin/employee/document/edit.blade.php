@extends('admin.employee.main.profile')
@section('employee')
@php
  $employeeID=$emp->employee_id;
@endphp
<div class="card">
  <form method="post" action="{{url('dashboard/employee/document/update')}}" enctype="multipart/form-data">
    @csrf
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Document Information</h4>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{url('dashboard/employee/'.$emp->employee_code.'/document')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Document</a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="form-group row mb-3 {{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-sm-3 col-form-label col_form_label"> Title<span class="req_star">*</span>:</label>
        <div class="col-sm-7">
          <input type="hidden" name="code" value="{{$emp->employee_code}}">
          <input type="hidden" name="employee" value="{{$employeeID}}">
          <input type="hidden" name="id" value="{{$data->id}}">
          <input type="text" class="form-control form_control" name="title" value="{{$data->title}}">
          @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row mb-3 {{ $errors->has('subtitle') ? ' has-error' : '' }}">
        <label class="col-sm-3 col-form-label col_form_label">Sub-title<span class="req_star">*</span>:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="subtitle" value="{{$data->sub_title}}">
          @if ($errors->has('subtitle'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('subtitle') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label_modal">Photo:</label>
        <div class="col-sm-4">
          <input type="file" class="form-control form_control_modal" name="pic">
        </div>
        <div class="col-sm-4">
          <img height="150" src="{{asset('uploads/document/'.$data->image)}}">
        </div>
      </div>
    </div>
    <div class="card-footer card_footer text-center">
        <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
    </div>
  </form>
</div>
@endsection
