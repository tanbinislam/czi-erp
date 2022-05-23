@extends('admin.employee.main.profile')
@section('employee')
<div class="card">
    <div class="card-header card_header">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i> Contact Information</h4>
            </div>
            <div class="col-md-4 text-right">
                <a href="#" class="btn btn-dark btn-md waves-effect btn-label waves-light card_btn" id="addInfoModal" title="add" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle label-icon"></i>Add Contact</a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive nowrap custom_table">
              <thead class="thead-dark">
                <tr>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contacts as $data)
                <tr>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->address}}</td>
                    <td>
                      <div class="btn-group">
                          <button class="btn btn-dark btn-sm" type="button">Manage</button>
                          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split waves-effect btn-label waves-light card_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-chevron-down"></i>
                          </button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('dashboard/employee/'.$emp->employee_code.'/contact/info/view/'.$data->id)}}">View</a>
                              <a class="dropdown-item" href="{{url('dashboard/employee/'.$emp->employee_code.'/contact/info/edit/'.$data->id)}}">Edit</a>
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

<!--add information modal start-->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="post" action="{{url('dashboard/employee/contact/info/submit')}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header_upper">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Add Contact</h5>
        </div>
        <div class="modal-body modal_card">
            <div class="card-body">
                <div class="form-group row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label"> Email<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="hidden" name="employee_id" value="{{$emp->employee_id}}">
                    <input type="text" class="form-control form_control" name="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label class="col-sm-3 col-form-label col_form_label">Phone<span class="req_star">*</span>:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="phone" value="{{old('phone')}}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label class="col-sm-3 col-form-label col_form_label">Address:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control form_control" name="address" value="{{old('address')}}">
                  </div>
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
    <form method="post" action="{{url('dashboard/employee/contact/info/softdelete')}}">
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
@endsection
