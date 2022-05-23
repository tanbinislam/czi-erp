@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> All Shift Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/shift/add')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-plus-circle label-icon"></i>Add Shift</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                        @if(Session::has('success'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully insert shift Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('softSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully delete shift Information</strong> {{Session::get('success')}}
                          </div>
                        @endif
                        @if(Session::has('upSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                             <strong>Success! Successfully update shift Information</strong> {{Session::get('success')}}
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
                          <th>Title</th>
                          <th>Time</th>
                          <th>Total Hours (Excluding Lunnch Hour)</th>
                          <th>Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($all as $data)
                      <tr>
                          <td>{{$data->title}}</td>
                          <td>{{ date('h:i A', strtotime($data->time)).' - '.date('h:i A', strtotime($data->to_time)) }}</td>
                          @php
                            if($data->time > $data->to_time){
                              $total_hours = date_diff(date_create(date('Y-m-d', time()).$data->time), date_create(date('Y-m-d', strtotime('tomorrow')).$data->to_time))->h - 1;
                            }else{
                              $total_hours = date_diff(date_create(date('Y-m-d', time()).$data->time), date_create($data->to_time))->h - 1;
                            }
                            // dd(date_create(date('Y-m-d', time()).$data->time), date_create(date('Y-m-d', strtotime('tomorrow')).$data->to_time));
                          @endphp
                          <td>{{ $total_hours < 10 ? '0'.$total_hours : $total_hours }} HR</td>
                          <td>
                              <a href="{{url('dashboard/shift/edit/'.$data->id)}}" title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                              @if (auth()->user()->hasRole('Super Admin'))
                              <a href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->id}}"><i class="fas fa-trash delete_icon"></i></a>    
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
    <form method="post" action="{{url('dashboard/shift/softdelete')}}">
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
