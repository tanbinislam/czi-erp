@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Employee Personal Information</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
            <div class="media mb-4">
                <div class="media-body">
                    <p class="text-muted font-weight-medium profile_highlight_heading">Employee Name</p>
                    <h4 class="profile_highlight_text">{{$emp->employee_name}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="media mb-4">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Employee Phone</p>
                  <h4 class="profile_highlight_text">{{$emp->employee_phone}}</h4>
              </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="media mb-4">
              <div class="media-body">
                  <p class="text-muted font-weight-medium profile_highlight_heading">Employee Email</p>
                  <h4 class="profile_highlight_text">{{$emp->employee_email}}</h4>
              </div>
          </div>
        </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Father Name</p>
                        <h4 class="profile_highlight_text">{{$emp->employee_father}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Mother Name</p>
                        <h4 class="profile_highlight_text">{{$emp->employee_mother}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Date of Birth</p>
                        <h4 class="profile_highlight_text">{{$emp->employee_dob}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Nid</p>
                        <h4 class="profile_highlight_text">{{$emp->employee_nid}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Designation</p>
                        <h4 class="profile_highlight_text">{{$emp->designation->designation_name}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Department</p>
                        <h4 class="profile_highlight_text">{{$emp->department->department_name}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Maritial Status</p>
                        <h4 class="profile_highlight_text">{{$emp->employee_maritial}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Blood Group</p>
                        <h4 class="profile_highlight_text">{{$emp->blood->blood_name}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media mb-4">
                    <div class="media-body">
                        <p class="text-muted font-weight-medium profile_highlight_heading">Employee Address</p>
                        <h4 class="profile_highlight_text">{{$emp->employee_address}}</h4>
                    </div>
                </div>
              </div>
      </div>
    </div>
    <div class="card-footer card_footer">
      {{-- <div class="btn-group mt-2" role="group">
          <a href="#" class="btn btn-secondary">Print</a>
          <a href="#" class="btn btn-dark">PDF</a>
          <a href="#" class="btn btn-secondary">Excel</a>
      </div> --}}
    </div>
</div>
@endsection
