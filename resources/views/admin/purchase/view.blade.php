@extends('layouts.admin')
@section('content')
<div class="row" id="purchase-info">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i>Purchase Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a id="apb" href="{{url('dashboard/material/purchase')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>All Purchase</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        @if(Session::has('success'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully insert Purchase Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('softSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully delete Purchase Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('upSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully update Purchase Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('error'))
                          <div class="alert alert-danger alerterror" role="alert">
                             <strong>Opps!</strong> {{Session::get('error')}}
                          </div>
                        @endif
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                  <div class="col-3 mb-3">
                      <span class="h5">#CHALAN : </span>{{ $materials[0]->mp_chalan }}
                  </div>
                  <div class="col-3 mb-3">
                    <span class="h5">#SUPPLIER : </span>{{ $materials[0]->joinSupplier->supplier_name }}
                  </div>
                  <div class="col-3 mb-3">
                    <span class="h5">#VOUCHER : </span>{{ is_null($materials[0]->mp_voucher) ? '-' : $materials[0]->mp_voucher }}
                  </div>
                  <div class="col-3 mb-3">
                    <span class="h5">#PURCHASE DATE : </span>{{ $materials[0]->mp_date }}
                  </div>
                </div>
                <table id="p-info-table" class="">
                    <thead class="thead-dark">
                      <tr>
                          <th>Material</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total price</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $total_chalan_price = [];
                      @endphp
                      @foreach($materials as $data)
                      <tr>
                          <td>{{$data->joinMaterial->material_name}}</td>
                          <td>{{$data->mp_quantity}}</td>
                          <td>{{number_format($data->mp_unit_price, 2)}} TK</td>
                          <td>{{number_format($data->mp_quantity * $data->mp_unit_price, 2)}} TK</td>
                          @php
                            $total_chalan_price[] = $data->mp_quantity * $data->mp_unit_price;
                          @endphp
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot class="thead-dark">
                      <tr>
                          <th style="color: #fff; background-color: #343a40; border-color: #454d55;" colspan="3" class="text-right">Total Chalan Price</th>
                          <th style="color: #fff; background-color: #343a40; border-color: #454d55;" class="text-success">{{ number_format(array_sum($total_chalan_price), 2) }}TK</th>
                      </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer card_footer">
              <div class="btn-group mt-2" role="group">
                  <a href="javascript:window.print()" class="btn btn-dark" id="print-btn">Print</a>
              </div>
            </div>
        </div>
    </div>
</div>
<!--softdelete modal start-->
<div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/material/purchase/softdelete')}}">
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
@push('css')
    <style>
        #p-info-table{
            width: 100%;
        }

        #p-info-table thead{
            background-color: #343a40;
            color: #fff;
        }

        #p-info-table thead tr th, #p-info-table tfoot tr th{
            padding: 15px 20px;
        }

        #p-info-table tbody tr td{
            padding: 15px 20px;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #purchase-info, #purchase-info * {
                visibility: visible;
            }

            #print-btn, #apb{
                visibility: hidden;
            }

            #p-info-table thead th{
            background:#343a40;
            color: #fff;
            }
        }
    </style>    
@endpush
@endsection
