@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
  <form method="post" action="{{url('dashboard/employee/leave/update')}}" enctype="multipart/form-data">
    @csrf
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Leave Information</h4>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{url('dashboard/employee/'.$emp->employee_code.'/leave')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Leave</a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="form-group row mb-3 {{ $errors->has('leave_from') ? ' has-error' : '' }}">
        <label class="col-sm-3 col-form-label col_form_label">Leave From Date<span class="req_star">*</span>:</label>
        <div class="col-sm-7">
          <input type="hidden" name="slug" value="{{$leave->leave_slug}}">
          <input type="hidden" name="code" value="{{$emp->employee_code}}">
          <input type="date" class="form-control form_control" name="leave_from" value="{{date('Y-m-d',strtotime($leave->leave_from))}}">
          @if ($errors->has('leave_from'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('leave_from') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label">Leave To Date:</label>
        <div class="col-sm-7">
          <input type="date" class="form-control form_control" name="leave_to" value="{{date('Y-m-d',strtotime($leave->leave_to))}}">
          @if ($errors->has('leave_to'))
          <span class="invalid-feedback" role="alert" style="display: block;">
              <strong>{{ $errors->first('leave_to') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label">Leave Reason:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="leave_reason" value="{{$leave->leave_reason}}">
          @if ($errors->has('leave_reason'))
          <span class="invalid-feedback" role="alert" style="display: block;">
              <strong>{{ $errors->first('leave_reason') }}</strong>
          </span>
          @endif
        </div>
      </div>
    <div class="card-footer card_footer text-center">
        <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
    </div>
  </form>
</div>
@endsection
