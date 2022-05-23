@extends('admin.employee.main.profile')
@section('employee')
    @php
        $employeeID=$emp->employee_id;
    @endphp
    <div class="card">
        <form method="post" action="{{url('dashboard/official-info/update')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Official Information</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row mb-3 {{ $errors->has('salary') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label"> Salary<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                        <input type="hidden" name="code" value="{{$emp->employee_code}}">
                        <input type="hidden" name="employee" value="{{$employeeID}}">
                        <input type="hidden" name="id" value="{{ isset($emp->official) ? $emp->official->id : '' }}">
                        <input type="text" class="form-control form_control" name="salary" value="{{ isset($emp->official) ? $emp->official->salary : '' }}">
                        @if ($errors->has('salary'))
                            <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('salary') }}</strong>
              </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3 {{ $errors->has('salary_type') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label"> Salary Type<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                        <select name="salary_type" id="" class="form-control form_control">
                            <option value="">SELECT TYPE</option>
                            <option value="Salary" {{ isset($emp->official) ? ($emp->official->salary_type == 'Salary' ? 'selected' : '' ) : '' }}>Salary</option>
                            <option value="Daily" {{ isset($emp->official) ? ($emp->official->salary_type == 'Daily' ? 'selected' : '' ) : '' }}>Daily Pay</option>
                        </select>
                        @if ($errors->has('salary_type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('salary_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3 {{ $errors->has('joining_date') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Joining Date<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                        <input type="date" class="form-control form_control" name="joining_date" value="{{ isset($emp->official) ? $emp->official->joining_date : '' }}">
                        @if ($errors->has('joining_date'))
                            <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('joining_date') }}</strong>
              </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Reference:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form_control" name="reference" value="{{ isset($emp->official) ? $emp->official->reference : '' }}">
                    </div>
                </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            </div>
        </form>
    </div>
@endsection
