@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
  <div class="card-header card_header">
      <div class="row">
          <div class="col-md-8">
              <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> View Employee Document Information</h4>
          </div>
          <div class="col-md-4 text-right">
              <a href="{{url('dashboard/employee/'.$emp->employee_code.'/document')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Document</a>
          </div>
      </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_view_table">
            <tr>
              <td>Title</td>
              <td>:</td>
              <td>{{$data->title}}</td>
            </tr>
            <tr>
              <td>Sub-title</td>
              <td>:</td>
              <td>{{$data->sub_title}}</td>
            </tr>
            <tr>
              <td>Image</td>
              <td>:</td>
              <td><img height="200" src="{{asset('uploads/document/'.$data->image)}}"></td>
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
