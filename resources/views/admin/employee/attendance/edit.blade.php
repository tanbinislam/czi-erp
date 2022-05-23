@extends('layouts.admin')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
      <form method="post" action='{{url("dashboard/attendance/$employeeAttendance->id/update")}}' enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Update Attendance Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/attendance')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Attendance</a>
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
                <div class="form-group row mb-3 {{ $errors->has('employee_id') ? ' has-error' : '' }} justify-content-center">
                    <div class="col-sm-6">
                        <label class="col-form-label col_form_label">Employee Name<span class="req_star">*</span>:</label>
                        <input type="text" disabled  class="form-control form_control" name="employee_id" value="{{ isset($employeeAttendance->employee) ? $employeeAttendance->employee->employee_name : '' }}">

                    @if ($errors->has('employee_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('employee_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

              <div class="form-group row mb-3 {{ $errors->has('intime') ? ' has-error' : '' }} justify-content-center">
               <div class="col-sm-6">
                   <div class="row">
                       <div class="col-sm-6">
                           <label class=" col-form-label col_form_label">In Time<span class="req_star">*</span>: {{ date('h:i A', strtotime($employeeAttendance->intime)) }}</label>
                           <input type="time"  class="form-control form_control" name="intime" value="{{ $employeeAttendance->intime }}">
                           @if ($errors->has('intime'))
                               <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('intime') }}</strong>
                      </span>
                           @endif
                       </div>
                       <div class="col-sm-6">
                           <label class="col-form-label col_form_label">Out Time<span class="req_star">*</span>: {{ date('h:i A', strtotime($employeeAttendance->outtime)) }} </label>
                           <input type="time"  class="form-control form_control" name="outtime" value="{{ $employeeAttendance->outtime }}">
                       @if ($errors->has('outtime'))
                               <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('outtime') }}</strong>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.employeeName').select2();
    });
</script>
@endpush
