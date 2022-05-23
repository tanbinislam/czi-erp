@extends('layouts.admin')
@section('content')


    <div class="row">
        <div class="col-12">
            <form method="post" action='{{url("dashboard/customer/payment/$customer->customer_slug")}}' enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header card_header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Customer Payment
                                    Information</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{url('dashboard/customer/payment')}}"
                                   class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i
                                        class="fas fa-th label-icon"></i>All Customer Payment</a>
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
                                <th>Customer Name</th>
                                <th>Total Price</th>
                                <th>Due Price</th>
                                <th>Payable price</th>
                                <th>Paid price</th>
                                <th>Paid Date</th>

                            </tr>
                            </thead>

                            <tbody>
                            <tr id="form-info">
                                <td colspan="1">
                                    <input type="text" readonly class="form-control form_control" id="quantity"
                                           value="{{$customer->customer_name}}">
                                    <input type="number" hidden class="form-control form_control" id="quantity"
                                           name="customer_id"
                                           value="{{$customer->customer_id}}">

                                    @if ($errors->has('customer_id'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('customer_id') }}</strong>
                                             </span>
                                    @endif

                                </td>
                                <td><input type="number" readonly class="form-control form_control" id="totalPrice"
                                           value="{{ $customer->totalPrice() }}">
                                </td>
                                <td><input type="number" readonly class="form-control form_control" id="duePrice"
                                           value="{{ ($customer->previous_due_amount + $customer->totalPrice()) - $customer->totalPayablePrice() }}">
                                </td>
                                <td><input type="number" readonly class="form-control form_control" id="payablePrice"
                                           value="{{ ($customer->previous_due_amount + $customer->totalPrice()) - $customer->totalPayablePrice() }}"></td>
                                <td>
                                    <div class=" row {{ $errors->has('payable_amount') ? ' has-error' : '' }}">

                                        <input {{ $customer->totalPrice()-$customer->totalPayablePrice() == 0 ? 'disabled' : '' }} min="0" step="0.01" type="number" id="paidPrice" class="form-control form_control" name="payable_amount" value="">
                                        @if ($errors->has('payable_amount'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('payable_amount') }}</strong>
                                                </span>
                                        @endif

                                    </div>
                                </td>

                                <td>
                                    <div class=" row {{ $errors->has('date') ? ' has-error' : '' }}">

                                            <input {{ $customer->totalPrice()-$customer->totalPayablePrice() == 0 ? 'disabled' : '' }} type="date" class="form-control form_control" name="date" value="">
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
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
                        <input type="submit" class="btn btn-md btn-dark" value="SUBMIT" {{ $customer->totalPrice()-$customer->totalPayablePrice() == 0 ? 'disabled' : '' }}/>
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
        //    // return $("#duePrice").val(result);
        //     $(this).inputFilter(function(value) {
        //         return /^\d*$/.test(value) && (value === "" || parseInt(value) <= payable); });
        //     return $("#duePrice").val(result);
        // });


    </script>
@endpush

