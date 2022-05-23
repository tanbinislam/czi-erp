@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> <span style="padding: 2px 4px" class="badge-danger" >{{ $material->material_name .' Material' ?: '' }}</span>  Purchases Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/material/add')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Material</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        @if(Session::has('success'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully insert Material Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('softSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully delete Material Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('upSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully update Material Information</strong> {{Session::get('success')}}
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
                <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Chalan</th>
                        <th>Voucher</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                      {{--  <th>Price</th>
                        <th>Total price</th>
                        <th>Supplier</th>--}}
                        <th>Manage</th>
                    </tr>
                    </thead>
                   <tbody>
                     @foreach( $material->materialPurchases as $data)
                        <tr>
                            <td>{{ $data->mp_date ?: ''}}</td>
                            <td>{{ $data->mp_chalan ?: ''}}</td>
                            <td>{{ $data->mp_voucher ?: ''}}</td>
                            <td>{{ $data->joinSupplier->supplier_name ?: ''}}</td>
                            <td>{{ $data->mp_quantity ?: 0 }}</td>
                            <td>{{ $data->mp_unit_price ?: 0 }}</td>
                            {{--<td>
                                @php( $val = 0)
                                @foreach( $data->materialPurchases as $price )
                                    @php( $val += $price->mp_unit_price)
                                @endforeach
                                {{ $val ?: 0 }}
                            </td>
                            @php( $total = 0)
                            <td>@foreach( $data->materialPurchases as $price )
                                    @php($total+= ($price->mp_quantity * $price->mp_unit_price) )
                                @endforeach
                                {{ $total }}
                            </td>
                            <td>
                                @foreach( $data->materialPurchases as $supplier )
                                    {{ $supplier->joinSupplier->supplier_name.',' }}
                                @endforeach
                            </td>--}}
                            <td>
                                <a href='{{url("dashboard/material/purchase/edit/$data->mp_slug")}}' title="Edit"><i class="fas fa-edit edit_icon"></i></a>
                               {{-- <a href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->mp_id}}"><i class="fas fa-trash delete_icon"></i></a>
                           --}} </td>
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
    <form method="post" action="{{url('dashboard/material/softdelete')}}">
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
@endsection
