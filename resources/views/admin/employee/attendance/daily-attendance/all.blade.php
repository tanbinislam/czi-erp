@extends('admin.employee.main.profile')
@section('employee')
@php
  $employeeID=$emp->employee_id;
@endphp
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Attendance Information</h4>
            </div>

        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
              <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>In time</th>
                    <th>Out Time</th>
                    <th>Over Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach($emp->attendances as $data)
                <tr>
                  <td class="{{ $data->is_holiday ? "text-danger" : '' }}" {{ $data->is_holiday ? 'title=Holiday!' : '' }}>{{  $data->date ?: '' }}</td>
                    <td>{{date('h:i A', strtotime($data->intime))}}</td>
                    <td>{{date('h:i A', strtotime($data->outtime))}}</td>
                    <td>{{ floor($data->overtime / 60).' hr - '.($data->overtime % 60).' min' }}</td>
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

<!--add information modal start-->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="post" action="{{url('dashboard/employee/document/submit')}}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header_upper">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
        </div>
        <div class="modal-body modal_card">

          <div class="form-group row mb-3 {{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_form_label_modal">Title<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="hidden" name="employee" value="{{$employeeID}}">
              <input type="hidden" name="code" value="{{$emp->employee_code}}">
              <input type="text" class="form-control form_control_modal" name="title" value="{{old('title')}}">
              @if ($errors->has('title'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="form-group row mb-3 {{ $errors->has('subtitle') ? ' has-error' : '' }}">
            <label class="col-sm-3 col-form-label col_form_label_modal">Sub-Title<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control_modal" name="subtitle" value="{{old('subtitle')}}">
              @if ($errors->has('subtitle'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('subtitle') }}</strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="form-group row mb-3">
            <label class="col-sm-3 col-form-label col_form_label_modal">Photo:</label>
            <div class="col-sm-7">
              <input type="file" class="form-control form_control_modal" name="pic">
            </div>
          </div>

        </div>
        <div class="modal-footer modal_footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--softdelete modal start-->
<div id="softDelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/employee/document/softdelete')}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
        </div>
        <div class="modal-body modal_card">
          Are you sure you want to delete?
          <input type="hidden" id="modal_id" name="modal_id">
          <input type="hidden" name="code" value="{{$emp->employee_code}}">
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
