@extends('admin.customer.main.profile')
@section('customer')
    <div class="card">
        <div class="card-header card_header">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Customer Report</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if(isset($customer))
                    <div class="col-md-12">
                        <table id="alltableinfo"
                               class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Purchase Date</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                {{--<th>Manage</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $customer->buyMadeProducts as $data)
                                <tr>
                                    <td>{{ date('d-m-Y',strtotime($data->created_at)) }}</td>
                                    <td>{{ isset($data->products) ? $data->products->name : '' }}</td>

                                    <td>{{ $data->quantity ?: '' }}</td>
                                    <td>{{ $data->price ?: '' }}</td>
                                    <td>{{ $data->quantity * $data->price }}</td>
                                    {{--<td>
                                        <a href="" title="view"><i class="fas fa-plus-square view_icon"></i></a>
                                        <a href="" title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                                        <a href="#" id="softDelete" title="delete" data-toggle="modal"
                                           data-target="#softDelModal" data-id=""><i
                                                class="fas fa-trash delete_icon"></i></a>
                                    </td>--}}
                                </tr>


                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center"><strong
                                        style="font-size: 20px">{{"Total Price"}}</strong></td>
                                <td colspan="2"><strong>{{ $customer->totalPrice() }}</strong>
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
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Customer Payment Summery</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if(isset($customer))
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
                                <td>{{  $customer->totalPrice()  }}</td>
                                <td><strong
                                        class="text-danger">{{  ($customer->previous_due_amount + $customer->totalPrice()) - $customer->totalPayablePrice() }}</strong>
                                </td>
                                <td>{{ ($customer->previous_due_amount + $customer->totalPrice()) - $customer->totalPayablePrice() }}</td>
                                <td>{{ $customer->totalPayablePrice() }}</td>
                            </tr>


                            <tr>
                                <td colspan="3" class="text-center"><strong
                                        style="font-size: 20px">{{"Total Paid"}}</strong></td>
                                <td colspan="2">
                                    <strong></strong></td>
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
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Customer Payment Report</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if(isset($customer))
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
                            @foreach( $customer->paymentView as $data)
                                <tr>
                                    <td>{{ date('d-m-Y',strtotime($data->date)) ?: '' }}</td>
                                    <td>{{ $data->payable_amount ?: '' }}</td>
                                    <td>{{ isset($data->user) ? $data->user->name : '' }}</td>
                                </tr>

                            @endforeach
                                <tr>
                                    <td colspan="1" class="text-center"><strong
                                            style="font-size: 20px">{{"Total Paid"}}</strong></td>
                                    <td colspan="2">
                                        <strong></strong>
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
            {{-- <div class="btn-group mt-2" role="group">
                <a href="#" class="btn btn-secondary">Print</a>
                <a href="#" class="btn btn-dark">PDF</a>
                <a href="#" class="btn btn-secondary">Excel</a>
            </div> --}}
        </div>
    </div>
@endsection
