@extends('layouts.admin')
@section('content')
<div class="row">
  {{-- @if($errors->any())
              
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif --}}
    <div class="col-12">
      <form method="post" action="{{url('dashboard/employee/submit')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Employee Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/employee')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Employee</a>
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
              <div class="form-group row mb-3 {{ $errors->has('employee_code') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Employee ID<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="employee_code" value="{{old('employee_code')}}">
                  @if ($errors->has('employee_code'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('employee_code') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Employee Name<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="name" value="{{old('name')}}">
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('father') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Father Name<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="father" value="{{old('father')}}">
                  @if ($errors->has('father'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('father') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('mother') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Mother Name<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="mother" value="{{old('mother')}}">
                  @if ($errors->has('mother'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('mother') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('dob') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Date of Birth<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <input type="text" class="form-control form_control" id="birththday" name="dob" value="{{old('dob')}}">
                    @if ($errors->has('dob'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('nid') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Employee NID:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="nid" value="{{old('nid')}}">
                  @if ($errors->has('nid'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('nid') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Phone Number<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="phone" value="{{old('phone')}}">
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
                  <input type="email" class="form-control form_control" name="email" value="{{old('email')}}">
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('preadd') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Present Address<span class="req_star">*</span>:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="preadd" value="{{old('preadd')}}">
                  @if ($errors->has('preadd'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('preadd') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('paradd') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Parmanent Address:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form_control" name="paradd" value="{{old('paradd')}}">
                  @if ($errors->has('paradd'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('paradd') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('blood') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Blood Group:</label>
                <div class="col-sm-4">
                  @php
                    $eBlood=App\Models\BloodGroup::where('blood_status',1)->get();
                  @endphp
                  <select class="form-control" name="blood" >
                    <option class="form_control">SELECT BLOOD GROUP</option>
                    @foreach($eBlood as $blood)
                    <option class="form_control" value="{{$blood->blood_id}}" {{ $blood->blood_id == old('blood') ? 'selected' : '' }}>{{$blood->blood_name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('blood'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('blood') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('desig_id') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Designation:</label>
                <div class="col-sm-4">
                  @php
                    $designations=App\Models\Designation::where('designation_status',1)->get();
                  @endphp
                  <select class="form-control" name="desig_id" >
                    <option class="form_control">SELECT DESIGNATION</option>
                    @foreach($designations as $designation)
                    <option class="form_control" value="{{$designation->designation_id}}" {{ $designation->designation_id == old('desig_id') ? 'selected' : '' }}>{{$designation->designation_name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('desig_id'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('desig_id') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('employee_maritial') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Maritial Status:</label>
                <div class="col-sm-4">
                  <select class="form-control" name="employee_maritial" >
                    <option class="form_control" value="">SELECT MARITIAL STATUS</option>
                    <option class="form_control" value="Unmarried" {{ old('employee_maritial') == 'Unmarried' ? 'seelected' : ''  }}>Unmarried</option>
                    <option class="form_control" value="Married" {{ old('employee_maritial') == 'Married' ? 'seelected' : ''  }}>Married</option>
                  </select>
                  @if ($errors->has('employee_maritial'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('employee_maritial') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="form-group row mb-3 {{ $errors->has('department') ? ' has-error' : '' }}">
                <label class="col-sm-3 col-form-label col_form_label">Department:</label>
                <div class="col-sm-4">
                  @php
                    $departments=App\Models\Department::where('department_status',1)->get();
                  @endphp
                  <select class="form-control" name="department" >
                    <option class="form_control">SELECT DEPERTMENT</option>
                    @foreach ($departments as $department)
                      <option class="form_control" value="{{$department->department_id}}" {{ $department->department_id == old('department_id') ? 'selected' : ''  }}>{{ $department->department_name }}</option>
                    @endforeach
                    </select>
                  @if ($errors->has('department'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('department') }}</strong>
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
                    <img id="img-upload"/>
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
