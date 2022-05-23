@extends('layouts.admin')
@section('content')


    <div class="row">
        <div class="col-12">
            <form method="post" action='{{url("dashboard/material/supplier-payment/add/$supplier->supplier_slug")}}' enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Supplier Payment
                                    Information</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('dashboard/material/supplier-payment')}}"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-th label-icon"></i>All Supplier Payment</a>
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
                        <table id="" class="table table-bordered custom_table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Supplier Name</th>
                                <th>Total Price</th>
                                <th>Due Price</th>
                                <th>Payable price</th>
                                <th>Paid price</th>
                                <th>paid Date</th>

                            </tr>
                            </thead>

                            <tbody>
                            <tr id="form-info">
                                <td colspan="1">
                                    <input type="text" readonly class="form-control form_control" id="quantity"
                                           value="{{$supplier->supplier_name}}">
                                    <input type="number" hidden class="form-control form_control" id="quantity"
                                           name="supplier_id"
                                           value="{{$supplier->supplier_id}}">

                                    @if ($errors->has('supplier_id'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('supplier_id') }}</strong>
                                             </span>
                                    @endif

                                </td>
                                <td><input type="number" readonly class="form-control form_control" id="totalPrice"
                                           value="{{ $supplier->totalPrice()  }}">
                                </td>
                                <td><input type="number" readonly class="form-control form_control" id="duePrice"
                                           value="{{ ($supplier->previous_due_amount + $supplier->totalPrice())-$supplier->totalPayablePrice() }}">
                                </td>
                                <td><input type="number" readonly class="form-control form_control" id="payablePrice"
                                           value="{{ ($supplier->previous_due_amount + $supplier->totalPrice())-$supplier->totalPayablePrice() }}"></td>
                                <td>
                                    <div class=" row {{ $errors->has('payable_amount') ? ' has-error' : '' }}">

                                        <input min="0" step="0.01" type="number" id="paidPrice" class="form-control form_control" name="payable_amount" value="">
                                        @if ($errors->has('payable_amount'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('payable_amount') }}</strong>
                                                </span>
                                        @endif

                                    </div>
                                </td>

                                <td>
                                    <div class=" row {{ $errors->has('paid_date') ? ' has-error' : '' }}">

                                            <input type="date" class="form-control form_control" name="paid_date" value="">
                                            @if ($errors->has('paid_date'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paid_date') }}</strong>
                                                </span>
                                            @endif

                                    </div>
                                </td>

                            </tr>
                            </tbody>
                            <tbody>


                            </tbody>
                        </table>

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
        (function($) {
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            };
        }(jQuery));

        // let due = $("#duePrice").val();
        // let payable = $("#payablePrice").val();
        // $("#paidPrice").keyup(function () {
        //     let paid = parseInt($(this).val());
        //     let result = due - paid;
        //     $(this).inputFilter(function(value) {
        //         return /^\d*$/.test(value) && (value === "" || parseInt(value) <= payable); });
        //     return $("#duePrice").val(result);
        // });


    </script>
@endpush

