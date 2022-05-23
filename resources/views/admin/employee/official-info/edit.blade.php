@extends('admin.employee.main.profile')
@section('employee')
@php
  $employeeID=$emp->employee_id;
@endphp
<div class="card">
  <form method="post" action="{{url('dashboard/employee/contact/info/update')}}" enctype="multipart/form-data">
    @csrf
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Contact Information</h4>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{url('dashboard/employee/'.$emp->employee_code.'/contact/info')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Contact</a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="form-group row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-sm-3 col-form-label col_form_label"> Email<span class="req_star">*</span>:</label>
        <div class="col-sm-7">
          <input type="hidden" name="code" value="{{$emp->employee_code}}">
          <input type="hidden" name="employee" value="{{$employeeID}}">
          <input type="hidden" name="id" value="{{$data->id}}">
          <input type="text" class="form-control form_control" name="email" value="{{$data->email}}">
          @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
        <label class="col-sm-3 col-form-label col_form_label">Phone<span class="req_star">*</span>:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="phone" value="{{$data->phone}}">
          @if ($errors->has('phone'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('phone') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label">Remarks:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="address" value="{{$data->address}}">
        </div>
      </div>
    </div>
    <div class="card-footer card_footer text-center">
        <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
    </div>
  </form>
</div>
@endsection
