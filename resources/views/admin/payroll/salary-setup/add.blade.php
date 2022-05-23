@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="post" action="{{url('dashboard/payroll/salary_setup/')}}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Salary Setup
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('dashboard/payroll/salary_setup')}}"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-th label-icon"></i>All Salary Setup</a>
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
                            <label class="col-sm-3 col-form-label col_form_label">Employee Name<span class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <select id="employeeId" class="form-control form_control" name="employee_id">
                                    <option value="">Select Employee Name</option>
                                    @foreach( $employees as $employee)
                                        @if($employee->salarySetups == null))
                                        <option value="{{$employee->employee_id}}">{{ $employee->employee_name ?: '' }}</option>
                                        @endif
                                        @endforeach
                                </select>
                                @if ($errors->has('employee_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employee_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 {{ $errors->has('salary_type') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Salary Type <span class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input type="text" id="salaryType" readonly class="form-control form_control" name="salary_type" value="{{old('salary_type')}}">
                            </div>
                        </div>
                        <div class="form-group row mb-3 {{ $errors->has('is_percentage') ? ' has-error' : '' }}">
                            <label class="col-sm-3 col-form-label col_form_label">Percentage <span  class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input value="1" style="margin-top: 13px;" class="checkbox" type="checkbox" name="is_percentage" id="ispercentage">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-12">
                                <table style="margin: 0 auto" border="1" width="90%">
                                    <tbody>
                                    <tr>
                                        <td style="padding-bottom: 20px" class="col-sm-6 text-center"><h4
                                                class="addition_title" style="padding: 15px 0 !important;">Addition</h4>
                                            <br>
                                            <table id="add">
                                                <tbody>
                                                <tr>
                                                    <th style="padding-right: 18px;" class="padten">Basic Salary</th>
                                                    <td><input style="margin-bottom: 12px" type="number"
                                                               id="basicSalary"
                                                               name="basic" class="form-control" disabled
                                                               autocomplete="off"></td>
                                                </tr>
                                                @foreach( $salaryTypes as $salaryType)
                                                    <tr>
                                                        <th style="padding-right: 18px;" class="padten">
                                                            {{ $salaryType->name }}
                                                            <span class="percent d-none">(%)</span>
                                                        </th>
                                                        <td>
                                                            <input style="margin-bottom: 12px" type="number"
                                                                   id="amount_{{$salaryType->id}}"
                                                                   class="form-control amount"
                                                                   value=""
                                                                   data-btype="{{$salaryType->type}}">
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>

                                            </table>
                                        </td>
                                        <td style="padding-bottom: 20px" class="col-sm-6 text-center"><h4
                                                style="padding: 15px 0 !important;"
                                                class="">Gross Salary</h4><br>
                                            <div class="form-group row mb-3 justify-content-center {{ $errors->has('gross_salary') ? ' has-error' : '' }}">
                                                <div class="col-sm-10">
                                                    <input type="text" id="grossSalary" readonly class="form-control form_control"
                                                           name="gross_salary"
                                                           value="{{old('gross_salary')}}">
                                                    @if ($errors->has('gross_salary'))
                                                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('gross_salary') }}</strong>
                      </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
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

            $('#ispercentage').change(function () {
                if ($(this).is(':checked')) {
                    $(".padten span").removeClass("d-none");
                } else {
                    $(".padten span").addClass("d-none");
                }
            });

            $('#employeeId').on('change', function () {
                let employeeId = $(this).val();
                $("#basicSalary").val(null);
                $("#salaryType").val(null);
                $("#grossSalary").val(null);
                $(".amount").val(null);

                $.ajax({
                    url: '{{ url("dashboard/payroll/employee/getSalaryType") }}',
                    method: 'post',
                    data: {
                        '_token': ' {{ csrf_token() }}',
                        employee_id: employeeId
                    },
                    success: function (response) {
                        $("#grossSalary").val(response.data.official.salary);
                        $("#basicSalary").val(response.data.official.salary);
                        let basicSalary = parseInt(response.data.official.salary);
                        $("#salaryType").val(response.data.official.salary_type);

                        //total Get grossSalary code
                        $.each(response.salaryType, function (i, val) {
                            $('.amount').keyup(function () {
                                var sum = 0;
                                $(".amount").each(function () {
                                    console.log($(this).data('btype'))
                                    if($(this).data('btype') === 100){
                                        sum += +$(this).val();
                                    }else if($(this).data('btype') === 101){
                                        sum -= +$(this).val();
                                    }
                                    
                                });
                                $("#grossSalary").val(basicSalary + (!isNaN(sum) ? sum : 0));
                            });
                        });

                        $('#ispercentage').change(function () {
                            if ($(this).is(':checked')) {
                                $("#grossSalary").val(basicSalary);
                                $(".amount").val(null);
                                $(".padten span").removeClass("d-none");
                                //total Get grossSalary code
                                $.each(response.salaryType, function (i, val) {
                                    $('.amount').keyup(function () {
                                        var sum = 0;
                                        $(".amount").each(function () {
                                            if($(this).data('btype') === 100){
                                                sum += +$(this).val();
                                            }else if($(this).data('btype') === 101){
                                                sum -= +$(this).val();
                                            }
                                        });
                                        function percentage(num, per)
                                        {
                                            return (num/100)*per;
                                        }
                                        $("#grossSalary").val(basicSalary + percentage(basicSalary,sum));
                                    });
                                });
                            } else {
                                $(".padten span").addClass("d-none");
                                $(".amount").val(null);
                                $("#grossSalary").val(basicSalary);
                                //total Get grossSalary code
                                $.each(response.salaryType, function (i, val) {
                                    $('.amount').keyup(function () {
                                        var sum = 0;
                                        $(".amount").each(function () {
                                            if($(this).data('btype') === 100){
                                                sum += +$(this).val();
                                            }else if($(this).data('btype') === 101){
                                                sum -= +$(this).val();
                                            }
                                        });
                                        $("#grossSalary").val(basicSalary + (!isNaN(sum) ? sum : 0));
                                    });
                                });

                            }
                        });

                    }
                })
            })
        })
    </script>

@endpush

