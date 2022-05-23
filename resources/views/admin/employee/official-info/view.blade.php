@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
  <div class="card-header card_header">
      <div class="row">
          <div class="col-md-8">
              <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> View Employee Contact Information</h4>
          </div>
          <div class="col-md-4 text-right">
              <a href="{{url('dashboard/employee/'.$emp->employee_code.'/contact/info')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Contact</a>
          </div>
      </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>{{$data->email}}</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>:</td>
              <td>{{$data->phone}}</td>
            </tr>
            <tr>
              <td>Address</td>
              <td>:</td>
              <td>{{$data->address}}</td>
            </tr>
            <tr>
              <td>Registration Time</td>
              <td>:</td>
              <td>{{$data->created_at->format('d-m-Y | h:i:s A')}}</td>
            </tr>
        </table>
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
