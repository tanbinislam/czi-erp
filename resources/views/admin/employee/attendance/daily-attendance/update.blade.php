@extends('layouts.admin')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style rel="stylesheet">
        .border-red{
            border: 1px solid darkred;
        }
    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        @if(empty(request('date')))
        <form method="get" action="">
        <div class="card">
            <div class="card-header card_header">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Attendance Information</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{url('dashboard/attendance')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Attendance</a>
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

              <div class="form-group row mb-3 {{ $errors->has('date') ? ' has-error' : '' }} justify-content-center">
               <div class="col-sm-6">
                   <div class="row justify-content-center">
                       <div class="col-sm-6">
                           <label class=" col-form-label col_form_label">Date <span class="req_star">*</span>:</label>
                           <input type="date"  class="form-control form_control" name="date" value="{{old('date')}}">
                           @if ($errors->has('date'))
                               <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('date') }}</strong>
                      </span>
                           @endif
                       </div>
                   </div>
               </div>
              </div>
            </div>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">SUBMIT</button>
            </div>
        </div>
      </form>
        @else
        <div class="card-header card_header">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Update Attendance Out-Time Information : Date({{ $_GET['date'] }})</h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{url('dashboard/attendance')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Attendance</a>
                </div>
            </div>
        </div>
        <form method="post" action="{{url('dashboard/attendance/out-time/update-by-day')}}" enctype="multipart/form-data">
            @csrf
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
                              <strong>Success! Successfully delete attendance Information</strong> {{Session::get('success')}}
                          </div>
                      @endif
                      @if(Session::has('upSuccess'))
                          <div class="alert alert-success alertsuccess" role="alert">
                              <strong>Success! Successfully update attendance Information</strong> {{Session::get('success')}}
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
              <table class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                  <thead class="thead-dark">
                  <tr>
                      <th>Employee name</th>
                      <th>Shift</th>
                      <th>In-Time</th>
                      <th>Out-Time</th>
                      <th>Manage</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($employees as $k => $data)
                      <tr>
                          <input type="hidden" name="att_id[]" value="{{ $data->id }}">
                          <td>
                              <input type="text"  class="form-control form_control"  disabled placeholder="{{ isset($data->employee) ? $data->employee->employee_name?: '' :'' }}">

                          </td>
                          <td>
                            <select class="form-control" disabled>
                                <option value="">Select Shift</option>
                                @foreach ($shifts as $shift)
                                    <option disabled value="{{ $shift->id }}" {{ $shift->id == $data->shift_id ? 'selected' : '' }}>{{$shift->title}}</option>
                                @endforeach
                            </select>
                          </td>
                          <td> <input type="time" disabled class="form-control form_control" value="{{$data->intime}}"></td>
                          <td><input type="time"  class="form-control form_control {{ empty($data->outtime)? 'border-red' :'' }} " name="outtime[]" value="{{$data->outtime ?: '--:--'}}"></td>
                          <td>
                              <a href='{{url("dashboard/attendance/$data->id/edit")}}' title="edit"><i class="fas fa-pen-square edit_icon"></i></a>
                              {{--<a href="#" id="softDelete" title="delete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->id}}"><i class="fas fa-trash delete_icon"></i></a>
                      --}}    </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
            <div class="card-footer card_footer text-center">
                <button type="submit" class="btn btn-md btn-dark">SUBMIT</button>
            </div>
          </div>
      </form>
        @endif
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
   /* $(document).ready(function() {
        $('.employeeName').select2();
    });*/

   //select all checkboxes
   $("#checkAll").change(function(){  //"select all" change
       $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
   });




</script>
@endpush
