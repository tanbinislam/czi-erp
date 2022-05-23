@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
  <form method="post" action="{{url('dashboard/employee/education/update')}}" enctype="multipart/form-data">
    @csrf
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Educaitional Information</h4>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{url('dashboard/employee/'.$emp->employee_code.'/education')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Certificate</a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="form-group row mb-3 {{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-sm-3 col-form-label col_form_label">Certificate Title<span class="req_star">*</span>:</label>
        <div class="col-sm-7">
          <input type="hidden" name="code" value="{{$emp->employee_code}}">
          <input type="hidden" name="id" value="{{$data->empedu_id}}">
          <input type="hidden" name="slug" value="{{$data->empedu_slug}}">
          <input type="text" class="form-control form_control" name="title" value="{{$data->empedu_title}}">
          @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label">Institute:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="institute" value="{{$data->empedu_institute}}">
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label">Passing Year:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="year" value="{{$data->empedu_year}}">
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label">Result:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="result" value="{{$data->empedu_result}}">
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-sm-3 col-form-label col_form_label">Remarks:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control form_control" name="remarks" value="{{$data->empedu_remarks}}">
        </div>
      </div>
    </div>
    <div class="card-footer card_footer text-center">
        <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
    </div>
  </form>
</div>
@endsection
