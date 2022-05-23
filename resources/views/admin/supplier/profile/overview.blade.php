@extends('admin.supplier.main.profile')
@section('supplier')
    <div class="card">
        <div class="card-header card_header">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Material Supply Report</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if(isset($supplier))
                    <div class="col-md-12">
                        <table id="alltableinfo"
                               class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Purchase Date</th>
                                <th>Chalan</th>
                                <th>Material Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supplier->materialSupply as $data)
                                <tr>
                                    <td>{{ date('d-M,Y',strtotime($data->mp_date)) }}</td>
                                    <td>{{ $data->mp_chalan ?: '' }}</td>
                                    <td>{{ isset($data->joinMaterial) ?$data->joinMaterial->material_name : ''  }}</td>
                                    <td>{{ $data->mp_quantity ?: '' }}</td>
                                    <td>{{ $data->mp_unit_price ?: '' }}</td>
                                    <td>{{ $data->mp_total_price ?: '' }}</td>
                                    <td>
                                        <a href="" title="view"><i class="fas fa-plus-square view_icon"></i></a>
                                        <a href="" title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                                        @if (auth()->user()->hasRole('Super Admin'))
                                        <a href="#" id="softDelete" title="delete" data-toggle="modal"
                                           data-target="#softDelModal" data-id="{{$data->material_id}}"><i
                                                class="fas fa-trash delete_icon"></i></a>
                                        @endif
                                        
                                    </td>
                                </tr>

                            @endforeach

                            <tr>
                                <td colspan="5" class="text-center"><strong
                                        style="font-size: 20px">{{"Total Price"}}</strong></td>
                                <td colspan="2"><strong>{{ isset($supplier) ? $supplier->totalPrice() :'' }}</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

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
    <div class="card">
        <div class="card-header card_header">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Supplier Payment Summery</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if(isset($supplier))
                    <div class="col-md-12">
                        <table id="alltableinfo"
                               class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Total Price</th>
                                <th>Due Price</th>
                                <th>Payable Price</th>
                                <th>Total Paid</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>{{ isset($supplier) ? $supplier->totalPrice() :'' }}</td>
                                <td><strong
                                        class="text-danger">{{ ($supplier->previous_due_amount + $supplier->totalPrice())-$supplier->totalPayablePrice() }}</strong>
                                </td>
                                <td>{{ ($supplier->previous_due_amount + $supplier->totalPrice())-$supplier->totalPayablePrice() }}</td>
                                <td>{{ $supplier->totalPayablePrice() }}</td>
                            </tr>


                            <tr>
                                <td colspan="3" class="text-center"><strong
                                        style="font-size: 20px">{{"Total Paid"}}</strong></td>
                                <td colspan="2">
                                    <strong>{{ isset($supplier) ? $supplier->totalPayablePrice() :'' }}</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-header card_header">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Supplier Payment Report</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if(isset($supplier))
                    <div class="col-md-12">
                        <table id="alltableinfo"
                               class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Paid Date</th>
                                <th>Paid Price</th>
                                <th>Paid By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supplier->supplyPayment as $payment)
                                <tr>
                                    <td>{{ $payment->paid_date }}</td>
                                    <td>{{ $payment->payable_amount }}</td>
                                    <td>{{ isset($payment->user) ? $payment->user->name : '' }}</td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="1" class="text-center"><strong
                                            style="font-size: 20px">{{"Total Paid"}}</strong></td>
                                    <td colspan="2">
                                        <strong>{{ isset($supplier) ? $supplier->totalPayablePrice() :'' }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
            {{--  <div class="col-md-4">
                  <div class="media mb-4">
                      <div class="media-body">
                          <p class="text-muted font-weight-medium profile_highlight_heading">Employee ID</p>
                          <h4 class="profile_highlight_text">{{'#'}}</h4>
                      </div>
                  </div>
                  <div class="media mb-4">
                      <div class="media-body">
                          <p class="text-muted font-weight-medium profile_highlight_heading">Employee Name</p>
                          <h4 class="profile_highlight_text">{{'#'}}</h4>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="media mb-4">
                      <div class="media-body">
                          <p class="text-muted font-weight-medium profile_highlight_heading">Employee Phone</p>
                          <h4 class="profile_highlight_text">{{'#'}}</h4>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="media mb-4">
                      <div class="media-body">
                          <p class="text-muted font-weight-medium profile_highlight_heading">Employee Email</p>
                          <h4 class="profile_highlight_text">{{'#'}}</h4>
                      </div>
                  </div>
              </div>--}}

        </div>
        <div class="card-footer card_footer">
            <div class="btn-group mt-2" role="group">
                <a id="print-btn" href="{{ url('dashboard/supplier/'.$supplier->supplier_slug.'/print-report') }}" class="btn btn-dark">PRINT REPORT</a>
            </div>
        </div>
    </div>
@endsection
