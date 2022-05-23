@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="post" action='{{url("dashboard/payroll/employee_payment_view/$employeePaymentView->id")}}' enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Employee Payment
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('dashboard/payroll/employee_payment_view')}}"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-th label-icon"></i>All Employee Payment</a>
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
                        <div class="form-group row mb-3 {{ $errors->has('employee_id') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Employee Name<span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form_control" value="{{$employee->employee_name}}" disabled>
                                <input type="hidden" id="employeeId" name="employee_id" value="{{$employee->employee_id}}">
                                <input type="hidden" name="salary_type" value="{{$employee->salarySetups->salary_type}}" id="salaryType">
                                @if ($errors->has('employee_id'))
                                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('employee_id') }}</strong>
                      </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3 {{ $errors->has('basic_salary') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Basic salary <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input readonly type="number" id="basicSalary" class="form-control form_control"
                                       name="basic_salary" value="{{ isset($employeePaymentView->employee)? $employeePaymentView->employee->official ? $employeePaymentView->employee->official->salary : '' : ''}}">
                                @if ($errors->has('basic_salary'))
                                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('basic_salary') }}</strong>
                      </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 ">
                            <label class="col-sm-3 col-form-label col_form_label">Gross Salary <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input readonly type="number" id="grossSalaryOnly" class="form-control form_control"
                                       value="{{ isset($employeePaymentView->employee)? $employeePaymentView->employee->salarySetups ? $employeePaymentView->employee->salarySetups->gross_salary : '' : ''}}">

                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Month of salary <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-3">
                                <input {{$employee->salarySetups->salary_type == 'Daily' ? 'disabled' : ''}} type="month" id="s_month" class="form-control" name="month" value="{{$employeePaymentView->month}}">
                                @if ($errors->has('month'))
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label class=" col-form-label col_form_label">Daily Salary Date <span class="req_star">*</span>:</label>
                            <div class="col-sm-3">
                                
                                <select class="form-control form_control" id="ds_date" name="ds_date" {{$employee->salarySetups->salary_type == 'Salary' ? 'disabled' : ''}}>
                                    <option value="">Select Salary Date</option>
                                    <option value="{{ $employeePaymentView->ds_date }}" selected>{{ $employeePaymentView->ds_date }}</option>
                                    @foreach ($dates->pluck('date') as $date)
                                        <option value="{{date('Y-m-d', strtotime($date))}}">{{$date}}</option>                                        
                                    @endforeach
                                </select>
                                @if ($errors->has('ds_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ds_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 {{ $errors->has('overtime_salary') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Overtime salary :</label>
                            <div class="col-sm-7">
                                <input readonly type="text" id="overtimeSalary" class="form-control form_control"
                                       name="overtime_salary" value="{{$employeePaymentView->overtime_salary}}">
                                @if ($errors->has('overtime_salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('overtime_salary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 {{ $errors->has('bonus') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Bonus <span class="req_star"></span>:</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control form_control" id="bonus" name="bonus" value="{{ $employeePaymentView->bonus }}">
                                @if ($errors->has('bonus'))
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $errors->first('bonus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3 {{ $errors->has('total_salary') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Total salary <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input readonly type="text" id="grossSalary" class="form-control form_control"
                                       name="total_salary" value="{{ $employeePaymentView->total_salary }}">
                                @if ($errors->has('total_salary'))
                                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('total_salary') }}</strong>
                      </span>
                                @endif
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
    <script type="text/javascript">
        $(document).ready(function () {

            
                // $("#basicSalary").val(null);
                // $("#bonus").val(null);
                // $("#grossSalary").val(null);
                // $("#grossSalaryOnly").val(null);
                let employeeId = $("#employeeId").val();
                var grossSalary = null;
                $.ajax({
                    url: '{{ url("dashboard/payroll/get_employee_payment") }}',
                    method: "post",
                    data: {
                        '_token': ' {{ csrf_token() }}',
                        employee_id: employeeId
                    },
                    success: function (response) {
                        $("#basicSalary").val(response.data.official.salary);
                        $("#grossSalaryOnly").val(response.data.salary_setups.gross_salary);
                        $("#grossSalary").val(response.data.salary_setups.gross_salary);
                        grossSalary = response.data.salary_setups.gross_salary;
                        $("#bonus").keyup(function () {
                            var bonus = $(this).val();
                            let overtime = $("#overtimeSalary").val();
                            let totalSalary = (parseFloat(bonus) + parseFloat(grossSalary) + parseFloat(overtime));
                            $("#grossSalary").val(parseFloat(totalSalary).toFixed(2));
                        })

                        $("#s_month, #ds_date").change(function(){
                            let date = $(this).val();
                            
                            $.ajax({
                                url: '{{ url("dashboard/employee/payment/overtime") }}',
                                method: "post",
                                data: {
                                    '_token': ' {{ csrf_token() }}',
                                    employee_id: employeeId,
                                    date: date,
                                },
                                success: function (data) {
                                    $("#overtimeSalary").val(parseFloat(data.overtime).toFixed(2));
                                    let totalSalary = parseFloat(grossSalary) + parseFloat(data.overtime);
                                    $("#grossSalary").val(parseFloat(totalSalary).toFixed(2));
                                }
                            })
                        });

                    }
                });
           
        })
    </script>
@endpush
