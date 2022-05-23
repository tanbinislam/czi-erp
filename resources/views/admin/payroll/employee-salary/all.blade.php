@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card_header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All Employee Payment List
                            </h4>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{url('dashboard/payroll/employee_payment_view/add')}}"
                               class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                    class="fas fa-plus-circle label-icon"></i>Add EMPLOYEE PAYMENT</a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            @if(Session::has('success'))
                                <div class="alert alert-success alertsuccess" role="alert">
                                    <strong>{{Session::get('success')}}</strong>
                                </div>
                            @endif
                            @if(Session::has('softSuccess'))
                                <div class="alert alert-success alertsuccess" role="alert">
                                    <strong>Success! Successfully Employee salary
                                        Information</strong> {{Session::get('success')}}
                                </div>
                            @endif
                            @if(Session::has('upSuccess'))
                                <div class="alert alert-success alertsuccess" role="alert">
                                    <strong>Success! Successfully Employee salary
                                        Information</strong> {{Session::get('success')}}
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
                    <table id="alltableinfo"
                           class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Salary Month /</br> Daily Salary Date</th>
                            <th>Employee Name</th>
                            <th>Total Salary</th>
                            <th>Payment date</th>
                            <th>Paid BY</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all as $data)
                            <tr>
                                <td>{{ is_null($data->month) ? date('d-m-Y', strtotime($data->ds_date)) : date('M-Y', strtotime($data->month)) }}</td>
                                <td>{{ isset($data->employee) ? $data->employee->employee_name : ''}}</td>
                                <td>{{ $data->total_salary ?: '' }}</td>
                                <td>{{ date('d-m-Y',strtotime($data->updated_at)) ?: '' }}</td>
                                <td>{{ isset($data->user) ? $data->user->name : ''}}</td>
                                <td>
                                    @if ($data->is_pay == 1)
                                    <a href="{{url('dashboard/payroll/employee_payment_view/'.$data->id.'/payslip')}}" target="_blank" class="btn btn-success">Print Payslip</a>
                                    @else
                                    <a href="#" class="btn {{ ($data->is_pay == 1)? 'btn-success' : 'btn-warning' }} payBtn" title="paid Payment"
                                        data-id="{{$data->id}}" data-toggle="modal" data-target="#paidPayment">
                                         {{ ($data->is_pay == 1)? 'Paid' : 'Pay Now?' }}
                                     </a>
                                    @endif
                                    

                                </td>
                                <td>
                                    <a href='{{url("dashboard/payroll/employee_payment_view/".$data->id."/edit")}}'
                                       title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                                    @if (auth()->user()->hasRole('Super Admin'))
                                    <a href="#" id="softDelete" title="delete" data-toggle="modal"
                                        data-target="#softDelModal" data-id="{{$data->id}}"><i
                                                class="fas fa-trash delete_icon"></i></a>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer card_footer">
                    {{-- <div class="btn-group mt-2" role="group">
                        <a href="#" class="btn btn-secondary">Print</a>
                        <a href="#" class="btn btn-dark">PDF</a>
                        <a href="#" class="btn btn-secondary">Excel</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!--softdelete modal start-->
    
    <div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" action="{{url('dashboard/payroll/employee_payment_view/delete/soft-delete')}}">
          @csrf
          <div class="modal-content">
            <div class="modal-header modal_header">
                <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
            </div>
            <div class="modal-body modal_card">
              Are you sure you want to delete?
              <input type="hidden" id="modal_id" name="modal_id">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">Confirm</button>
                <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>
   

    <!--softdelete modal start-->
    <div id="paidPayment" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="paidPay" aria-hidden="true">
        <div class="modal-dialog">
            <form id="myForm" method="post" action='{{ url("dashboard/payroll/paid_employee_payment") }}'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header modal_header">
                        <h5 class="modal-title mt-0" id="paidPay"><i class="fab fa-gg-circle"></i> Payment Status</h5>
                    </div>
                    <div class="modal-body modal_card">
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label col_form_label">Employee Name <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input readonly type="text"  id="employeeName" class="form-control form_control"
                                       value="">
                                <input hidden type="text" name="id" id="employeeId" class="form-control form_control"
                                       value="">

                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label col_form_label">Total Salary <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input readonly type="text" id="totalSalary" class="form-control form_control"
                                       name="total_salary" value="">
                                @if ($errors->has('total_salary'))
                                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('total_salary') }}</strong>
                      </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 {{ $errors->has('payment_type') ? ' has-error' : '' }}">
                            <label class="col-sm-4 col-form-label col_form_label">Payment Type <span
                                    class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="paymentType" name="payment_type">
                                    <option value=""></option>
                                    <option value="101" >Cash</option>
                                    <option value="111">Bank</option>
                                </select>

                                <span class="text-danger" id="paymentTypeError"></span>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-dark waves-effect waves-light" id="confirm">Confirm</button>
                        <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
@endsection
@push('scripts')
    <script type="text/javascript">
        $(".payBtn").click(function (e) {
            e.preventDefault();
            let DataId = $(this).data("id");
            $.ajax({
                url:'{{ url("dashboard/payroll/pay_employee_payment") }}',
                method: "post",
                data: {
                    '_token': ' {{ csrf_token() }}',
                    id: DataId,
                },
                success: function (response) {
                    $('#employeeName').val(response.data.employee.employee_name);
                    $('#employeeId').val(response.data.id);
                    $('#totalSalary').val(response.data.total_salary);
                    $("#paymentType").val(response.data.payment_type)
                    if(response.data.is_pay == 1){
                        $("#paymentType").attr('disabled', 'disbaled');
                        $("#confirm").css('display', 'none');
                    }
                },
            });

        })

        $("#confirm").on('click',function () {
            if ($("#paymentType")[0].selectedIndex <= 0) {
                $("#paymentTypeError").text('The payment type id field is required.')
            }else{
                $("#paymentTypeError").hide();
                $('#myForm').submit();
            }
        });

    </script>
@endpush
