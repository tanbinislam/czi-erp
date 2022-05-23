@extends('layouts.admin')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                        <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Attendance Information</h4>
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
                    <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Add Attendance Information : Date ({{ $_GET['date'] }})</h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{url('dashboard/attendance')}}" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn"><i class="fas fa-th label-icon"></i>All Attendance</a>
                </div>
            </div>
        </div>
        <form method="post" action="{{url('dashboard/attendance/store')}}" enctype="multipart/form-data">
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
              {{-- @if($errors->any())
              
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif --}}
             
              <table id="" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
                  <thead class="thead-dark">
                  <tr>
                      <th><input type="checkbox" id="checkAll"> Present</th>
                      <th>Employee name</th>
                      <th>Shift</th>
                      <th>In-Time</th>
                      <th>Out-Time</th>
                  </tr>
                  </thead>
                  <tbody>
                      <input type="text"  class="form-control form_control" name="date" hidden value="{{ request('date') ?: '' }}">
                  @foreach($employees as $k => $data)
                      <tr>
                          <td  width="20px">
                              {{-- {{old('employee_id.'.$k)}} --}}
                              <input data-e_id="{{$k}}" type="checkbox" class="checkbox" name="employee_id[]" value="{{ $data->employee_id }}" {{ $data->employee_id == old('employee_id.'.$k) ? 'checked' : '' }}>
                              @if ($errors->has('employee_id'))
                                  <span class="invalid-feedback" role="alert" style="display: block;">
                                      <strong>{{ $errors->first('employee_id') }}</strong>
                                  </span>
                              @endif
                          </td>

                          <td>
                              <input type="text"  class="form-control form_control"  disabled placeholder="{{ $data->employee_name?: '' }}">
                              @if ($errors->has('employee_id.'.$k))
                                  <span class="invalid-feedback" role="alert" style="display: block;">
                                      <strong>{{ $errors->first('employee_id.'.$k) }}</strong>
                                  </span>
                              @endif
                          </td>
                          <td>
                              <select name="shift_id[]" id="s_{{$k}}" class="form-control dabl shift-info" disabled="disabled">
                                  <option value="">Select Shift</option>
                                  @foreach ($shifts as $shift)
                                      <option value="{{ $shift->id }}" {{ $shift->id == old('shift_id.'.$k) ? 'selected' : '' }}>{{$shift->title}}</option>
                                  @endforeach
                              </select>
                              @if ($errors->has('shift_id.'.$k))
                                  <span class="invalid-feedback" role="alert" style="display: block;">
                                      <strong>{{ $errors->first('shift_id.'.$k) }}</strong>
                                  </span>
                              @endif
                          </td>
                          <td>
                              <input disabled="disabled" id="it_{{$k}}" type="time" class="form-control form_control dabl" name="intime[]" value="{{ old('intime.'.$k) }}">
                              @if ($errors->has('intime.'.$k))
                                  <span class="invalid-feedback" role="alert" style="display: block;">
                                      <strong>{{ $errors->first('intime.'.$k) }}</strong>
                                  </span>
                              @endif
                            </td>
                          
                          <td>
                              <input disabled="disabled" id="ot_{{$k}}" type="time" class="form-control form_control dabl" name="outtime[]" value="{{ old('outtime.'.$k) }}">
                              @if ($errors->has('outtime.'.$k))
                                  <span class="invalid-feedback" role="alert" style="display: block;">
                                      <strong>{{ $errors->first('outtime.'.$k) }}</strong>
                                  </span>
                              @endif
                            </td>
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
   
   //select all checkboxes
   $("#checkAll").change(function(){  //"select all" change
       $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
       if ($(this).is(':checked')) {
            $(".dabl").removeAttr('disabled');
       }else{
            $(".dabl").attr('disabled', 'disabled');
       }
       
   });

   $(".checkbox").change(function () {
       var id = null;
        if ($(this).is(':checked')) {
            id = $(this).data('e_id');
            $('#s_'+id).removeAttr('disabled');
            $('#it_'+id).removeAttr('disabled');
            $('#ot_'+id).removeAttr('disabled');
        } else {
            id = $(this).data('e_id');
            $('#s_'+id).attr('disabled', 'disabled');
            $('#it_'+id).attr('disabled', 'disabled');
            $('#ot_'+id).attr('disabled', 'disabled');
        }
    });

    var base_url = window.location.origin;

    $(".shift-info").change(function(){
        var shift_id = $(this).val();
        var f_id = $(this).attr('id').slice(2);
        $.ajax({
            url: base_url+'/dashboard/shift/info/'+shift_id,
            method: 'GET',
            success: function(data){
                $('#it_'+f_id).val(data.shift.time);
                $('#ot_'+f_id).val(data.shift.to_time);
            },
            error: function(){
                $('#it_'+f_id).val('');
                $('#ot_'+f_id).val('');
            }
        });
    });


</script>
@endpush
