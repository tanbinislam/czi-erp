@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="post" action='{{url("dashboard/payroll/employee_payment_view")}}' enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Employee Payment
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('dashboard/payroll/employee_payment_view/')}}"
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
                                <select class="form-control form_control" id="employeeId" name="employee_id">
                                    <option value="">Select Employee Name</option>
                                    @foreach( $employees as $employee)
                                        <option
                                            value="{{ $employee->employee_id }}">{{ $employee->employee_name ?: '' }}</option>
                                    @endforeach
                                </select>
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
                                       name="basic_salary" value="">
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
                                        value="">

                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Month of salary <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-3">
                                <input type="month" id="s_month" class="form-control" name="month">
                                @if ($errors->has('month'))
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label class=" col-form-label col_form_label">Daily Salary Date <span class="req_star">*</span>:</label>
                            <div class="col-sm-3">
                                <select class="form-control form_control" name="ds_date" id="ds_date">
                                    <option value="">Select Salary Date</option>
                                </select>
                                <input type="hidden" name="salary_type" value="" id="salaryType">
                                {{-- <input type="date" id="ds_date" class="form-control" name="ds_date"> --}}
                                @if ($errors->has('ds_date'))
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $errors->first('ds_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 {{ $errors->has('overtime_salary') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Overtime salary :</label>
                            <div class="col-sm-7">
                                <input readonly type="text" id="overtimeSalary" class="form-control form_control"
                                       name="overtime_salary" value="">
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
                                <input type="number" class="form-control form_control" id="bonus" name="bonus" value="">
                                @if ($errors->has('bonus'))
                                    <span class="invalid-feedback" role="alert">
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
                                       name="total_salary" value="">
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
            var employeeId = null;
            var grossSalary = null;
            $("#overtimeSalary").val(0);
            $("#bonus").val(0);
            $("#basicSalary").val(0);
            $("#grossSalaryOnly").val(0);
            $("#grossSalary").val(0);

            $("#employeeId").change(function () {
                employeeId = $(this).val();
                $("#grossSalaryOnly").val(null);
                $("#ds_date").html('<option value="">Select Salary Date</option>')
                $.ajax({
                    url: '{{ url("dashboard/payroll/get_employee_payment") }}',
                    method: "post",
                    data: {
                        '_token': ' {{ csrf_token() }}',
                        employee_id: employeeId
                    },
                    success: function (response) {
                        console.log(response);
                        $("#basicSalary").val(response.data.official.salary);
                        $("#grossSalaryOnly").val(response.data.salary_setups.gross_salary);
                        $("#grossSalary").val(response.data.salary_setups.gross_salary);
                        $("#salaryType").val(response.data.official.salary_type);
                        if(response.data.official.salary_type == 'Salary'){
                            $("#ds_date").attr('disabled', 'disabled');
                            $("#s_month").removeAttr('disabled', 'disabled');
                        }else if(response.data.official.salary_type == 'Daily'){
                            $("#s_month").attr('disabled', 'disabled');
                            $("#ds_date").removeAttr('disabled', 'disabled');
                            $.each(response.dates, function(index, value){
                                $("#ds_date").append('<option value="'+value+'">'+value+'</option>')
                            });
                        }
                        grossSalary = parseFloat(response.data.salary_setups.gross_salary);
                        // var grossSalary = $("#grossSalary").val();
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
            });
        })
    </script>
@endpush
