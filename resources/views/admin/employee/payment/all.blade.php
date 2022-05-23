@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Payment Information</h4>
            </div>
            <div class="col-md-4 text-right">
                
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
              <thead class="thead-dark">
                <tr>
                    <th>Month/Date</th>
                    <th>Bonus</th>
                    <th>Total Paid</th>
                    <th>Pay Slip</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payments as $data)
                <tr>
                    <td>{{is_null($data->month) ? $data->ds_date : $data->month}}</td>
                    <td>{{$data->bonus}}</td>
                    <td>{{$data->total_salary}}</td>
                    <td>
                      <a href="{{url('dashboard/payroll/employee_payment_view/'.$data->id.'/payslip')}}" target="_blank" class="btn btn-success">Print Payslip</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
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
