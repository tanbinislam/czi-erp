@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Leave Information</h4>
            </div>
            <div class="col-md-4 text-right">
                <a href="#" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn" id="addInfoModal" title="add" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle label-icon"></i>Add Leave Information</a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
              <thead class="thead-dark">
                <tr>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>In Days</th>
                    <th>Leave Reason</th>
                    <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                @foreach($leaves as $data)
                <tr>
                    <td>{{$data->leave_from->toFormattedDateString()}}</td>
                    <td>{{$data->leave_to->toFormattedDateString()}}</td>
                    <td>{{$data->leave_from->diffInDays($data->leave_to->addDay())}} days</td>
                    <td>{{$data->leave_reason}}</td>
                    <td>
                      <div class="btn-group">
                          <button class="btn btn-dark btn-sm" type="button">Manage</button>
                          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split waves-effect btn-label waves-light card_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-chevron-down"></i>
                          </button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('dashboard/employee/'.$emp->employee_code.'/leave/edit/'.$data->leave_slug)}}">Edit</a>
                              <a class="dropdown-item" href="#" id="softDelete" data-toggle="modal" data-target="#softDelModal" data-id="{{$data->id}}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
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
<!--softdelete modal start-->
<div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/employee/leave/soft-delete')}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
        </div>
        <div class="modal-body modal_card">
          Are you sure you want to delete?
          <input type="hidden" id="modal_id" name="modal_id">
          <input type="hidden" name="code" value="{{ $emp->employee_code }}">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">Confirm</button>
            <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--add information modal start-->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    @if($errors->any())
              {{-- {{dd($errors)}} --}}
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
    <form method="post" action="{{url('dashboard/employee/leave/submit')}}">
      @csrf
      <input type="hidden" name="code" value="{{$emp->employee_code}}">
      <div class="modal-content">
        <div class="modal-header modal_header_upper">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Add Leave Information</h5>
        </div>
        <div class="modal-body modal_card">
          <div class="form-group row mb-3 {{ $errors->has('leave_from') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_form_label_modal">Leave From Date<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="hidden" name="employee_id" value="{{$emp->employee_id}}">
              <input type="date" class="form-control form_control_modal" name="leave_from" value="{{old('leave_from')}}">
              @if ($errors->has('leave_from'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('leave_from') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="form-group row mb-3">
            <label class="col-sm-3 col-form-label col_form_label_modal">Leave To Date<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="date" class="form-control form_control_modal" name="leave_to" value="{{old('leave_to')}}">
              @if ($errors->has('leave_to'))
              <span class="invalid-feedback" role="alert" style="display: block;">
                  <strong>{{ $errors->first('leave_to') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group row mb-3">
            <label class="col-sm-3 col-form-label col_form_label_modal">Leave Reason<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control_modal" name="leave_reason" value="{{old('leave_reason')}}">
              @if ($errors->has('leave_reason'))
              <span class="invalid-feedback" role="alert" style="display: block;">
                  <strong>{{ $errors->first('leave_reason') }}</strong>
              </span>
              @endif
            </div>
          </div>
        <div class="modal-footer modal_footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
