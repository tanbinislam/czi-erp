@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All Supplier Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/supplier/create/new')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Supplier</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        @if(Session::has('success'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully insert Supplier Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('softSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully delete Supplier Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('upSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully update Supplier Information</strong> {{Session::get('success')}}
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
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Company</th>
                          <th>Photo</th>
                          <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($all as $data)
                      <tr>
                          <td>{{$data->supplier_name}}</td>
                          <td>{{$data->supplier_phone}}</td>
                          <td>{{$data->supplier_email}}</td>
                          <td>{{$data->supplier_company}}</td>
                          <td>
                            @if($data->supplier_photo!='')
                              <img class="img-thumbnail img50" src="{{asset('uploads/supplier/'.$data->supplier_photo)}}"/>
                            @else
                              <img class="img-thumbnail img50" src="{{asset('uploads/avatar/avatar-black.png')}}"/>
                            @endif
                          </td>
                          <td>
                              <a href='{{url("dashboard/supplier/$data->supplier_slug")}}' title="Profile"><i class="fas fa-plus-square view_icon"></i></a>
                              <a href='{{url("dashboard/supplier/view/$data->supplier_slug")}}' title="view"><i class="fas fa-eye view_icon text-info"></i></a>
                              <a href="{{url('dashboard/supplier/edit/'.$data->supplier_slug)}}" title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                              @if (auth()->user()->hasRole('Super Admin'))
                              <a href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->supplier_id}}"><i class="fas fa-trash delete_icon"></i></a>    
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
    <form method="post" action="{{url('dashboard/supplier/softdelete')}}">
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
