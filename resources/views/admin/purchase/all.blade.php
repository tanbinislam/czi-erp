@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All Purchase Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/material/purchase/add')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Purchase</a>
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
                    <div class="col-md-2"></div>
                </div>
                <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                    <thead class="thead-dark">
                      <tr>
                          <th>Purchase Date</th>
                          <th>Chalan</th>
                          <th>Total price</th>
                          <th>Supplier</th>
                          <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($all as $data)
                      <tr>
                          <td>{{$data->mp_date}}</td>
                          <td>
                            <a href="{{url('dashboard/material/purchase/view/'.$data->mp_slug)}}" title="view">
                            {{ $data->mp_chalan ?: ''}}
                            </a>
                          </td>
                          <td>{{$data->mp_quantity * $data->mp_unit_price}}</td>
                          <td>{{$data->joinSupplier->supplier_name}}</td>
                          <td>
                              <a href="{{url('dashboard/material/purchase/view/'.$data->mp_slug)}}" title="view"><i class="fas fa-plus-square view_icon"></i></a>
                              <a href="{{url('dashboard/material/purchase/edit/'.$data->mp_slug)}}" title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
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
@endsection
